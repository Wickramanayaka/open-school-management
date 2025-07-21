<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'url', 'number', 'grade_id', 'subject_id'];
}
