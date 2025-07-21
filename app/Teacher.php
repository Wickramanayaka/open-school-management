<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Teacher extends Model
{
    use HasRoles;

    protected $guard_name = 'web';
 
    protected $fillable = [
        'surname','first_name','other_name','date_of_birth','id_number','gender','photo','address_id',
        'telephone','email','present_class_room_id','is_left','reason_left','date_left','admission_number',
        'town','civil_status','distance','transport_id','appointment_category','appointment_date',
        'appointment_date_this_school','appointment_subject','highest_education_qualification',
        'highest_professional_qualification','given_name','temporary_address_id'
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function temporaryAddress(){
        return $this->belongsTo(Address::class,'temporary_address_id')->withDefault(['address' => '___Not defined___']);
    }

    public function getFullNameAttribute (){
        return "{$this->surname} {$this->first_name} {$this->other_name}";
    }

    public function getNameWithInitialsAttribute (){
        return $this->surname . " " . strtoupper(substr($this->first_name,0,1)) . "." . strtoupper(substr($this->other_name,0,1)) . ".";
    }

    public function getPhotoAttribute($value){
        if($value==null || $value==''){
            return 'default.png';
        }
        else{
            return $value;
        }
    }
    
    public function getHTTPFormatNameAttribute (){
        $name =  "{$this->first_name} {$this->other_name} {$this->surname}";
        $name = str_replace(' ','%20',$name);
        return $name;

    }

    public function present_class_room(){
        return $this->belongsTo(ClassRoom::class,'present_class_room_id')
            ->withDefault(function(){
                return new ClassRoom();
            });
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_left','<>',1)->orWhereNull('is_left');
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class)->withDefault(['name' => '___Not defined___']);
    }
    public function experiences()
    {
        return $this->hasMany(TeacherExperience::class);
    }
}
