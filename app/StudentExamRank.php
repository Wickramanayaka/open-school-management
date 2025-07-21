<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExamRank extends Model
{    
    protected $fillable = ['student_id','exam_id','rank','rank_one_average','total','average','number_of_subject','class_room_id'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
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
