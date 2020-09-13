<?php

namespace App\Http\Traits;

use App\AuditTrail;
use App\Exceptions\DuplicateKPIC;
use App\Icon;
use App\Patient;
use App\Sep;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait GeneratesKPIC
{
    protected $kpicChars = [
        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "A", "B", "C", "D", "E", "F", "G", "H", "J", "K",
        "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V",
        "W", "X", "Y", "Z"
    ];

    public function createPatientRecord(Request $request)
    {
        $this->getValidate($request);

        DB::transaction(function () use ($request, &$patient) {
            if (is_null($request->sep_id)) {
                $sep = $request->user()->sep;
            } else {
                $sep = Sep::findOrFail($request->sep_id);
            }

            $icon = Icon::query()->findOrFail($request->icon);
            $concatenated_string = $this->generateConcatenation(
                $sep, $request->surname, $request->first_name, $request->second_name, $request->yob, $request->mob
            );
            $hash = $this->generateHash($concatenated_string);
            $kpic_code = $this->KPICGenerator($hash);
            $this->checkForDuplicates($kpic_code, $icon);
            $patient = Patient::create([
                'sep_id' => $sep->id,
                'icon_id' => $icon->id,
                'kpic_code' => $kpic_code
            ]);
            $this->storeTrail($patient, $sep, 'Generated', $request->user());
        });

        return $patient;
    }

    public function getValidate(Request $request): void
    {
        $request->validate([
            'sep_id' => 'nullable|uuid',
            'surname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'yob' => 'required|integer|max:' . date('Y'),
            'mob' => 'nullable|string|max:255',
            'icon' => 'required|uuid'
        ]);
    }

    public function generateConcatenation(Sep $sep, string $surname, string $first_name, $second_name, int $yob, string $mob): string
    {
        if (is_null($second_name)) $second_name = '0000';
        $sep_code = $this->getSEPCode($sep);
        $user_data_code = $this->getUserDataCode($surname, $first_name, $second_name, $yob, $mob);
        return (string)implode("-", [
            $sep_code,
            $user_data_code
        ]);
    }

    protected function getSEPCode(Sep $sep): string
    {
        return (string)$sep->code . $sep->type->code;
    }

    protected function getUserDataCode(string $surname, string $first_name, $second_name, int $yob, string $mob): string
    {
        return (string)implode('|', [
            strtolower($surname),
            strtolower($first_name),
            strtolower($second_name),
            $yob,
            strtolower($mob)
        ]);
    }

    public function generateHash($kpic_code)
    {
        try {
            return hash('sha256', $kpic_code);
        } catch (Exception $exception) {
            return null;
        }
    }

    protected function KPICGenerator($hash, $length = 9): string
    {
        $buff = [];
        for ($i = 0; $i < $length; $i++) {
            $b = (int)hexdec($hash[$i]);
            if ($b < 0) $b += 256;
            $idx = (int)$b % count($this->kpicChars);
            array_push($buff, $this->kpicChars[$idx]);
        }
        return (string)implode('', $buff);
    }

    protected function checkForDuplicates($kpic_code, Icon $icon)
    {
        $patients = Patient::query()
            ->where('kpic_code', $kpic_code)
            ->where('icon_id', $icon->id)
            ->get();
        if (count($patients)) throw new DuplicateKPIC('Duplicate KPIC Found! Please resubmit with a new icon selected');
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

    public function lookupPatientRecord(Request $request)
    {
        $this->getValidate($request);

        DB::transaction(function () use ($request, &$kpic_code) {
            if (is_null($request->sep_id)) {
                $sep = $request->user()->sep;
            } else {
                $sep = Sep::findOrFail($request->sep_id);
            }

            $concatenated_string = $this->generateConcatenation(
                $sep, $request->surname, $request->first_name, $request->second_name, $request->yob, $request->mob
            );

            $hash = $this->generateHash($concatenated_string);
            $kpic_code = $this->KPICGenerator($hash);
            $patients = Patient::query()
                ->where('kpic_code', $kpic_code)
                ->where('icon_id', $request->icon)
                ->get();

            foreach ($patients as $patient) {
                $array = collect($patients)->reject(function ($p) use ($patient) {
                    return $p->id == $patient->id;
                })->pluck('id')->toArray();
                $patient->lookups()->create([
                    'user_id' => $request->user()->id,
                    'sep_id' => $sep->id,
                    'duplicate_patient_ids' => json_encode($array)
                ]);
                $this->storeTrail($patient, $sep, 'Lookup', auth()->user());
            }
        });

        return $kpic_code;
    }

    public function storeTrailsAndLookups(Request $request, $patients)
    {
        $auth = $request->user();
        if ($auth->sep_id) {
            $patients->each(function ($patient) use ($auth, $patients) {
                $array = collect($patients)->reject(function ($p) use ($patient) {
                    return $p->id == $patient->id;
                })->pluck('id')->toArray();
                $sep = $auth->sep;
                $patient->lookups()->create([
                    'user_id' => $auth->id,
                    'sep_id' => $sep->id,
                    'duplicate_patient_ids' => json_encode($array)
                ]);
                $this->storeTrail($patient, $sep, 'Lookup', $auth);
            });
        } else {
            $patients->each(function ($patient) use ($auth, $patients) {
                $array = collect($patients)->reject(function ($p) use ($patient) {
                    return $p->id == $patient->id;
                })->pluck('id')->toArray();
                $sep = $patient->sep;
                $patient->lookups()->create([
                    'user_id' => $auth->id,
                    'sep_id' => $sep->id,
                    'duplicate_patient_ids' => json_encode($array)
                ]);
                $this->storeTrail($patient, $sep, 'Lookup', $auth);
            });
        }
    }

    protected function formatPatientId(Patient $patient)
    {
        return (string)sprintf("%05d", $patient->id);
    }
}
