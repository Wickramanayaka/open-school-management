<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['code','name','academic_year_id','start','end','number_of_days','sequence'];

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
