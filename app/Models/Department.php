<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Department extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Laravel usually assumes 'departments', but it's good practice to define it.
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     * Added 'manager_id', 'status', and 'description' to make them editable.
     */
    protected $fillable = [
        'name',
        'code',
        'dep_type',
        'manager_id',
        'status',
        'description',
    ];

    /**
     * Relationship: A Department belongs to a Manager (User).
     * This allows us to use $department->manager->name in the view.
     */
    public function manager()
    {
        // We link manager_id from the departments table to the id of the users table
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Scope for active departments (Optional helper)
     * Usage: Department::active()->get();
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}