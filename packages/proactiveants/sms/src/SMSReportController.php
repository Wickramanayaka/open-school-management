<?php

namespace ProactiveAnts\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClassRoom;
use App\Grade;
use ProactiveAnts\SMS\SMSMessage;
use App\Student;

class SMSReportController extends Controller
{
    public function index()
    {
        $class_rooms = ClassRoom::all();
        $grades = Grade::all();
        return view('sms::report', compact('class_rooms', 'grades'));
    }

    public function message(Request $request)
    {
        $messages = SMSMessage::where('date','>=',$request->date_from)->where('date','<=',$request->date_to)->orderBy('date');
        
        if($request->has('grade_id')){
            $class_rooms = ClassRoom::whereIn('grade_id', $request->grade_id)->pluck('id')->toArray();
            $messages = $messages->whereIn('class_room_id',$class_rooms);
        }
        if($request->has('class_room_id')){
            $messages = $messages->whereIn('class_room_id',$request->class_room_id);
        }
        if(!$request->admission_number==''){
            $student = Student::where('admission_number',$request->admission_number)->first();
            if(!$student==null)
            {
                $messages = $messages->where('student_id',$student->id);
            }
        }
        if(!$request->phone==''){
            $messages = $messages->where('phone_number',$request->phone);
        }
        if(!$request->message==''){
            $messages = $messages->where('message','like','%'.$request->message.'%');
        }

        $messages = $messages->get();
        return (string) view('sms::ajax.sms_report', compact('messages'));
    }
}
