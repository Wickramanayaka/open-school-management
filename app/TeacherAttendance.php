<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    protected $fillable = ['teacher_id','begin_date','end_date','attendance','frequency'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
