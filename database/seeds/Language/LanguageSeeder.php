<?php

use Illuminate\Database\Seeder;
use Domain\Language\Entities\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('languages')){
            Language::firstOrCreate([
                'name' => "O'zbek",
                'locale' => 'uz',
                'active' => true,
                'rank' => 1,
            ]);
            Language::firstOrCreate([
                'name' => 'English',
                'locale' => 'en',
                'active' => true,
                'rank' => 2,
            ]);
            Language::firstOrCreate([
                'name' => 'Русский',
                'locale' => 'ru',
                'active' => true,
                'rank' => 3,
            ]);
        }
    }
}
