<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\School::create([
            'name' => 'Isipathana College',
            'address' => 'Havlock Town, Colombo 05, Sri Lanka',
            'telephone' => '+94 112003005',
            'email' => 'nc@gmail.com',
            'logo' => 'logo.jpg',
            'flag' => 'flag.jpg',
            'anthem_audio'=> 'audio.mp3',
            'anthem' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia fugit facilis saepe repellat aperiam ullam deleniti dolorem id et animi mollitia distinctio molestiae, pariatur debitis obcaecati eos eaque soluta error."
        ]);
    }
}
