<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'name' => 'English',
                'code' => 'en',
                'native_name' => 'English',
                'icon' => '🇬🇧',
                'status' => 1
            ],
            [
                'name' => 'Gujarati',
                'code' => 'gu',
                'native_name' => 'ગુજરાતી',
                'icon' => '🇮🇳',
                'status' => 1
            ],
            [
                'name' => 'Hindi',
                'code' => 'hi',
                'native_name' => 'हिंदी',
                'icon' => '🇮🇳',
                'status' => 1
            ],
            [
                'name' => 'Marathi',
                'code' => 'mr',
                'native_name' => 'मराठी',
                'icon' => '🇮🇳',
                'status' => 1
            ],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate([
                'code' => $language['code']
            ], $language);
        }
    }
}
