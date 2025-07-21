<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassRoom;
use App\Student;
use App\Exam;
use App\Subject;
use App\ExamMark;
use App\MarkGrade;
use App\RankIncomplete;

class MobileDeviceController extends Controller
{
    public function index(){
        $exams = Exam::orderBy('id','desc')->where('status','<>','Completed')->get();
        $class_rooms = ClassRoom::get();
        $subjects = Subject::orderBy('grade_id')->get();
        return view('mobile/exams/index', compact('exams', 'class_rooms', 'subjects'));
    }

    public function create(Request $request){
        $exam = Exam::findOrFail($request->exam);
        $class_room = ClassRoom::findOrFail($request->class_room);
        $subject = Subject::findOrFail($request->subject);       
        switch ($request->gender) {
            case 'male':
                $students = Student::where('present_class_room_id',$request->class_room)->where('gender','Male')->orderBy('admission_number')->get();
                break;
            case 'female':
                $students = Student::where('present_class_room_id',$request->class_room)->where('gender','Female')->orderBy('admission_number')->get();
                break;            
            default:
                $students = Student::where('present_class_room_id',$request->class_room)->orderBy('admission_number')->get();
                break;
        }

        // Get previous marks
        foreach ($students as $key => $student) {
            $mark = ExamMark::where('student_id',$student->id)->where('exam_id',$request->exam)->where('subject_id',$request->subject)->first();
            if(!$mark==null){
                $student->mark = $mark;
            }
        }

        // Check the subject and class room is match
        if($class_room->grade->id==$subject->grade_id){
            return view('mobile/exams/create', compact('exam', 'class_room', 'subject', 'students'));
        }
        else{
            return \redirect('/m/')->with("error", "The class room and the subject do not match.");
        }
    }

    public function store(Request $request){
        // Save the marks
        $marks = $request->marks;
        $present_class_room_id = 0;
        foreach ($marks as $key => $value) {
            $is_absent = 0;
            if($value==''){
                continue;
            }
            if ($value=="AB" || $value=="ab") {
                $value = 0;
                $is_absent = 1;
                $valid = 0;
            }
            // Check for update
            $student = Student::findOrFail($key);
            $present_class_room_id = $student->present_class_room_id;
            $mark_grade = MarkGrade::where('low','<=',$value)->where('high','>=',$value)->first();
            $exam_mark = ExamMark::where('student_id',$student->id)->where('exam_id',$request->exam)->where('subject_id',$request->subject)->first();
            if($exam_mark==null){
                ExamMark::create([
                    'exam_id' => $request->exam,
                    'student_id' => $student->id,
                    'subject_id' => $request->subject,
                    'mark' => $value,
                    'is_absent' => $is_absent,
                    'mark_grade' => $mark_grade->grade,
                    'class_room_id' => $student->present_class_room_id
                ]);
            }
            else{
                $exam_mark->mark = $value;
                $exam_mark->is_absent = $is_absent;
                $mark_grade = MarkGrade::where('low','<=',$value)->where('high','>=',$value)->first();
                $exam_mark->mark_grade = $mark_grade->grade;
                $exam_mark->save();
            }
        }

        /**
         * Add record to rank incomplete table to indicate the mark changes and inform to run the rank again
         * if the exam has ranking
         * 
         */
        $exam = Exam::find($request->exam);
        if($exam->has_rank==1){
            $incomplete = RankIncomplete::where('exam_id',$request->exam)->where('class_room_id',$present_class_room_id)->first();
            if($incomplete==null){
                RankIncomplete::create([
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'exam_id' => $request->exam,
                    'class_room_id' => $present_class_room_id
                ]);
            }
            else{
                $incomplete->date = \Carbon\Carbon::now()->format('Y-m-d');
                $incomplete->save();
            }
        }

        return \redirect('/m/')->with("message", "The exam marks have been saved correctly.");
    }

}