<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name'        => 'Production',
                'code'        => 'PROD',
                'dep_type'    => 'Core',
                'description' => 'Manages raw material conversion to finished goods.'
            ],
            [
                'name'        => 'Warehouse',
                'code'        => 'WHSE',
                'dep_type'    => 'Core',
                'description' => 'Primary storage, stock receiving, and distribution hub.'
            ],
            [
                'name'        => 'Procurement',
                'code'        => 'PURC',
                'dep_type'    => 'Core',
                'description' => 'Responsible for vendor relations and material sourcing.'
            ],
            [
                'name'        => 'Quality Control',
                'code'        => 'QC-01',
                'dep_type'    => 'Core',
                'description' => 'Ensures all incoming/outgoing items meet Joyland standards.'
            ],
            [
                'name'        => 'Sales',
                'code'        => 'SLS',
                'dep_type'    => 'Business',
                'description' => 'Manages customer orders and finished goods requests.'
            ],
            [
                'name'        => 'Marketing',
                'code'        => 'MKT',
                'dep_type'    => 'Business',
                'description' => 'Uses promotional stock and branded inventory for ads.'
            ],
            [
                'name'        => 'Finance',
                'code'        => 'FIN',
                'dep_type'    => 'Business',
                'description' => 'Handles accounts payable/receivable and cost centers.'
            ],
            [
                'name'        => 'Human Resources',
                'code'        => 'HR-01',
                'dep_type'    => 'Business',
                'description' => 'Manages staff, payroll, and internal office requirements.'
            ],
            [
                'name'        => 'IT Department',
                'code'        => 'IT-DEPT',
                'dep_type'    => 'Tech',
                'description' => 'Manages hardware, software, and networking assets.'
            ],
            [
                'name'        => 'Maintenance',
                'code'        => 'MNT',
                'dep_type'    => 'Tech',
                'description' => 'Responsible for machinery repair and spare parts inventory.'
            ],
            [
                'name'        => 'Administration',
                'code'        => 'ADMIN',
                'dep_type'    => 'Tech',
                'description' => 'General office management and utility consumption.'
            ],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}