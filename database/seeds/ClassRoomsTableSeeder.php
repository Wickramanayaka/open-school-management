<?php

use Illuminate\Database\Seeder;

class ClassRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (App\Grade::all() as $key => $grade) {
            foreach (App\Division::all() as $key => $division) {
                App\ClassRoom::create([
                    'grade_id' => $grade->id,
                    'division_id' => $division->id,
                    'name' => $grade->name . ' - ' . $division->name
                ]);
            }
        }
    }
}
