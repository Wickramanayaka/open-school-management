<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\House::create([
            'code' => 1,
            'name' => 'Green'
        ]);
    }
}
