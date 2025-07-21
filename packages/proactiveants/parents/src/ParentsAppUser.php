<?php

namespace ProactiveAnts\Parents;

use ProactiveAnts\Parents\ParentsAppPayment;

use Illuminate\Database\Eloquent\Model;

class ParentsAppUser extends Model
{
    protected $fillable = [
        'full_name', 'country_code', 'telephone', 'suspended', 'relation', 'phone_number', 'token', 'otp'
    ];

    public function payments()
    {
        return $this->hasMany(ParentsAppPayment::class)->where('status',1);
    }
}
