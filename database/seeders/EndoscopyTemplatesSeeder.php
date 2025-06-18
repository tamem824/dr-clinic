<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EndoscopyTemplatesSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            // تنطير علوي
            ['type' => 'upper', 'section_name' => 'الاستطباب', 'order' => 1],
            ['type' => 'upper', 'section_name' => 'المريء', 'order' => 2],
            ['type' => 'upper', 'section_name' => 'الفؤاد', 'order' => 3],
            ['type' => 'upper', 'section_name' => 'المعدة', 'order' => 4],
            ['type' => 'upper', 'section_name' => 'البواب', 'order' => 5],
            ['type' => 'upper', 'section_name' => 'البصلة', 'order' => 6],
            ['type' => 'upper', 'section_name' => 'الاثني عشر', 'order' => 7],
            ['type' => 'upper', 'section_name' => 'النتيجة', 'order' => 8],

            // تنطير سفلي
            ['type' => 'lower', 'section_name' => 'فحص الشرج', 'order' => 1],
            ['type' => 'lower', 'section_name' => 'المس الشرجي', 'order' => 2],
            ['type' => 'lower', 'section_name' => 'المستقيم', 'order' => 3],
            ['type' => 'lower', 'section_name' => 'القولون السيني', 'order' => 4],
            ['type' => 'lower', 'section_name' => 'القولون الأيسر', 'order' => 5],
            ['type' => 'lower', 'section_name' => 'القولون المستعرض', 'order' => 6],
            ['type' => 'lower', 'section_name' => 'القولون الأيمن', 'order' => 7],
            ['type' => 'lower', 'section_name' => 'القولون الأعور', 'order' => 8],
            ['type' => 'lower', 'section_name' => 'فوهة الدقاق', 'order' => 9],
            ['type' => 'lower', 'section_name' => 'نهاية الدقاق', 'order' => 10],
            ['type' => 'lower', 'section_name' => 'النتيجة', 'order' => 11],
        ];

        DB::table('endoscopy_templates')->insert($templates);
    }
}
