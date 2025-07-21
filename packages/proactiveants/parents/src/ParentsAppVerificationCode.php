<?php

namespace ProactiveAnts\Parents;

use Illuminate\Database\Eloquent\Model;

class ParentsAppVerificationCode extends Model
{
    protected $fillable = [
        'country_code', 'telephone', 'phone_number', 'otp', 'expired_at'
    ];
}
