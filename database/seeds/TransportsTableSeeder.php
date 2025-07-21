<?php

use Illuminate\Database\Seeder;

class TransportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Transport::create([
            'name' => 'Bus',
        ]);
        App\Transport::create([
            'name' => 'School Van',
        ]);
        App\Transport::create([
            'name' => 'Private Vehicle',
        ]);
        App\Transport::create([
            'name' => 'Walking',
        ]);
        App\Transport::create([
            'name' => 'Other',
        ]);
    }
}
