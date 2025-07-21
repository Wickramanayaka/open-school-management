<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Database\Eloquent\Model;

class StudentDisciplinePoint extends Model
{
    protected $fillable = ['student_id', 'point', 'date', 'type', 'academic_year_id'];
}
