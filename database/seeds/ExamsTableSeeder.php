<?php

use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Exam::create([
            'code' => '1',
            'name' => '1st term exam 2017',
            'description' => '',
            'term_id' => 1,
            'academic_year_id' => 1,
            'exam_category_id' => 1,
            'start' => '2017-01-01',
            'end' => '2017-01-01',
            'status' => 'Pending'
        ]);
    }
}
