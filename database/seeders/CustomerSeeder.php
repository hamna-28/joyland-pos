<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the table first to avoid duplicates
        // Using DB::table to avoid model issues during seed
        DB::table('customers')->truncate();

        $customers = [
            [
                'customer_name'  => 'Walk-in Customer',
                'customer_email' => 'walkin@joyland.com',
                'customer_phone' => '0000000000',
                'city'           => 'Lahore',
                'country'        => 'Pakistan',
                'address'        => 'Main Office',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'customer_name'  => 'Standard Project Client',
                'customer_email' => 'client@joyland.com',
                'customer_phone' => '03001234567',
                'city'           => 'Faisalabad',
                'country'        => 'Pakistan',
                'address'        => 'Industrial Area',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        ];

        DB::table('customers')->insert($customers);
    }
}