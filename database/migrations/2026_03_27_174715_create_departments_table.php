<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // bigint, Primary Key
            $table->string('name', 100);
            $table->string('code', 20)->unique();
            $table->string('dep_type', 50); // Core, Business, or Tech
            
            // manager_id linked to the users table
            $table->unsignedBigInteger('manager_id')->nullable();
            
            // 1 for Active, 0 for Inactive
            $table->tinyInteger('status')->default(1); 
            
            // Using text() works perfectly with SQL Server (NVARCHAR(MAX))
            $table->text('description')->nullable(); 
            
            $table->timestamps(); // creates created_at and updated_at

            // Foreign key relationship
            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};