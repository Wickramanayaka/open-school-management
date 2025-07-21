<?php

use Illuminate\Database\Seeder;

class AcademicYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\AcademicYear::create([
            'name' => '2018',
            'start' => '2018-01-01',
            'end' => '2018-12-31'
        ]);
    }
}
