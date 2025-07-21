<?php

use Illuminate\Database\Seeder;

class OccupationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Occupation::create(["name" => "Not Available"]);
        App\Occupation::create(["name" => "⁠Doctor"]);
        App\Occupation::create(["name" => "⁠Lawyer"]);
        App\Occupation::create(["name" => "Principal, Teacher"]);
        App\Occupation::create(["name" => "⁠Engineer"]);
        App\Occupation::create(["name" => "⁠Accountant"]);
        App\Occupation::create(["name" => "⁠Software Developer"]);
        App\Occupation::create(["name" => "⁠Architect"]);
        App\Occupation::create(["name" => "⁠Manager"]);
        App\Occupation::create(["name" => "⁠Salesperson"]);
        App\Occupation::create(["name" => "⁠Businessman"]);
        App\Occupation::create(["name" => "Artist & Actor"]);
        App\Occupation::create(["name" => "⁠Journalist"]);
        App\Occupation::create(["name" => "⁠Carpenter"]);
        App\Occupation::create(["name" => "⁠Electrician"]);
        App\Occupation::create(["name" => "⁠Driver"]);
        App\Occupation::create(["name" => "⁠Mechanic"]);
        App\Occupation::create(["name" => "⁠Hairdresser"]);
        App\Occupation::create(["name" => "⁠Social Worker"]);
        App\Occupation::create(["name" => "Cook, Chief"]);
        App\Occupation::create(["name" => "⁠Government Officer"]);
        App\Occupation::create(["name" => "Soldier, Police & Amy Officer"]);
        App\Occupation::create(["name" => "⁠Farmer"]);
        App\Occupation::create(["name" => "⁠Miner"]);
        App\Occupation::create(["name" => "⁠Retail Associate"]);
        App\Occupation::create(["name" => "Welder"]);
        App\Occupation::create(["name" => "Plumber"]);
        App\Occupation::create(["name" => "Masons"]);
        App\Occupation::create(["name" => "Politician"]);
        App\Occupation::create(["name" => "Other"]);
    }
}
