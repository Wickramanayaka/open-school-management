<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'current_section_head','uid'];

    public function grades()
    {
        return $this->belongsToMany(Grade::class,'grade_sections','section_id','grade_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'current_section_head');
    }
}
