<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['name','grade_id','division_id'];
        
    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class,'class_room_students','class_room_id','student_id');
    }
    public function currentStudents()
    {
        return $this->hasMany(Student::class,'present_class_room_id','id');
    }
}
