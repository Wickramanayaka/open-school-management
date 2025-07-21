<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherJobHistory extends Model
{
    protected $fillable = ['teacher_id','title','company','duration'];
}
