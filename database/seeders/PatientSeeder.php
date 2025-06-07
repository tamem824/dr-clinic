<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $patients = [
            ['patient_number'=> '543', 'fullname' => 'أحمد علي', 'birthdate' => '1990-05-15', 'phone' => '0599123456'],
            ['patient_number'=> '544', 'fullname' => 'سارة محمد', 'birthdate' => '1985-09-21', 'phone' => '0599988776'],
            ['patient_number'=> '545', 'fullname' => 'خالد حسن', 'birthdate' => '1992-03-10', 'phone' => '0599345678'],
            ['patient_number'=> '546', 'fullname' => 'ليلى سمير', 'birthdate' => '1988-11-30', 'phone' => '0599112233'],
            ['patient_number'=> '547', 'fullname' => 'محمود يوسف', 'birthdate' => '1975-07-19', 'phone' => '0599456123'],
            ['patient_number'=> '548', 'fullname' => 'نورا أحمد', 'birthdate' => '1996-01-08', 'phone' => '0599876543'],
            ['patient_number'=> '549', 'fullname' => 'سامر عادل', 'birthdate' => '1980-06-14', 'phone' => '0599123678'],
            ['patient_number'=> '550', 'fullname' => 'هدى نبيل', 'birthdate' => '1993-08-22', 'phone' => '0599332211'],
            ['patient_number'=> '551', 'fullname' => 'ياسر فؤاد', 'birthdate' => '1981-04-30', 'phone' => '0599678452'],
            ['patient_number'=> '552', 'fullname' => 'مريم عبد الله', 'birthdate' => '1998-02-17', 'phone' => '0599765432'],
            ['patient_number'=> '553', 'fullname' => 'فادي عماد', 'birthdate' => '1990-12-12', 'phone' => '0599221113'],
            ['patient_number'=> '554', 'fullname' => 'سهى جمال', 'birthdate' => '1984-01-01', 'phone' => '0599111199'],
            ['patient_number'=> '555', 'fullname' => 'علي ناصر', 'birthdate' => '1979-09-09', 'phone' => '0599444555'],
            ['patient_number'=> '556', 'fullname' => 'ريما بشير', 'birthdate' => '1995-07-07', 'phone' => '0599888877'],
            ['patient_number'=> '557', 'fullname' => 'جمال فتحي', 'birthdate' => '1987-05-23', 'phone' => '0599345234'],
            ['patient_number'=> '558', 'fullname' => 'بتول خليل', 'birthdate' => '1994-10-13', 'phone' => '0599871234'],
            ['patient_number'=> '559', 'fullname' => 'عمر صبحي', 'birthdate' => '1986-08-18', 'phone' => '0599123987'],
            ['patient_number'=> '560', 'fullname' => 'هالة كمال', 'birthdate' => '1982-03-29', 'phone' => '0599981122'],
            ['patient_number'=> '561', 'fullname' => 'وائل مصطفى', 'birthdate' => '1991-06-26', 'phone' => '0599114455'],
            ['patient_number'=> '562', 'fullname' => 'عائشة طارق', 'birthdate' => '1997-11-02', 'phone' => '0599333444'],
            ['patient_number'=> '563', 'fullname' => 'نادر حسين', 'birthdate' => '1983-12-08', 'phone' => '0599777888'],
            ['patient_number'=> '564', 'fullname' => 'لينا عارف', 'birthdate' => '1992-01-16', 'phone' => '0599223344'],
            ['patient_number'=> '565', 'fullname' => 'أكرم رياض', 'birthdate' => '1978-10-05', 'phone' => '0599112234'],
            ['patient_number'=> '566', 'fullname' => 'رغد هشام', 'birthdate' => '1990-09-03', 'phone' => '0599766543'],
            ['patient_number'=> '567', 'fullname' => 'سامي عوض', 'birthdate' => '1989-07-15', 'phone' => '0599988662'],
            ['patient_number'=> '568', 'fullname' => 'داليا عدنان', 'birthdate' => '1996-05-21', 'phone' => '0599123123'],
            ['patient_number'=> '569', 'fullname' => 'زياد كرم', 'birthdate' => '1994-08-11', 'phone' => '0599776442'],
            ['patient_number'=> '570', 'fullname' => 'شهد أنور', 'birthdate' => '1993-04-14', 'phone' => '0599432111'],
            ['patient_number'=> '571', 'fullname' => 'نائل عمر', 'birthdate' => '1981-02-02', 'phone' => '0599129876'],
            ['patient_number'=> '572', 'fullname' => 'إيمان وسيم', 'birthdate' => '1987-06-28', 'phone' => '0599555667'],
            ['patient_number'=> '573', 'fullname' => 'رائد مازن', 'birthdate' => '1976-03-12', 'phone' => '0599677888'],
            ['patient_number'=> '574', 'fullname' => 'منار فهد', 'birthdate' => '1999-12-24', 'phone' => '0599321001'],
            ['patient_number'=> '575', 'fullname' => 'رامي توفيق', 'birthdate' => '1980-01-18', 'phone' => '0599877890'],
            ['patient_number'=> '576', 'fullname' => 'نجوى عامر', 'birthdate' => '1992-09-09', 'phone' => '0599111144'],
            ['patient_number'=> '577', 'fullname' => 'هيثم فارس', 'birthdate' => '1985-04-04', 'phone' => '0599667733'],
            ['patient_number'=> '578', 'fullname' => 'جنى وديع', 'birthdate' => '1991-07-13', 'phone' => '0599766112'],
            ['patient_number'=> '579', 'fullname' => 'سيف لؤي', 'birthdate' => '1983-05-07', 'phone' => '0599433211'],
            ['patient_number'=> '580', 'fullname' => 'رنا حسن', 'birthdate' => '1990-11-11', 'phone' => '0599554433'],
            ['patient_number'=> '581', 'fullname' => 'تيم خالد', 'birthdate' => '1995-08-30', 'phone' => '0599998877'],
            ['patient_number'=> '582', 'fullname' => 'مرح نجيب', 'birthdate' => '1982-10-25', 'phone' => '0599123412'],
            ['patient_number'=> '583', 'fullname' => 'غسان سليم', 'birthdate' => '1977-01-09', 'phone' => '0599665544'],
            ['patient_number'=> '584', 'fullname' => 'سندس راشد', 'birthdate' => '1994-06-06', 'phone' => '0599776655'],
            ['patient_number'=> '585', 'fullname' => 'هيفاء سليم', 'birthdate' => '1988-02-20', 'phone' => '0599335544'],
            ['patient_number'=> '586', 'fullname' => 'راما شادي', 'birthdate' => '1996-10-10', 'phone' => '0599667788'],
            ['patient_number'=> '587', 'fullname' => 'قصي عمرو', 'birthdate' => '1986-09-14', 'phone' => '0599881122'],
            ['patient_number'=> '588', 'fullname' => 'بتول عبد الرحيم', 'birthdate' => '1998-03-19', 'phone' => '0599117788'],
            ['patient_number'=> '589', 'fullname' => 'كنان وليد', 'birthdate' => '1993-07-29', 'phone' => '0599765433'],
            ['patient_number'=> '590', 'fullname' => 'سلوى منير', 'birthdate' => '1991-05-01', 'phone' => '0599221100'],
            ['patient_number'=> '591', 'fullname' => 'مازن عدلي', 'birthdate' => '1974-12-31', 'phone' => '0599334466'],
            ['patient_number'=> '592', 'fullname' => 'وفاء رامي', 'birthdate' => '1984-06-17', 'phone' => '0599001122'],
        ];

        foreach ($patients as $patient)
            Patient::create($patient);
    }
}
