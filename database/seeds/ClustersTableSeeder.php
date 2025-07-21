<?php

use Illuminate\Database\Seeder;

class ClustersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Cluster::create([
            'code' => '1',
            'name' => 'Junior',
            'description' => 'Junior' 
        ]);
    }
}
