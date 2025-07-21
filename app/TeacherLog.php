<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherLog extends Model
{
    protected $fillable = ['teacher_id','remark','date','created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
