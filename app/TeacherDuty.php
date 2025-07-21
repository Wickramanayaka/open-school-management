<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherDuty extends Model
{
    protected $fillable = ['teacher_id','duty','date','created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
