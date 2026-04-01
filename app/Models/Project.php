<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name',
        'department_id',
        'customer_type',
        'sap_customer_code',
        'warehouse_id',
        'location_gps',
        'unit_of_measure',
        'customer_email',
        'customer_phone',
    ];

    /**
     * Relationship: A project belongs to a Department.
     * This allows you to call $project->department->name
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}