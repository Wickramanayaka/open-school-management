<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherExperience extends Model
{
    protected $fillable = ['teacher_id', 'subject', 'grade','type'];
}
