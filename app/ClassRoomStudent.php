<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoomStudent extends Model
{
    protected $fillable = ['student_id','class_room_id','academic_year_id','date','comment'];
}
