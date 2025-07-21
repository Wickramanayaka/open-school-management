<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectStudent extends Model
{
    protected $fillable = ['student_id','subject_id','academic_year_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
