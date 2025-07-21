<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siblin extends Model
{
    protected $fillable = ['left_student_id','right_student_id','ralation'];

    public function rightStudent()
    {
        return $this->belongsTo(Student::class,'right_student_id');
    }
}
