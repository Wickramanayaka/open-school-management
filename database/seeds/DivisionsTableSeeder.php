<?php

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Division
        App\Division::create([
            'name' => 'A',
        ]);
        App\Division::create([
            'name' => 'B',
        ]);
        App\Division::create([
            'name' => 'C',
        ]);
        App\Division::create([
            'name' => 'D',
        ]);
        App\Division::create([
            'name' => 'E',
        ]);
        App\Division::create([
            'name' => 'F',
        ]);
        App\Division::create([
            'name' => 'G',
        ]);
        App\Division::create([
            'name' => 'H',
        ]);
    }
}
