<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    //relation ---------------------------------
    public function departmentEmployees():HasMany
    {
        return  $this->hasMany(Employee::class , 'department_id','id');
    }


    //scope -----------------------------------
    public function scopeWhenSearch($query , $search)
    {

        if ( isset($search['name']) && !empty($search['name'])) {
            $name = $search['name'];
             $query->where('name', 'like', "%{$name}%");
        }

    } //end of scopeWhenSearch
}
