<?php

namespace App\Http\Traits;

use App\AuditTrail;
use App\Lookup;
use App\Patient;
use App\Pcn;
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
            $pcn = Pcn::findOrFail($request->pcn_id);
            $sep = Sep::findOrFail($request->sep_id);

            $patient = Patient::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'yob' => $request->yob,
                'pcn_id' => $pcn->id,
                'sep_id' => $sep->id,
                'month' => $request->month,
                'year' => $request->year
            ]);

            $kpic_code = $this->generateKPIC(
                $patient, $sep, $pcn, $request->year, $request->month, $request->first_name, $request->last_name, $request->yob
            );

            $patient->update([
                'kpic_code' => $kpic_code['full_kpic_code'],
                'hash' => Hash::make($kpic_code['full_kpic_code']),
                'short_kpic_code' => $kpic_code['short_kpic_code']
            ]);
        });

        return $patient;
    }

    /**
     * @param Request $request
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getValidate(Request $request): void
    {
        $request->validate([
            'sep_id' => 'required|uuid',
            'year' => 'required|integer|max:' . date('Y'),
            'month' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'yob' => 'required|integer|max:' . date('Y'),
            'pcn_id' => 'required|uuid',
        ]);
    }

    public function generateKPIC(Patient $patient, Sep $sep, Pcn $pcn, int $year, string $month, string $first_name, string $last_name, int $yob): array
    {
        $sep_code = $this->getSEPCode($sep);
        $user_data_code = $this->getUserDataCode($pcn, $year, $month, $first_name, $last_name, $yob);

        $this->storeTrail(auth()->user(), $patient, $sep, 'Generated');
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

    protected function storeTrail($user = null, Patient $patient, Sep $sep, $status)
    {
        AuditTrail::create([
            'sep_id' => $sep->id,
            'patient_id' => $patient->id,
            'user_id' => $user ? $user->id : User::first()->id,
            'action' => $status
        ]);
    }

    protected function getSEPCode(Sep $sep): string
    {
        return (string)$sep->code . $sep->type->code;
    }

    protected function getUserDataCode(Pcn $pcn, int $year, string $month, string $first_name, string $last_name, int $yob): string
    {
        $y = substr($year, -2);
        $m = strtoupper($month)[0];
        $f = strtoupper($first_name)[0];
        $l = strtoupper($last_name)[0];
        $cy = substr($yob, -2);
        $p = $pcn->number;

        return (string)$y . $m . $f . $l . $cy . $p;
    }

    protected function formatPatientId(Patient $patient)
    {
        return (string)sprintf("%05d", $patient->id);
    }

    public function lookupPatientRecord(Request $request)
    {
        $this->getValidate($request);

        DB::transaction(function () use ($request, &$short_kpic_code) {
            $pcn = Pcn::findOrFail($request->pcn_id);
            $sep = Sep::findOrFail($request->sep_id);

            $short_kpic_code = $this->generateShortKPIC(
                $sep, $pcn, $request->year, $request->month, $request->first_name, $request->last_name, $request->yob
            );

            $patients = Patient::where('short_kpic_code', $short_kpic_code)->get();
            foreach ($patients as $patient){
                $array = collect($patients)->reject(function ($p) use ($patient){
                    return $p->id == $patient->id;
                })->pluck('id')->toArray();
                $patient->lookups()->create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'yob' => $request->yob,
                    'pcn_id' => $request->pcn_id,
                    'sep_id' => $request->sep_id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'duplicate_patient_ids' => json_encode($array)
                ]);
                $this->storeTrail(auth()->user(), $patient, $sep, 'Lookup');
            }
        });

        return $short_kpic_code;
    }

    protected function generateShortKPIC(Sep $sep, Pcn $pcn, int $year, string $month, string $first_name, string $last_name, int $yob): string
    {
        return (string)implode("-", [
            $this->getSEPCode($sep),
            $this->getUserDataCode($pcn, $year, $month, $first_name, $last_name, $yob)
        ]);
    }

    public function getShortKPICCode($code)
    {
        $array_code = explode("-",$code);
        switch (count($array_code)){
            case 3:
                return implode('-',[$array_code[0], $array_code[1]]);
            case 2:
                return $code;
            default:
                return null;
        }
    }
}
