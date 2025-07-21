<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Teacher;
use ProactiveAnts\Discipline\Disobedience;

class PointBalance extends Model
{
    protected $table = 'point_balance';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function disobedience()
    {
        return $this->belongsTo(Disobedience::class);
    }
}
