<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;
use ProactiveAnts\Coverage\Period;

class Feedback extends Model
{
    protected $fillable = ['teacher_id','period_id','point'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
