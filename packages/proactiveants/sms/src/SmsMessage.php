<?php

namespace ProactiveAnts\SMS;

use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    protected $fillable = [
        'message','type','student_id','class_room_id','teacher_id','phone_number','sms_template_id',
        'date','created_by','number_of_sms','length','parents','delivery','gateway_token'
    ];

    public function student()
    {
        return $this->belongsTo(\App\Student::class);
    }

    public function class_room()
    {
        return $this->belongsTo(\App\ClassRoom::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class,'created_by');
    }
}
