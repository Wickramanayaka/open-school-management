<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name','address','telephone','email','logo','anthem_audio','anthem','flag'];
}
