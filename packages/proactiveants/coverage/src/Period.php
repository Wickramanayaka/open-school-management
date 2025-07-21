<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;
use App\ClassRoom;
use App\Subject;

class Period extends Model
{
    protected $fillable = ['teacher_id', 'date' ,'time_in', 'time_out', 'class_room_id', 
    'type', 'teacher_role', 'subject_id', 'academic_year_id','difference', 'combined_code'];

    protected $dates = ['time_in','time_out'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
