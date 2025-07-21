<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    protected $fillable = [
        'father_name','father_telephone','father_email','father_occupation','father_name_of_employment','father_address_of_employment','father_office_telephone','father_id_number','father_designation_type','father_income_level','father_education_level','father_protection_level',
        'mother_name','mother_telephone','mother_email','mother_occupation','mother_name_of_employment','mother_address_of_employment','mother_office_telephone','mother_id_number','mother_designation_type','mother_income_level','mother_education_level','mother_protection_level',
        'guardian_name','guardian_telephone','guardian_email','guardian_occupation','guardian_name_of_employment','guardian_address_of_employment','guardian_office_telephone','guardian_id_number','guardian_designation_type','guardian_income_level','guardian_education_level',
        'guardian_protection_level', 'guardian_relation_to_student', 'old_student'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function f_occupation(){
        return $this->hasOne(Occupation::class, 'id', 'father_occupation');
    }

    public function m_occupation(){
        return $this->hasOne(Occupation::class, 'id', 'mother_occupation');
    }

    public function g_occupation(){
        return $this->hasOne(Occupation::class, 'id', 'guardian_occupation');
    }
}
