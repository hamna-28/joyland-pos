<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        // SQL Server way to disable constraints
        Schema::disableForeignKeyConstraints();
        
        // Clear the table
        Project::truncate();
        
        Schema::enableForeignKeyConstraints();

        $projects = [
            [
                'project_name' => 'Bounce Emporium',
                'department_id' => 1,
                'customer_type' => 'Food Booth',
                'sap_customer_code' => 'C00033',
                'warehouse_id' => 40,
                'location_gps' => '31.5204, 74.3587',
                'unit_of_measure' => 'pcs',
                'customer_email' => 'contact@bounceemporium.pk',
                'customer_phone' => '+92 321 2345678'
            ],
            [
                'project_name' => 'New Product Line Launch',
                'department_id' => 1,
                'customer_type' => 'Internal Prod',
                'sap_customer_code' => 'C00100',
                'warehouse_id' => 41,
                'location_gps' => '31.5820, 74.3290',
                'unit_of_measure' => 'pcs',
                'customer_email' => 'prod@company.com',
                'customer_phone' => '+92 300 1222333'
            ],
            [
                'project_name' => 'Warehouse Reorganization',
                'department_id' => 2,
                'customer_type' => 'Inventory Structuring',
                'sap_customer_code' => 'C00105',
                'warehouse_id' => 37,
                'location_gps' => '31.4504, 73.1350',
                'unit_of_measure' => 'pallets',
                'customer_email' => 'warehouse@company.com',
                'customer_phone' => '+92 300 9988776'
            ],
            [
                'project_name' => 'Procurement Vendor Onboarding',
                'department_id' => 3,
                'customer_type' => 'Supplier Setup',
                'sap_customer_code' => 'C00104',
                'warehouse_id' => 40,
                'location_gps' => '31.5204, 74.3587',
                'unit_of_measure' => 'contracts',
                'customer_email' => 'procurement@company.com',
                'customer_phone' => '+92 321 2223334'
            ],
            [
                'project_name' => 'QC Inspection Expansion',
                'department_id' => 4,
                'customer_type' => 'QC Service',
                'sap_customer_code' => 'C00101',
                'warehouse_id' => 42,
                'location_gps' => '30.3753, 69.3451',
                'unit_of_measure' => 'sets',
                'customer_email' => 'qc@company.com',
                'customer_phone' => '+92 333 4445555'
            ],
            [
                'project_name' => 'Super Space FSM',
                'department_id' => 2,
                'customer_type' => 'Food Booth',
                'sap_customer_code' => 'C00038',
                'warehouse_id' => 37,
                'location_gps' => '31.4504, 73.1350',
                'unit_of_measure' => 'pcs',
                'customer_email' => 'fsm@superspace.com',
                'customer_phone' => '+92 300 1234567'
            ],
            [
                'project_name' => 'Super Space Packages',
                'department_id' => 2,
                'customer_type' => 'Food Booth',
                'sap_customer_code' => 'C00034',
                'warehouse_id' => 39,
                'location_gps' => '33.6261, 73.0718',
                'unit_of_measure' => 'pcs',
                'customer_email' => 'ssp@superspace.com',
                'customer_phone' => '+92 300 7654321'
            ],
            [
                'project_name' => 'IT Factory Tech Upgrade',
                'department_id' => 10,
                'customer_type' => 'IT Infrastructure',
                'sap_customer_code' => 'C00102',
                'warehouse_id' => 37,
                'location_gps' => '33.6844, 73.0479',
                'unit_of_measure' => 'units',
                'customer_email' => 'itupgrade@company.com',
                'customer_phone' => '+92 321 8887777'
            ],
            [
                'project_name' => 'ERP Integration Deployment',
                'department_id' => 10,
                'customer_type' => 'Software Project',
                'sap_customer_code' => 'C00106',
                'warehouse_id' => 38,
                'location_gps' => '24.8607, 67.0011',
                'unit_of_measure' => 'licenses',
                'customer_email' => 'erp@company.com',
                'customer_phone' => '+92 310 1230987'
            ],
            [
                'project_name' => 'Maintenance Tools Deployment',
                'department_id' => 11,
                'customer_type' => 'Tools & Parts',
                'sap_customer_code' => 'C00103',
                'warehouse_id' => 39,
                'location_gps' => '34.0151, 71.5805',
                'unit_of_measure' => 'pcs',
                'customer_email' => 'maintenance@company.com',
                'customer_phone' => '+92 300 5566778'
            ],
            [
                'project_name' => 'Pizza Parlor',
                'department_id' => 2,
                'customer_type' => 'Joeys Cafe',
                'sap_customer_code' => 'C00035',
                'warehouse_id' => 38,
                'location_gps' => '24.8607, 67.0011',
                'unit_of_measure' => 'pcs',
                'customer_email' => 'info@joeyscafe.pk',
                'customer_phone' => '+92 333 9876543'
            ],
            [
                'project_name' => 'JSS Ice Cream Corner',
                'department_id' => 2,
                'customer_type' => 'Ice Cream Corner',
                'sap_customer_code' => 'C00022',
                'warehouse_id' => 27,
                'location_gps' => '24.8607, 67.0011',
                'unit_of_measure' => 'liters',
                'customer_email' => 'sales@jssicecream.pk',
                'customer_phone' => '+92 312 5557788'
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}