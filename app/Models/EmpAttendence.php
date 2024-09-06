<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpAttendence extends Model
{
    
    protected $table = 'hrm_emp_attendence';
    protected $fillable = [
        'attendence_date',
        'branch_id',
        'dept_id',
        'section_id',
        'sub_section_id',
        'designation_id',
        'emp_id',
        'device_id',
        'in_time',
        'out_time',
        'manual_device',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];
}
