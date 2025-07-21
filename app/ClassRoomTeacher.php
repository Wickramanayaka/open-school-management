<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoomTeacher extends Model
{
    protected $fillable = ['teacher_id','class_room_id','academic_year_id','date','comment'];
}
