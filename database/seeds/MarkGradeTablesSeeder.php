<?php

use Illuminate\Database\Seeder;

class MarkGradeTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MarkGrade::create([
            'grade' => 'A',
            'low' => '80',
            'high' => '100'
        ]);
        App\MarkGrade::create([
            'grade' => 'B',
            'low' => '70',
            'high' => '79'
        ]);
        App\MarkGrade::create([
            'grade' => 'C',
            'low' => '55',
            'high' => '69'
        ]);
        App\MarkGrade::create([
            'grade' => 'S',
            'low' => '40',
            'high' => '54'
        ]);
        App\MarkGrade::create([
            'grade' => 'W',
            'low' => '0',
            'high' => '39'
        ]);

    }
}
