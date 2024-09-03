<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'salary', 'image', 'manager_name', 'department_id'];
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    // Relationship
    public function employeeDepartment() : BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id' , 'id');
    }


    public function tasks():BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'employee_tasks')
            ->withPivot('status','id')
            ->withTimestamps();
    }

    public function scopeWhenSearch($query , $search)
    {
        if (isset($search['first_name']) && !empty($search['first_name'])) {
            $first_name = $search['first_name'];
             $query->where('first_name', 'like', "%{$first_name}%");
        }
        if (isset($search['last_name']) && !empty($search['last_name'])) {
            $last_name = $search['last_name'];
            $query->where('last_name', 'like', "%{$last_name}%");
        }

        if (isset($search['salary']) && !empty($search['salary'])) {
            $salary = $search['salary'];
            $query->where('salary', 'like', "%{$salary}%");
        }
    } //end of scopeWhenSearch



}
