<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Core Project Info
            $table->string('project_name');
            $table->unsignedBigInteger('department_id'); // Foreign Key to Departments
            
            // Joyland Specific Attributes
            $table->string('customer_type')->nullable();
            $table->string('sap_customer_code')->nullable();
            $table->integer('warehouse_id')->nullable();
            
            // Logistics & Tracking
            $table->string('location_gps')->nullable();
            $table->string('unit_of_measure')->nullable(); // pcs, liters, units, etc.
            
            // Contact Information
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            
            // Standard Laravel Timestamps
            $table->timestamps();

            // Foreign Key Constraint
            // This ensures every project belongs to a valid department
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}