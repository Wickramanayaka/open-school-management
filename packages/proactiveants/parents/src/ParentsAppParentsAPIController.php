<?php

namespace ProactiveAnts\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ProactiveAnts\Parents\ParentsAppUser;
use App\StudentParent;
use App\School;
use App\Student;

class ParentsAppParentsAPIController extends Controller
{   
    public function getParents(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'token' => 'required',
            'api_key' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $user = ParentsAppUser::where('token', $request->token)->first();
        switch ($user->relation) {
            case 'FATHER':
                $parents = StudentParent::where('father_telephone', $user->telephone)->first();
                break;
            case 'MOTHER':
                $parents = StudentParent::where('mother_telephone', $user->telephone)->first();
                break;
            case 'GUARDIAN':
                $parents = StudentParent::where('guardian_telephone', $user->telephone)->first();
                break;    
            default:
                # code...
                break;
        }
        if($parents==null){
            return response(['message' => 'Parents were not found.'],400);
        }
        $data = [
            'id' => $parents->id,
            'father_name' => $parents->father_name,
            'father_mobile' => $parents->father_telephone,
            'father_email' => $parents->father_email,
            'father_occupation' => $parents->father_occupation,
            'father_name_of_employment' => $parents->father_name_of_employment,
            'father_address_of_employment' => $parents->father_address_of_employment,
            'father_office_telephone' => $parents->father_office_telephone,
            'mother_name' => $parents->mother_name,
            'mother_mobile' => $parents->mother_telephone,
            'mother_email' => $parents->mother_email,
            'mother_occupation' => $parents->mother_occupation,
            'mother_name_of_employment' => $parents->mother_name_of_employment,
            'mother_address_of_employment' => $parents->mother_address_of_employment,
            'mother_office_telephone' => $parents->mother_office_telephone,
            'guardian_name' => $parents->guardian_name,
            'guardian_mobile' => $parents->guardian_telephone,
            'guardian_email' => $parents->guardian_email,
            'guardian_occupation' => $parents->guardian_occupation,
            'guardian_name_of_employment' => $parents->guardian_name_of_employment,
            'guardian_address_of_employment' => $parents->guardian_address_of_employment,
            'guardian_office_telephone' => $parents->guardian_office_telephone,
            'updated_at' => ""
        ];
        return ['parents' => $data];
    }

    public function updateParents(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'token' => 'required',
            'api_key' => 'required',
            'parents' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $parents_user = ParentsAppUser::where('token', $request->token)->firstOrFail();
        $parents_ids = StudentParent::where('father_telephone', $parents_user->telephone)
        ->orWhere('mother_telephone',$parents_user->telephone)
        ->orWhere('guardian_telephone',$parents_user->telephone)
        ->pluck('id')
        ->toArray();
        $students = Student::whereIn('student_parent_id', $parents_ids)->get();
        $data = $request->all();
        $json_data = json_decode($data['parents'],true);
        foreach ($students as $student) {
            $parents = StudentParent::where('id', $student->student_parent_id )->first();
            if($parents==null){

            }
            else{
                $parents->father_email = $json_data['father_email'];
                $parents->father_occupation = $json_data['father_occupation'];
                $parents->father_name_of_employment = $json_data['father_name_of_employment'];
                $parents->father_address_of_employment = $json_data['father_address_of_employment'];
                $parents->father_office_telephone = $json_data['father_office_telephone'];
                $parents->mother_email = $json_data['mother_email'];
                $parents->mother_occupation = $json_data['mother_occupation'];
                $parents->mother_name_of_employment = $json_data['mother_name_of_employment'];
                $parents->mother_address_of_employment = $json_data['mother_address_of_employment'];
                $parents->mother_office_telephone = $json_data['mother_office_telephone'];
                $parents->guardian_email = $json_data['guardian_email'];
                $parents->guardian_occupation = $json_data['guardian_occupation'];
                $parents->guardian_name_of_employment = $json_data['guardian_name_of_employment'];
                $parents->guardian_address_of_employment = $json_data['guardian_address_of_employment'];
                $parents->guardian_office_telephone = $json_data['guardian_office_telephone'];
                $parents->save();
            }
        }
        return response(['message' => 'Update was completed.'],200);
    }

}