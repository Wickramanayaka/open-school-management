<?php

namespace ProactiveAnts\Coverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\ClassRoom;
use App\Student;
use ProactiveAnts\Coverage\Chapter;
use ProactiveAnts\Coverage\Period;
use App\StudentAttendance;
use ProactiveAnts\Coverage\ChapterCoverage;
use App\Teacher;
use App\User;
use App\Grade;
use ProactiveAnts\Coverage\Warning;

class CoverageController extends Controller
{
    public function index()
    {
       // Loan main monitoring view
    }
    public function check()
    {
        return response()->json(['data' => ['message' => 'Okay']]);
    }
    public function subject(Request $request)
    {
        // Get subjects for the class room
        $class_room = ClassRoom::find($request->id);
        $subjects = Subject::where('grade_id',$class_room->grade_id)->get();
        $data = [];
        foreach ($subjects as $subject) {
            $data[] = [
                'id' => $subject->id,
                'name' => $subject->name,
                'language' => $subject->language->name
            ];
        }
        return ['subject'=>$data];
    }
    public function student(Request $request)
    {
        $students = Student::select(['id','surname','first_name'])->where('present_class_room_id',$request->id)->get();
        $i = 1;
        $data = [];
        foreach($students as $student){
            $data[] = [
                'id' => $student->id,
                'surname' => $student->surname,
                'first_name' => $student->first_name,
                'student_id' => $i
            ];
            $i++;
        }
        return ['student'=>$data];
    }
    public function chapter(Request $request)
    {
        $chapters = Chapter::where('subject_id', $request->id)->select(['id', 'number', 'name'])->orderBy('number')->get();
        return ['chapter'=> $chapters];
    }
    public function classRoom(Request $request)
    {
        $classRooms = ClassRoom::select(['id','name'])->get();
        return ['class_room'=> $classRooms]; 
    }
    public function register(Request $request)
    {
        $validated_data = $request->validate([
            'teacher_id' => 'required',
            'class_room_id' => 'required',
            'student_ids' => 'required'
        ]);
        // Convert user id to teacher id
        $user = User::find($request->teacher_id); 
        // Create period record for register marking
        Period::create([
            'teacher_id' => $user->teacher_id,
            'class_room_id' => $request->class_room_id,
            'type' => 'REGISTER',
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'time_in' => \Carbon\Carbon::now(),
            'time_out' => \Carbon\Carbon::now()
        ]);
        // Create student attendance records
        foreach ($request->student_ids as $student) {
            // Prevent duplicate
            $attendance = StudentAttendance::where('student_id',$student)->where('begin_date',\Carbon\Carbon::now()->format('Y-m-d'))->first();
            if($attendance==null){
                StudentAttendance::create([
                    'student_id' => $student,
                    'begin_date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'frequency' => 30,
                    'attendance' => 1,
                    'remark' => 'Attendance through mobile application.'
                ]);
            }
        }
        // If the SMS module installed use the event
        if(class_exists('\App\Events\AttendanceMarking'))
        {
            // Get absebt students
            $students = Student::where('present_class_room_id', $request->class_room_id)->whereNotIn('id',$request->student_ids)->get();
            foreach($students as $student){
                event(new \App\Events\AttendanceMarking($student));
            }
        }
        return ['message' => 'Register marking has been done successfully.'];
    }
    public function periodBegin(Request $request)
    {
        $validated_data = $request->validate([
            'teacher_id' => 'required',
            'class_room_id' => 'required',
            'subject_id' => 'required',
            'teacher_type' => 'required'
        ]);
        // Convert user id to teacher id
        $user = User::find($request->teacher_id); 
        // Create period record for teaching
        // Check for mutiple class room

        if($request->has('combined_class') && count($request->combined_class) > 0){
            $combined_code = str_random(64).time();
            foreach($request->combined_class as $i){
                $period = Period::create([
                    'teacher_id' => $user->teacher_id,
                    'class_room_id' => $i,
                    'type' => 'TEACHING',
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'time_in' => \Carbon\Carbon::now(),
                    'teacher_role' => $request->teacher_type==1?'REGULAR':'TEMPORARY',
                    'subject_id' => $request->subject_id,
                    'academic_year_id' => getCurrentAcademicYear()->id,
                    'combined_code' => $combined_code
                ]);
            }
        }
        else{
            $period = Period::create([
                'teacher_id' => $user->teacher_id,
                'class_room_id' => $request->class_room_id,
                'type' => 'TEACHING',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time_in' => \Carbon\Carbon::now(),
                'teacher_role' => $request->teacher_type==1?'REGULAR':'TEMPORARY',
                'subject_id' => $request->subject_id,
                'academic_year_id' => getCurrentAcademicYear()->id,
                'combined_code' => str_random(64).time()
            ]);
        }
        
        // Chapter coverage
        // ChapterCoverage::create([
        //     'covered' => 0 ,
        //     'chapter_id' => $request->chapter_id, 
        //     'period_id' => $period->id, 
        //     'teacher_id' => $request->teacher_id,
        //     'class_room_id' => $request->class_room_id
        // ]);
        // $chapter = Chapter::find($request->chapter_id);
        // // Check for chapter current progress
        // $coverage = ChapterCoverage::where('chapter_id', $chapter->id)->where('class_room_id',$request->class_room_id)->orderBy('covered','desc')->first();
        // if(!$coverage==null){
        //     $coverage = $coverage->covered;
        // }
        // else{
        //     $coverage = 0;
        // }  
        $subject = Subject::find($request->subject_id);     
        return ['period' => ['id'=>$period->id,'subject'=>$subject->name." (".$subject->language->name.")" ]];
    }
    public function periodComplete(Request $request)
    {
        $validated_data = $request->validate([
            'period_id' => 'required',
        ]);
        $period = Period::findOrFail($request->period_id);
        // Check for ended time
        if($request->ended_at==0){
            $ended_at = \Carbon\Carbon::now();
        }
        else{
            $data = $request->ended_at;
            $data = explode(':',$data);
            $ended_at = \Carbon\Carbon::create($period->time_in->format('Y'),$period->time_in->format('m'),$period->time_in->format('d'),$data[0],$data[1]);
        }
        // Closing multiple records with combined class room
        $cobined_periods = Period::where('combined_code',$period->combined_code)->get();
        foreach($cobined_periods as $period){
            $period->time_out = $ended_at;
            $period->difference = $ended_at->diffInMinutes($period->time_in);
            $period->save();
        }
        
        // Update syllabus coverage
        // $coverage = ChapterCoverage::where('period_id',$period->id)->firstOrFail();
        // $coverage->covered = 0;
        // $coverage->save();
        return ['message' => 'Syllabus progress has been updated successfully.'];
    }
    public function periodIncomplete(Request $request)
    {
        $validated_data = $request->validate([
            'teacher_id' => 'required',
            'class_room_id' => 'required'
        ]);
        // Convert user id to teacher id
        $user = User::find($request->teacher_id); 
        // If the class room is the different other than typical class room. Get incomplete without class room id
        $class_room = ClassRoom::find($request->class_room_id);
        //if($class_room<>null && substr($class_room->name,-6)=="DEVICE"){
            // Check for incomplete period for a teacher
            $period = Period::where('teacher_id', $user->teacher_id)
            ->whereNull('time_out')
            ->where('type','TEACHING')
            ->first();
        //}
        /**else{
            // Check for incomplete period for a teacher and a class room
            $period = Period::where('teacher_id', $user->teacher_id)
            ->where('class_room_id',$request->class_room_id)
            ->whereNull('time_out')
            ->where('type','TEACHING')
            ->first();
        }*/
        if($period==null){
            return ['period' => ['id'=>'0','chapter'=>'none','coverage'=>0,'subject'=>'none' ]];
        }
        // $coverage = ChapterCoverage::where('period_id',$period->id)->firstOrFail();

        // // Check for chapter current progress
        // $chapter_coverage = ChapterCoverage::where('chapter_id', $coverage->chapter->id)->orderBy('covered','desc')->first();
        // if(!$chapter_coverage==null){
        //     $covered = $chapter_coverage->covered;
        // }
        // else{
        //     $covered = 0;
        // }       

        return ['period' => ['id'=>$period->id,'subject'=>$period->subject->name." (".$period->subject->language->name.")", 'date' => $period->date, 'time_in' => $period->time_in->format('H:m:s') ]];

    }
    public function info(Request $request)
    {
        $validated_data = $request->validate([
            'class_room_id' => 'required'
        ]);
        $class_room = ClassRoom::findOrFail($request->class_room_id);
        $teacher = Teacher::where('present_class_room_id',$class_room->id)->first();
        if($teacher==null){
            $teacher = "Not defined";
        }
        else{
            $teacher = $teacher->fullName;
        }
        $students = [];
        $absent = 0 ;
        foreach ($class_room->currentStudents as $student) {
            if($student->is_left==0){
                // Check today attendance
                $att = StudentAttendance::where('begin_date',\Carbon\Carbon::now()->format('Y-m-d'))->where('student_id',$student->id)->first();
                if($att==null){
                    $students[] = [
                        'id' => $student->id,
                        'name' => $student->fullName,
                        'admission_number' => $student->admission_number,
                        'attendance' => 0
                    ];
                    $absent++;
                }
                else{
                    $students[] = [
                        'id' => $student->admission_number,
                        'first_name' => $student->first_name,
                        'surname' => $student->surname,
                        'attendance' => $att->attendance
                    ];
                }
            }
            
            
        }
        return ['student'=>$students,'class_teacher'=>$teacher, 'total_student'=>count($students), 'absent_student'=>$absent, 'class_room'=>$class_room->name];
    }

