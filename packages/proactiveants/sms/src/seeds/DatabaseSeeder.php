<?php

namespace ProactiveAnts\SMS\Seeds;

use Illuminate\Database\Seeder;
use ProactiveAnts\SMS\SmsTemplate;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SMSTemplate::create([
            'id' => 1,
            'message' => 'This is the absent message',
            'length' => '26'
        ]);  
        SMSTemplate::create([
            'id' => 2,
            'message' => 'This is the discipline message',
            'length' => '31'
        ]);        
    }
}
