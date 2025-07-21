<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    protected $fillable = ['student_id','exam_id','mark','is_absent','not_relavent','subject_id','mark_grade','class_room_id'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
