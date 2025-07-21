<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Grade::create([
            'name' => 1,
        ]);
        App\Grade::create([
            'name' => 2,
        ]);    
        App\Grade::create([
            'name' => 3,
        ]);
        App\Grade::create([
            'name' => 4,
        ]);  
        App\Grade::create([
            'name' => 5,
        ]);
        App\Grade::create([
            'name' => 6,
        ]);    
        App\Grade::create([
            'name' => 7,
        ]);
        App\Grade::create([
            'name' => 8,
        ]);     
        App\Grade::create([
            'name' => 9,
        ]);
        App\Grade::create([
            'name' => 10,
        ]);    
        App\Grade::create([
            'name' => 11,
        ]);
        App\Grade::create([
            'name' => '12 Maths',
        ]);  
        App\Grade::create([
            'name' => '12 Bio',
        ]);
        App\Grade::create([
            'name' => '12 Commerce',
        ]);    
        App\Grade::create([
            'name' => '12 Art',
        ]);
        App\Grade::create([
            'name' => '13 Maths',
        ]);  
        App\Grade::create([
            'name' => '13 Bio',
        ]);
        App\Grade::create([
            'name' => '13 Commerce',
        ]);    
        App\Grade::create([
            'name' => '13 Art',
        ]);
    }
}
