<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Database\Eloquent\Model;

class Disobedience extends Model
{
    protected $fillable = ['name', 'description', 'disobedience_category_id'];
    public function category()
    {
        return $this->belongsTo(DisobedienceCategory::class,'disobedience_category_id','id');
    }
}
