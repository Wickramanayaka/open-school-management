<?php

namespace ProactiveAnts\SMS;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    protected $fillable = [
        'message','length'
    ];
}
