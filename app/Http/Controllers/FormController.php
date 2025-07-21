<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teacher;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\UserRole;
use Hash;
use App\School;
use App\House;
use App\ClassRoom;
use App\AcademicYear;
use App\Address;
use App\ClassRoomStudent;
use App\Student;
use App\StudentParent;
use App\EmergencyContact;
use App\Occupation;

class FormController extends Controller
{
    public function create(Request $request){
        $school = School::find(1);
        $houses = House::all();
        $class_rooms = ClassRoom::all();
        $admitted_class_rooms = ClassRoom::all();
        $academic_years = AcademicYear::all();
        if($request->has('g')){
            if($request->has('d')){
                // Check grade and division
                $class_rooms = ClassRoom::where('grade_id', $request->g)->where('division_id', $request->d)->get();
                return view('student-create',compact('school','houses','class_rooms','admitted_class_rooms','academic_years'));
            }
            // Check grade only
            $class_rooms = ClassRoom::where('grade_id', $request->g)->get();
        }
        return view('student-create',compact('school','houses','class_rooms','admitted_class_rooms','academic_years'));
    }

    public function store(Request $request){
        
        //return redirect()->back()->with('message', "error");
        $validated_data = $request->validate([
            'admission_number' => 'required|unique:students',
            'surname' => 'required',
            'first_name' => 'required',
            'admitted_date' => 'required',
            'admitted_academic_year_id' => 'required',
            'admitted_class_room_id' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'house_id' => 'required'
        ]);
        $data = $request->all();
        // Formulate the address
        $address = Address::create($request->all());
        $data = $request->all();
        $data['address_id'] = $address->id;
        // Add present class room
        $data['present_class_room_id'] = $request->present_class_room_id;
        $address->latitude = 0;
        $address->longitude = 0;
        $address->save();
        // Create empty parent record and attache it to student
        $parent = new StudentParent();
        $parent->save();
        $data['student_parent_id'] = $parent->id;
        // Create empty emergency contact record and attached it to student
        $emergency = new EmergencyContact();
        $emergency->save();
        $data['emergency_contact_id'] = $emergency->id;
        // Create student
        $student = Student::create($data);
        // Add record to class_room_students
        // If admitted_class_room defer the present class room
        // Need to create two different record
        if($request->admitted_class_room_id == $request->present_class_room_id){
            ClassRoomStudent::create([
                'student_id' => $student->id,
                'class_room_id' => $request->admitted_class_room_id,
                'academic_year_id' => $request->admitted_academic_year_id,
                'date' => $request->admitted_date,
                'comment' => 'Admission'
            ]);
        }
        else{
            // Admitted Class Room
            ClassRoomStudent::create([
                'student_id' => $student->id,
                'class_room_id' => $request->admitted_class_room_id,
                'academic_year_id' => $request->admitted_academic_year_id,
                'date' => $request->admitted_date,
                'comment' => 'Admission'
            ]);
            // Present Class Room
            ClassRoomStudent::create([
                'student_id' => $student->id,
                'class_room_id' => $request->present_class_room_id,
                'academic_year_id' => getCurrentAcademicYear()->id,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'comment' => 'Present Class Upload'
            ]);
        }
        $school = School::find(1);
        return view('thank-you',compact('school'));
    }

    public function getStudent($admission_number){
        if(!$admission_number==""){
            $student = Student::with('present_class_room')->where('admission_number', $admission_number)->first();
            if($student==null){
                return ['error' => '404'];
            }
            else{
                return $student;
            }
        }
        return ['error' => '404'];
    }
    public function parents(){
        return view('parents-create', ['school' => $school = School::find(1), 'occupations' => Occupation::orderBy('id')->get()]);
    }
    public function postParents(Request $request){
        //dd($request->all());
        $parents = StudentParent::find($request->student_id);
        $parents->update($request->all());
        $school = School::find(1);
        return view('thank-you',compact('school'));
    }

}