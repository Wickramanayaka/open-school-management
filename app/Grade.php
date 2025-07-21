<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['name'];
    
    public function divisions(){
        return $this->belongsToMany(Division::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function section()
    {
        return $this->belongsToMany(Section::class, 'grade_sections',  'grade_id', 'section_id');
    }

}
