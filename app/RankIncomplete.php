<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RankIncomplete extends Model
{
    protected $fillable = ['date','class_room_id','exam_id'];

    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
