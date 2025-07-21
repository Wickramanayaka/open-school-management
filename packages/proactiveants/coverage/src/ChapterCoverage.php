<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Database\Eloquent\Model;

class ChapterCoverage extends Model
{
    protected $fillable = ['covered' ,'chapter_id', 'period_id', 'teacher_id','class_room_id'];

    public function chapter(Type $var = null)
    {
        return $this->belongsTo(Chapter::class);
    }
}
