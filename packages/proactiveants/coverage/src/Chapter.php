<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;
use App\Subject;

class Chapter extends Model
{
    protected $fillable = ['subject_id', 'name', 'number','number_of_period'];

    public function subject(Type $var = null)
    {
       return $this->belongsTo(Subject::class);
    }
}