    public function grade(Request $request)
    {
        $grades = Grade::select(['id','name'])->get();
        return ['grade'=> $grades]; 
    }

    public function gradeClassRoom(Request $request)
    {
        $classRooms = ClassRoom::select(['id','name'])->where('grade_id',$request->grade_id)->get();
        return ['class_room'=> $classRooms]; 
    }

    public function gradeSubject(Request $request)
    {
        // Get subjects for the class room
        $subjects = Subject::where('grade_id',$request->id)->get();
        $data = [];
        foreach ($subjects as $subject) {
            $data[] = [
                'id' => $subject->id,
                'name' => $subject->name,
                'language' => $subject->language->name
            ];
        }
        return ['subject'=>$data];
    }

    public function warningOn(Request $request)
    {
        $validated_data = $request->validate([
            'teacher_id' => 'required',
            'class_room_id' => 'required'
        ]);
        // Convert user id to teacher id
        $user = User::find($request->teacher_id);
        // Check for not off warning for the same class
        $warning = Warning::where('class_room_id',$request->class_room_id)->whereNull('warning_off')->first();
        if($warning==null){
            Warning::create([
                'teacher_id' => $request->teacher_id,
                'class_room_id' => $request->class_room_id,
                'warning_on' => \Carbon\Carbon::now()
            ]); 
        }
        else{
            // nothing
        }
        
        return ['message' => 'The warning has been on.'];
    }

    public function warningOff(Request $request)
    {
        $validated_data = $request->validate([
            'teacher_id' => 'required',
            'class_room_id' => 'required'
        ]);
        // Convert user id to teacher id
        $user = User::find($request->teacher_id); 
        $warning = Warning::where('class_room_id',$request->class_room_id)->whereNull('warning_off')->first();
        $warning->warning_off = \Carbon\Carbon::now();
        $warning->warning_off_by = $request->teacher_id;
        $warning->save();
        return ['message' => 'The warning has been off.'];
    }

    public function warningCheck(Request $request)
    {
        $validated_data = $request->validate([
            'class_room_id' => 'required'
        ]);
        $warning = Warning::where('class_room_id',$request->class_room_id)->whereNull('warning_off')->first();
        if ($warning==null){
            return ['status' =>  'off'];
        }
        return ['status' =>  'on'];
    }


}
