<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Term::create([
            'code' => 1,
            'name' => '1st Term - 2017',
            'academic_year_id' => 1,
            'start' => '2017-01-01',
            'end' => '2017-03-30',
            'number_of_days' => 60,
            'sequence' => 1
        ]);
    }
}
