<?php

use Illuminate\Database\Seeder;

class PaymentCategoryTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentCategory::create([
            'name' => 'Term Fee'
        ]);
        App\PaymentCategory::create([
            'name' => 'Exam Fee'
        ]);
        App\PaymentCategory::create([
            'name' => 'Donation'
        ]);
        App\PaymentCategory::create([
            'name' => 'Purchasing'
        ]);
        App\PaymentCategory::create([
            'name' => 'Other'
        ]);
    }
}
