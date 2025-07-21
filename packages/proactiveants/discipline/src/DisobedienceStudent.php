<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Teacher;

class DisobedienceStudent extends Model
{
    protected $fillable = ['disobedience_id', 'student_id', 'point_deduct', 'remark', 'teacher_id', 'date', 'charge_sheet_number', 'academic_year_id'];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function disobedience()
    {
        return $this->belongsTo(Disobedience::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
