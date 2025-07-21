<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $fillable = ['student_id','begin_date','end_date','frequency','attendance','remark'];
}
