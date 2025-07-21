<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkGrade extends Model
{
    protected $fillable = ['low','high','grade'];
}
