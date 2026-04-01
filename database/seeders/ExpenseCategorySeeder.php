<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Clear the table safely
        DB::table('expense_categories')->delete();

        // 2. Define data using ONLY the columns your database actually has
        $categories = [
            ['category_name' => 'Food Items', 'category_description' => 'Catering and snacks'],
            ['category_name' => 'IT Equipment', 'category_description' => 'Laptops and networking'],
            ['category_name' => 'Construction Materials', 'category_description' => 'Project build materials'],
            ['category_name' => 'Emergency Supplies', 'category_description' => 'Safety and first aid'],
            ['category_name' => 'Cleaning Supplies', 'category_description' => 'Janitorial items'],
            ['category_name' => 'Furniture', 'category_description' => 'Office furniture'],
            ['category_name' => 'Spare Parts', 'category_description' => 'Mechanical spares'],
            ['category_name' => 'Mechanical Parts', 'category_description' => 'Engine parts'],
            ['category_name' => 'Electrical Components', 'category_description' => 'Wiring and panels'],
        ];

        // 3. Insert into the database
        foreach ($categories as $category) {
            // Adding timestamps manually since we aren't using a Model
            $category['created_at'] = now();
            $category['updated_at'] = now();
            
            DB::table('expense_categories')->insert($category);
        }
    }
}