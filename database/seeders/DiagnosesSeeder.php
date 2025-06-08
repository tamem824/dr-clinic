<?php
// database/seeders/DiagnosisSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diagnosis;
use App\Models\Patient;

class DiagnosesSeeder extends Seeder
{
    public function run(): void
    {
        // نفترض أن عندك 4 مرضى
        $patients = Patient::all();

        foreach ($patients as $patient) {
            for ($i = 1; $i <= 2; $i++) {
                Diagnosis::create([
                    'patient_id' => $patient->id,
                    'clinical_examination' => "Clinical exam result $i for patient {$patient->id}",
                    'diagnosis' => "Diagnosis $i for patient {$patient->id}",
                    'treatment' => "Treatment $i",
                    'notes' => "Notes $i",
                    'bp' => '120/80',
                    'hr' => '72',
                    'rr' => '18',
                    'sat' => '98%',
                ]);
            }
        }
    }
}
