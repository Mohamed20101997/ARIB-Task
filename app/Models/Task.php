<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['task_name','description','status'];
    protected $appends  = ['status_format'] ;


    public function employees():BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_tasks')
            ->withPivot('status','id')
            ->withTimestamps();
    }
    //scope -----------------------------------
    public function scopeWhenSearch($query , $search)
    {
        if ( isset($search['task_name']) && !empty($search['task_name'])) {
            $task_name = $search['task_name'];
            $query->where('task_name', 'like', "%{$task_name}%");
        }

    } //end of scopeWhenSearch


    public function getStatusFormatAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return '<span style="color: orange;">Pending</span>';
            case 'in_progress':
                return '<span style="color: blue;">In Progress</span>';
            case 'completed':
                return '<span style="color: green;">Completed</span>';
            default:
                return '<span>Unknown</span>';
        }
    }
}
