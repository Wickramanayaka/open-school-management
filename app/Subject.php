<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code','name','description','language_id','grade_id','compulsory','duration'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'subject_teachers')->withPivot(['academic_year_id','class_room_id']);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function scopeCompulsory($query)
    {
        return $query->where('compulsory',1);
    }
}
