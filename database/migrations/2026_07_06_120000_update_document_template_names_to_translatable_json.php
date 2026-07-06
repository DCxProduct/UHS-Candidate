<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('document_templates')) {
            return;
        }

        foreach ($this->templateNames() as $type => $name) {
            DB::table('document_templates')
                ->where('type', $type)
                ->update([
                    'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
                    'updated_at' => now(),
                ]);

            if (Schema::hasColumn('document_templates', 'template_name')) {
                DB::table('document_templates')
                    ->where('type', $type)
                    ->update([
                        'template_name' => json_encode($name, JSON_UNESCAPED_UNICODE),
                        'updated_at' => now(),
                    ]);
            }
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('document_templates')) {
            return;
        }

        foreach ($this->templateNames() as $type => $name) {
            DB::table('document_templates')
                ->where('type', $type)
                ->update([
                    'name' => $name['en'],
                    'updated_at' => now(),
                ]);

            if (Schema::hasColumn('document_templates', 'template_name')) {
                DB::table('document_templates')
                    ->where('type', $type)
                    ->update([
                        'template_name' => $name['en'],
                        'updated_at' => now(),
                    ]);
            }
        }
    }

    private function templateNames(): array
    {
        return [
            'custom_form_1' => [
                'en' => 'Profile Template',
                'km' => 'ប្រវត្តិរូប គំរូ',
                'kh' => 'ប្រវត្តិរូប គំរូ',
            ],
            'custom_form_2' => [
                'en' => 'National Examination Registration Template',
                'km' => 'ការចុះឈ្មោះប្រឡងថ្នាក់ជាតិ គំរូ',
                'kh' => 'ការចុះឈ្មោះប្រឡងថ្នាក់ជាតិ គំរូ',
            ],
            'custom_form_3' => [
                'en' => 'Associate Form Template',
                'km' => 'ពាក្យសុំចូលរៀនថ្នាក់បរិញ្ញាបត្ររង គំរូ',
                'kh' => 'ពាក្យសុំចូលរៀនថ្នាក់បរិញ្ញាបត្ររង គំរូ',
            ],
            'custom_form_4' => [
                'en' => 'Bachelor Transfer Application Template',
                'km' => 'ពាក្យសុំផ្ទេរចូលឆ្នាំទី២ ថ្នាក់បរិញ្ញាបត្រ គំរូ',
                'kh' => 'ពាក្យសុំផ្ទេរចូលឆ្នាំទី២ ថ្នាក់បរិញ្ញាបត្រ គំរូ',
            ],
            'custom_form_5' => [
                'en' => 'Master Application Template',
                'km' => 'ពាក្យសុំចូលរៀនថ្នាក់អនុបណ្ឌិត គំរូ',
                'kh' => 'ពាក្យសុំចូលរៀនថ្នាក់អនុបណ្ឌិត គំរូ',
            ],
            'custom_form_6' => [
                'en' => 'PhD Application Template',
                'km' => 'ពាក្យសុំចូលរៀនថ្នាក់បណ្ឌិត គំរូ',
                'kh' => 'ពាក្យសុំចូលរៀនថ្នាក់បណ្ឌិត គំរូ',
            ],
        ];
    }
};
