<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'admission_number','admitted_academic_year_id','admitted_class_room_id','house_id','cluster_id','surname','first_name','other_name','date_of_birth',
        'id_number','gender','photo','address_id','student_parent_id','emergency_contact_id','admitted_date','present_class_room_id', 'transport_id',
        'distance', 'town','scholarship_mark','telephone','religion','nationality'
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function getFullNameAttribute (){
        return "{$this->surname} {$this->first_name} {$this->other_name}";
    }

    public function getNameWithInitialsAttribute (){
        $name = $this->surname . " " . strtoupper(substr($this->first_name,0,1)) . "." . strtoupper(substr($this->other_name,0,1)) . ".";
        // Remove patter ".." from name with initials
        $name = str_replace("..",".",$name);
        return $name;
    }

    public function admitted_academic_year(){
        return $this->belongsTo(AcademicYear::class,'admitted_academic_year_id');
    }

    public function present_class_room(){
        return $this->belongsTo(ClassRoom::class,'present_class_room_id');
    }

    public function admitted_class_room(){
        return $this->belongsTo(ClassRoom::class,'admitted_class_room_id');
    }

    public function house(){
        return $this->belongsTo(House::class)->withDefault(['name' => 'Not defined']);
    }

    public function cluster(){
        return $this->belongsTo(Cluster::class)->withDefault(['name' => 'Not defined']);
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

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    public function getIdNumAttribute()
    {
        if($this->id_number =='' || $this->id_number==null){
            return "_____NOT FOUND_____";
        }
        else{
            return $this->id_number;
        }
    }

    public function student_parent()
    {
        return $this->belongsTo(StudentParent::class)->withDefault(['father_name'=>'']);
    }

    public function emergency_contact()
    {
        return $this->belongsTo(EmergencyContact::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_left','<>',1)->orWhereNull('is_left');
    }

    public function siblins()
    {
        return $this->hasMany(Siblin::class,'left_student_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subject_students')->withPivot('academic_year_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class,'exam_marks')->withPivot('subject_id','mark','is_absent','mark_grade');
    }
    public function examRanks()
    {
        return $this->belongsToMany(Exam::class,'student_exam_ranks')->withPivot('rank','total','average','number_of_subject','rank_one_average');
    }
    public function transport()
    {
        return $this->belongsTo(Transport::class)->withDefault(['name' => '___Not defined___']);
    }
}
