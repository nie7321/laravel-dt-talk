<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    public function job_description()
    {
        return $this->belongsTo(JobDescription::class);
    }

    public function employment_type()
    {
        return $this->belongsTo(EmploymentType::class);
    }
}
