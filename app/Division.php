<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name'];
    
    public function grades(){
        return $this->belongsToMany(Grade::class);
    }
}
