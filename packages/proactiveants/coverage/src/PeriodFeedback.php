<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;
use App\ClassRoom;
use App\Subject;


class PeriodFeedback extends Model
{
    protected $table = 'period_feedback';

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
