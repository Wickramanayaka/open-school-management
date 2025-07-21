<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;
use App\ClassRoom;
use App\Subject;

class Warning extends Model
{
    protected $fillable = ['class_room_id','teacher_id','warning_on','warning_off','warning_off_by'];
}
