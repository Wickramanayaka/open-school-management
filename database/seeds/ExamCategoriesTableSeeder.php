<?php

use Illuminate\Database\Seeder;

class ExamCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ExamCategory::create([
            'name' => 'Term Exam'
        ]);
        App\ExamCategory::create([
            'name' => 'Unit Test'
        ]);
        App\ExamCategory::create([
            'name' => 'Assignmet'
        ]);
    }
}
