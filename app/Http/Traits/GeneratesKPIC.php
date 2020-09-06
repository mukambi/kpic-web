<?php

namespace App\Http\Traits;

use App\AuditTrail;
use App\Patient;
use App\Sep;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait GeneratesKPIC
{
    public function createPatientRecord(Request $request)
    {
        $this->getValidate($request);

        DB::transaction(function () use ($request, &$patient) {
            $sep = Sep::findOrFail($request->sep_id);

            $patient = Patient::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'yob' => $request->yob,
                'mob' => $request->mob,
                'sep_id' => $sep->id,
            ]);

            $patient->icons()->sync(array_keys($request->icons));

            $kpic_code = $this->generateKPIC(
                $patient, $sep, $request->first_name, $request->last_name, $request->yob, $request->mob
            );

            $patient->update([
                'kpic_code' => $kpic_code['full_kpic_code'],
                'hash' => Hash::make($kpic_code['full_kpic_code']),
                'short_kpic_code' => $kpic_code['short_kpic_code']
            ]);
        });

        return $patient;
    }

    public function getValidate(Request $request): void
    {
        $request->validate([
            'sep_id' => 'required|uuid',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'yob' => 'required|integer|max:' . date('Y'),
            'mob' => 'nullable|string|max:255',
            'icons' => 'required|max:4|min:4'
        ], [
            'icons.min' => 'The icons must be at least 4.',
            'icons.max' => 'The icons must be at most 4.',
        ]);
    }

    public function generateKPIC(Patient $patient, Sep $sep, string $first_name, string $last_name, int $yob, string $mob): array
    {
        $sep_code = $this->getSEPCode($sep);
        $user_data_code = $this->getUserDataCode($first_name, $last_name, $yob, $mob);

        $this->storeTrail($patient, $sep, 'Generated', auth()->user());
        return [
            'full_kpic_code' =>
                (string)implode("-", [
                    $sep_code,
                    $user_data_code,
                    $this->formatPatientId($patient)
                ]),
            'short_kpic_code' =>
                (string)implode("-", [
                    $sep_code,
                    $user_data_code
                ])
        ];
    }

    protected function getSEPCode(Sep $sep): string
    {
        return (string)$sep->code . $sep->type->code;
    }

    protected function getUserDataCode(string $first_name, string $last_name, int $yob, string $mob): string
    {
        $f = strtoupper($first_name)[0];
        $l = strtoupper($last_name)[0];
        $cy = substr($yob, -2);
        $cm = strtoupper($mob)[0];

        return (string)$cm . $f . $l . $cy;
    }

    protected function storeTrail(Patient $patient, Sep $sep, $status, $user = null)
    {
        AuditTrail::create([
            'sep_id' => $sep->id,
            'patient_id' => $patient->id,
            'user_id' => $user ? $user->id : User::first()->id,
            'action' => $status
        ]);
    }

    protected function formatPatientId(Patient $patient)
    {
        return (string)sprintf("%05d", $patient->id);
    }

    public function lookupPatientRecord(Request $request)
    {
        $this->getValidate($request);

        DB::transaction(function () use ($request, &$short_kpic_code) {
            $sep = Sep::findOrFail($request->sep_id);

            $short_kpic_code = $this->generateShortKPIC(
                $sep, $request->first_name, $request->last_name, $request->yob, $request->mob
            );

            $patients = Patient::query()
                ->where('short_kpic_code', $short_kpic_code)
                ->whereHas('icons', function ($query) use($request){
                    $query->whereIn('icons.id', array_keys($request->icons));
                })->get();

            foreach ($patients as $patient) {
                $array = collect($patients)->reject(function ($p) use ($patient) {
                    return $p->id == $patient->id;
                })->pluck('id')->toArray();
                $patient->lookups()->create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'yob' => $request->yob,
                    'mob' => $request->mob,
                    'sep_id' => $request->sep_id,
                    'duplicate_patient_ids' => json_encode($array)
                ]);
                $this->storeTrail($patient, $sep, 'Lookup', auth()->user());
            }
        });

        return $short_kpic_code;
    }

    protected function generateShortKPIC(Sep $sep, string $first_name, string $last_name, int $yob, string $mob): string
    {
        return (string)implode("-", [
            $this->getSEPCode($sep),
            $this->getUserDataCode($first_name, $last_name, $yob, $mob)
        ]);
    }

    public function getShortKPICCode($code)
    {
        $array_code = explode("-", $code);
        switch (count($array_code)) {
            case 3:
                return implode('-', [$array_code[0], $array_code[1]]);
            case 2:
                return $code;
            default:
                return null;
        }
    }
}
