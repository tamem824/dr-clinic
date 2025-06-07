<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class PatientSeeder extends Seeder
{
    public function run()
    {
        Patient::create([

           'patient_number'=> '543',
            'fullname' => 'أحمد علي',
            'birth_date' => '1990-05-15',
            'phone' => '0599123456',

        ]);

        Patient::create([
            'patient_number'=> '544',
            'fullname' => 'سارة محمد',
            'birth_date' => '1985-09-21',
            'phone' => '0599988776',

        ]);
    }
}
