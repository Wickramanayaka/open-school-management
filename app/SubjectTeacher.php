<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $fillable = ['teacher_id','class_room_id','academic_year_id','subject_id','remark'];

    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
