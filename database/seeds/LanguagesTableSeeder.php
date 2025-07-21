<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Language::create([
            'name' => 'Sinhala'
        ]);

        App\Language::create([
            'name' => 'Tamil'
        ]);

        App\Language::create([
            'name' => 'English'
        ]);
    }
}
