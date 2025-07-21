<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentLog extends Model
{
    protected $fillable = ['student_id', 'remark', 'date', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
