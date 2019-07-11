<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDescription extends Model
{
    use SoftDeletes;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
