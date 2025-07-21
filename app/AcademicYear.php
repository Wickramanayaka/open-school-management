<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = ['name','start','end'];

    public function getFullNameAttribute($value)
    {
        return "{$this->name} (from {$this->start} to {$this->end})";
    }
    
    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
