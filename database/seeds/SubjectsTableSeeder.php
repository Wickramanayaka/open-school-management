<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Subject::create([
            'code' => '1',
            'name' => 'Sinhala',
            'description' => 'Sinhala 6,7,8',
            'language_id' => 1,
            'grade_id' => 2
        ]);
    }
}
