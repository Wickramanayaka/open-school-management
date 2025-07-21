<?php

namespace ProactiveAnts\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProactiveAnts\SMS\SmsCount;
use ProactiveAnts\SMS\SmsMessage;
use App\House;
use App\Section;
use App\Cluster;
use App\Grade;
use App\ClassRoom;
use App\Teacher;
use Auth;
use App\Student;
use App\Parents;
use App\Jobs\SendSMS;

class SMSController extends Controller
{
    public function index()
    {
        $sms_count = SmsCount::all();
        $houses = House::all();
        $clusters = Cluster::all();
        $sections = Section::all();
        $grades = Grade::all();
        $class_rooms = ClassRoom::all();
        $teachers = Teacher::all();
        return view('sms::index',compact('sms_count','houses','clusters','sections','grades','class_rooms','teachers'));
    }

    public function store(Request $request)
    {
        //dd(ceil(161/160));

        $this->validate($request,[
            'message' => 'required',
        ]);
        
        // Create sms message
        // Check phone numbers are not empty then ignore bottom parameters
        if(!$request->telephone==null){
            // Convert to array
            $telephones = explode(',', $request->telephone);
            foreach($telephones as $phone){
                $sms = SMSMessage::create([
                    'message' => $request->message,
                    'type' => 'custom_number',
                    'phone_number' => $phone,
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'created_by' => Auth::user()->id,
                    'number_of_sms' => ceil(strlen($request->message)/config('sms.max_sms_length')),
                    'length' => strlen($request->message),
                    'delivery' => 0
                ]);
                // Send sms function here
                SendSMS::dispatch($sms);
            }
            return redirect('sms/result')->with('alert','The sms has been sent successfuly.');
        }
        // Create message
        switch ($request->type) {
            case 'entire_students':
                $students = Student::active()->get();
                    foreach ($students as $key => $student) {
                    $this->build($request, $student);
                }
                break;

            case 'entire_teachers':
                $teachers = Teacher::active()->get();
                    foreach ($teachers as $key => $teacher) {
                    $this->buildT($request, $teachers);
                }
                break;

            case 'house':
                foreach($request->house as $item){
                    $students = Student::where('house_id',$item)->active()->get();
                    foreach ($students as $key => $student) {
                        $this->build($request, $student);
                    }
                }
                break;

            case 'cluster':
                foreach($request->cluster as $item){
                    $students = Student::where('cluster_id',$item)->active()->get();
                    foreach ($students as $key => $student) {
                        $this->build($request, $student);
                    }
                }
                break;

            case 'grade':
                foreach($request->grade as $item){
                    $class_rooms = ClassRoom::where('grade_id',$item)->get();
                    foreach ($class_rooms as $key => $class_room) {
                        $students = Student::where('present_class_room_id',$class_room->id)->active()->get();
                        foreach ($students as $key => $student) {
                            $this->build($request, $student);
                        }
                    }
                    
                }
                break;
            case 'class_room':
                foreach($request->class_room as $item){
                    $students = Student::where('present_class_room_id',$item)->active()->get();
                    foreach ($students as $key => $student) {
                        $this->build($request, $student);
                    }
                }
                break;
            
            case 'teacher':
                $teachers = Teacher::whereIn('id', $request->teacher)->get();
                    foreach ($teachers as $teacher) {
                    $this->buildT($request, $teacher);
                }       
                break;

            default:
                # code...
                break;
        }
        return redirect('sms/result')->with('alert','The sms has been sent successfuly.');
        
    }

    private function build(Request $request, Student $student){
        if($request->has('chk_father')){
            if(!$student->student_parent->father_telephone==null && !$student->student_parent->father_telephone==''){
                $sms = SMSMessage::create([
                    'message' => $request->message,
                    'type' => $request->type,
                    'phone_number' => $student->student_parent->father_telephone,
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'created_by' => Auth::user()->id,
                    'number_of_sms' => ceil(strlen($request->message)/config('sms.max_sms_length')),
                    'length' => strlen($request->message),
                    'delivery' => 0,
                    'student_id' => $student->id,
                    'class_room_id' => $student->present_class_room->id,
                    'parents' => 'Father'
                ]);
                // Send sms function here
                SendSMS::dispatch($sms);
            }
            
        }
        if($request->has('chk_mother')){
            if(!$student->student_parent->mother_telephone==null && !$student->student_parent->mother_telephone==''){
                $sms = SMSMessage::create([
                    'message' => $request->message,
                    'type' => $request->type,
                    'phone_number' => $student->student_parent->mother_telephone,
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'created_by' => Auth::user()->id,
                    'number_of_sms' => ceil(strlen($request->message)/config('sms.max_sms_length')),
                    'length' => strlen($request->message),
                    'delivery' => 0,
                    'student_id' => $student->id,
                    'class_room_id' => $student->present_class_room->id,
                    'parents' => 'Mother'
                ]);
                // Send sms function here
                SendSMS::dispatch($sms);
            }
            
        }
        if($request->has('chk_guardian')){
            if(!$student->student_parent->guardian_telephone==null && !$student->student_parent->guardian_telephone==''){
                $sms = SMSMessage::create([
                    'message' => $request->message,
                    'type' => $request->type,
                    'phone_number' => $student->student_parent->guardian_telephone,
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'created_by' => Auth::user()->id,
                    'number_of_sms' => ceil(strlen($request->message)/config('sms.max_sms_length')),
                    'length' => strlen($request->message),
                    'delivery' => 0,
                    'student_id' => $student->id,
                    'class_room_id' => $student->present_class_room->id,
                    'parents' => 'Guardian'
                ]);
                // Send sms function here
                SendSMS::dispatch($sms);
            }
            
        }

    }
    private function buildT(Request $request, Teacher $teacher){
        
        if(!$teacher->telephone==null && !$teacher->telephone==''){
            $sms = SMSMessage::create([
                'message' => $request->message,
                'type' => $request->type,
                'phone_number' => $teacher->telephone,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'created_by' => Auth::user()->id,
                'number_of_sms' => ceil(strlen($request->message)/config('sms.max_sms_length')),
                'length' => strlen($request->message),
                'delivery' => 0,
                'teacher_id' => $teacher->id,
            ]);
            // Send sms function here
            SendSMS::dispatch($sms);
        }
    }

    public function result(){
        return view('sms::result');
    }
}
