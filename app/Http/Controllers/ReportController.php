<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\ClassRoom;
use App\Subject;
use App\Exam;
use App\Student;
use App\ExamMark;
use App\StudentExamRank;
use App\House;
use App\Cluster;
use App\Transport;
use App\Teacher;
use App\StudentParent;
use App\ClassRoomStudent;
use App\Term;
use App\Language;
use App\Occupation;

class ReportController extends Controller
{
    public function index()
    {
        $exams = Exam::orderBy('id','desc')->get();
        $class_rooms = ClassRoom::all();
        return view('reports.index',compact('exams','class_rooms'));
    }
    public function educational()
    {
        $grades = Grade::whereIn('id',[1,2,3,4,5,6,7,8,9,10,11,12,13,14])->get();
        $subjects = Subject::all();
        $exams = Exam::all();
        $languages = Language::all();
        return view('reports.educational', compact('grades', 'languages', 'subjects', 'exams'));
    }
    public function postEducational(Request $request)
    {
        $validated_data = $request->validate([
            'subject' => 'required',
            'exam' => 'required',
            'mark_from' => 'required',
            'mark_to' => 'required',
        ]);

        $exam = Exam::findOrFail($request->exam);
        $students = ExamMark::selectRaw('student_id, count(id) as number')
            ->where('exam_id',$request->exam)
            ->whereIn('subject_id', $request->subject)
            ->where('mark','>=', $request->mark_from)
            ->where('mark','<=', $request->mark_to)
            ->orderBy('student_id')
            ->groupBy('student_id')
            ->having('number','=',count($request->subject))
            ->pluck('student_id');

        if(!$request->has('grade') && !$request->has('class_room')){
           $students = $students->toArray();
        }
        elseif ($request->has('class_room')) {
            $std = ClassRoomStudent::whereIn('class_room_id',$request->class_room)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
            $students = ExamMark::selectRaw('student_id, count(id) as number')
            ->where('exam_id',$request->exam)
            ->whereIn('subject_id', $request->subject)
            ->where('mark','>=', $request->mark_from)
            ->where('mark','<=', $request->mark_to)
            ->whereIn('student_id',$std)
            ->orderBy('student_id')
            ->groupBy('student_id')
            ->having('number','=',count($request->subject))
            ->pluck('student_id')->toArray();
            
        }
        elseif ($request->has('grade')) {
            $class_rooms = ClassRoom::where('grade_id', $request->grade)->pluck('id')->toArray(); 
            $std = ClassRoomStudent::whereIn('class_room_id',$class_rooms)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
            $students = ExamMark::selectRaw('student_id, count(id) as number')
            ->where('exam_id',$request->exam)
            ->whereIn('subject_id', $request->subject)
            ->where('mark','>=', $request->mark_from)
            ->where('mark','<=', $request->mark_to)
            ->whereIn('student_id',$std)
            ->orderBy('student_id')
            ->groupBy('student_id')
            ->having('number','=',count($request->subject))
            ->pluck('student_id')->toArray();

        }
        else{
            $students = $students->toArray();
        }  
        
        $list = ExamMark::where('exam_id',$request->exam)
            ->whereIn('subject_id', $request->subject)
            ->where('mark','>=', $request->mark_from)
            ->where('mark','<=', $request->mark_to)
            ->whereIn('student_id',$students)
            ->orderBy('student_id')
            ->get();

        return (String) view('partials.ajax.educational_report',['list'=>$list,'exam' =>$exam]);

    }
    public function exam()
    {
        $grades = Grade::whereIn('id',[1,2,3,4,5,6,7,8,9,10,11,12,13,14])->get();
        $subjects = Subject::all();
        $exams = Exam::all();
        return view('reports.exam', compact('grades', 'subjects', 'exams'));
    }

    public function postExam(Request $request)
    {
        $validated_data = $request->validate([
            'exam' => 'required',
            'rank_from' => 'required',
            'rank_to' => 'required',
        ]);

        $exam = Exam::findOrFail($request->exam);

        $ranks = StudentExamRank::where('exam_id',$exam->id)
            ->where('rank','>=', $request->rank_from)
            ->where('rank','<=', $request->rank_to)
            ->orderBy('rank');

        if(!$request->has('grade') && !$request->has('class_room')){
           $ranks = $ranks->get();
        }
        elseif ($request->has('class_room')) {
            $std = ClassRoomStudent::whereIn('class_room_id',$request->class_room)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
            $ranks = StudentExamRank::where('exam_id',$exam->id)
            ->where('rank','>=', $request->rank_from)
            ->where('rank','<=', $request->rank_to)
            ->whereIn('student_id',$std)
            ->orderBy('rank')
            ->get();
        }
        elseif ($request->has('grade')) {
            $class_rooms = ClassRoom::where('grade_id', $request->grade)->pluck('id')->toArray(); 
            $std = ClassRoomStudent::whereIn('class_room_id',$class_rooms)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
            $ranks = StudentExamRank::where('exam_id',$exam->id)
            ->where('rank','>=', $request->rank_from)
            ->where('rank','<=', $request->rank_to)
            ->whereIn('student_id',$std)
            ->orderBy('rank')
            ->get();
        }
        else{
            $ranks = $ranks->get();
        }  
        return (String) view('partials.ajax.exam_report',['ranks'=>$ranks,'exam' =>$exam]);

    }
    public function term(Request $request)
    {
        $validated_data = $request->validate([
            'exam' => 'required',
            'class_room' => 'required'
        ]);
        // Get students in the class room
        $exam_get_param = Exam::findOrFail($request->exam);
        $class_room = ClassRoom::findOrFail($request->class_room);
        //$student_ids = ClassRoomStudent::where('class_room_id',$class_room->id)->where('academic_year_id',$exam_get_param->academic_year_id)->pluck('student_id')->toArray();
        $student_ids = ExamMark::where('class_room_id',$class_room->id)->where('exam_id',$exam_get_param->id)->pluck('student_id')->toArray();
        $students = Student::whereIn('id',$student_ids)->get();
        $term = Term::find($exam_get_param->term_id);
        switch ($term->sequence) {
            case '1':
                // Check for A/L classes
                if(substr($class_room->name,0,2)=="12" || substr($class_room->name,0,2)=="13"){
                    return view('partials.reports.term3_al_progress_report',compact('students','exam_get_param','class_room'));
                    break;
                }
                return view('partials.reports.term_progress_report',compact('students','exam_get_param','class_room'));
                break;
            case '2':
                // Check extra AL classes
                if(substr($class_room->name,0,4)=="13Ex"){
                    return view('partials.reports.term_ex_progress_report',compact('students','exam_get_param','class_room'));
                    break;
                }
                // Check for A/L classes
                if(substr($class_room->name,0,2)=="12" || substr($class_room->name,0,2)=="13"){
                    return view('partials.reports.term_al_progress_report',compact('students','exam_get_param','class_room'));
                    break;
                }
                return view('partials.reports.term2_progress_report',compact('students','exam_get_param','class_room'));
                break;
            case '3':
                // Check for A/L classes
                if(substr($class_room->name,0,2)=="12" || substr($class_room->name,0,2)=="13"){
                    return view('partials.reports.term2_al_progress_report',compact('students','exam_get_param','class_room'));
                    break;
                }
                return view('partials.reports.term3_progress_report',compact('students','exam_get_param','class_room'));
                break;
            default:
                # code...
                break;
        }
        
    }
    public function student()
    {
        $houses = House::all();
        $clusters = Cluster::all();
        $transports = Transport::all();
        return view('reports.student', compact('houses','clusters','transports'));
    }
    public function postStudent(Request $request)
    {   
        $students = Student::all();
        if($request->address){
            $students = Student::whereHas('address', function($query) use($request){
                $query->where('address','like','%'.$request->address.'%');
            })->get();
        }
        if($request->first_name){
            $students = $students->where('first_name',$request->first_name);
        }
        if($request->surname){
            $students = $students->where('surname',$request->surname);
        }
        if($request->other_name){
            $students = $students->where('other_name',$request->other_name);
        }
        if($request->admission_number){
            $students = $students->where('admission_number',$request->admission_number);
        }
        if($request->house_id){
            $students = $students->where('house_id',$request->house_id);
        }
        if($request->cluster_id){
            $students = $students->where('cluster_id',$request->cluster_id);
        }
        if($request->gender){
            $students = $students->where('gender',$request->gender);
        }
        if($request->id_number){
            $students = $students->where('id_number',$request->id_number);
        }
        if($request->marks_from){
            $students = $students->where('scholarship_mark','>',$request->marks_from);
        }
        if($request->marks_to){
            $students = $students->where('scholarship_mark','<',$request->marks_to);
        }
        if($request->transport_id){
            $students = $students->where('transport_id',$request->transport_id);
        }
        if($request->distance){
            $students = $students->where('distance',$request->distance);
        }
        if($request->town){
            $students = $students->where('town',$request->town);
        }
        if($request->date_of_birth_from){
            $students = $students->filter(function($student) use($request){
                return $student->date_of_birth >= $request->date_of_birth_from;
            });
        }
        if($request->date_of_birth_to){
            $students = $students->filter(function($student) use($request){
                return $student->date_of_birth <= $request->date_of_birth_to;
            });
        }
        return (String) view('partials.ajax.student_report',compact('students'));

    }
    public function teacher()
    {
        $houses = House::all();
        $clusters = Cluster::all();
        $transports = Transport::all();
        return view('reports.teacher', compact('houses','clusters','transports'));
    }
    public function postTeacher(Request $request)
    {   
        $teachers = Teacher::all();
        if($request->address){
            $teachers = Student::whereHas('address', function($query) use($request){
                $query->where('address','like','%'.$request->address.'%');
            })->get();
        }
        if($request->temporary_address){
            $teachers = Student::whereHas('temporaryAddress', function($query) use($request){
                $query->where('address','like','%'.$request->temporary_address.'%');
            })->get();
        }
        if($request->first_name){
            $teachers = $teachers->where('first_name',$request->first_name);
        }
        if($request->surname){
            $teachers = $teachers->where('surname',$request->surname);
        }
        if($request->other_name){
            $teachers = $teachers->where('other_name',$request->other_name);
        }
        if($request->admission_number){
            $teachers = $teachers->where('admission_number',$request->admission_number);
        }
        if($request->given_name){
            $teachers = $teachers->where('given_name',$request->given_name);
        }
        if($request->appointment_category){
            $teachers = $teachers->where('appointment_category',$request->appointment_category);
        }
        if($request->gender){
            $teachers = $teachers->where('gender',$request->gender);
        }
        if($request->id_number){
            $teachers = $teachers->where('id_number',$request->id_number);
        }
        if($request->appointment_date){
            $teachers = $teachers->where('appointment_date',$request->appointment_date);
        }
        if($request->appointment_subject){
            $teachers = $teachers->where('appointment_subject',$request->appointment_subject);
        }
        if($request->transport_id){
            $teachers = $teachers->where('transport_id',$request->transport_id);
        }
        if($request->distance){
            $teachers = $teachers->where('distance',$request->distance);
        }
        if($request->town){
            $teachers = $teachers->where('town',$request->town);
        }
        if($request->date_of_birth_from){
            $teachers = $teachers->filter(function($student) use($request){
                return $student->date_of_birth >= $request->date_of_birth_from;
            });
        }
        if($request->date_of_birth_to){
            $teachers = $teachers->filter(function($student) use($request){
                return $student->date_of_birth <= $request->date_of_birth_to;
            });
        }
        if($request->highest_education_qualification){
            $teachers = $teachers->where('highest_education_qualification',$request->highest_education_qualification);
        }
        if($request->highest_professional_qualification){
            $teachers = $teachers->where('highest_professional_qualification',$request->highest_professional_qualification);
        }
        return (String) view('partials.ajax.teacher_report',compact('teachers'));

    }
    public function parents()
    {
        $occupations = Occupation::orderBy('id')->get();
        return view('reports.parents', compact('occupations'));
    }
    public function postParents(Request $request)
    {   
        $parents = StudentParent::where(function($query) use($request){
            if($request->name){
                $query->where('father_name',$request->name)->orWhere('mother_name',$request->name)->orWhere('guardian_name',$request->name);
            }
        })->where(function($query) use($request){
            if($request->id_number){
                $query->where('father_id_number',$request->id_number)->orWhere('mother_id_number',$request->id_number)->orWhere('guardian_id_number',$request->id_number);
            }
        })->where(function($query) use($request){
            if($request->designation){
                $query->where('father_occupation',$request->designation)->orWhere('mother_occupation',$request->designation)->orWhere('guardian_occupation',$request->designation);
            }
        })->where(function($query) use($request){
            if($request->designation_type){
                $query->where('father_designation_type',$request->designation_type)->orWhere('mother_designation_type',$request->designation_type)->orWhere('guardian_designation_type',$request->designation_type);
            }
        })->where(function($query) use($request){
            if($request->income_level){
                $query->where('father_income_level',$request->income_level)->orWhere('mother_income_level',$request->income_level)->orWhere('guardian_income_level',$request->income_level);
            }
        })->where(function($query) use($request){
            if($request->education_level){
                $query->where('father_education_level',$request->education_level)->orWhere('mother_education_level',$request->education_level)->orWhere('guardian_education_level',$request->education_level);
            }
        })->where(function($query) use($request){
            if($request->protection_level){
                $query->where('father_protection_level',$request->protection_level)->orWhere('mother_protection_level',$request->protection_level)->orWhere('guardian_protection_level',$request->protection_level);
            }
        })->where(function($query) use($request){
            if(!$request->old_student=="0"){
                $query->where('old_student',$request->old_student);
            }
        })
        ->get();
        return (String) view('partials.ajax.parents_report',compact('parents'));

    }

    public function examAnalyze()
    {
        $grades = Grade::whereIn('id',[1,2,3,4,5,6,7,8,9,10,11,12,13,14])->get();
        $exams = Exam::orderBy('id','desc')->get();
        $languages = Language::all();
        return view('reports.exam_analyze', compact('grades', 'exams','languages'));
    }

    public function postExamAnalyze(Request $request)
    {
        $validated_data = $request->validate([
            'exam' => 'required',
        ]);

        $exam = Exam::findOrFail($request->exam);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $marks = [];
            $class_room = ClassRoom::findOrFail($request->class_room);
            if($request->has('subject')){
                $subjects = Subject::whereIn('id',$request->subject)->get();
            }
            else{
                $subjects = Subject::where('grade_id',$class_room->grade->id)->get();
            }
            
            //$std = ClassRoomStudent::where('class_room_id',$request->class_room)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
            $std = ExamMark::where('class_room_id',$request->class_room)->where('exam_id',$exam->id)->pluck('student_id')->toArray();
            $students = Student::whereIn('id',$std)->orderBy('present_class_room_id')->get();
            foreach($students as $student){
                $subject_marks = [];
                $mark_class_room_name = '';
                foreach($subjects as $subject){
                    $mark = ExamMark::where('exam_id',$exam->id)->where('student_id',$student->id)->where('subject_id',$subject->id)->first();
                    
                    if(!$mark==null){
                        $mark_class_room_name = $mark->class_room->name;
                    }
                    if($mark==null){
                        $subject_marks[] = [
                            'mark' => 'null' 
                        ];
                    }
                    elseif($mark->is_absent==1){
                        $subject_marks[] = [
                            'mark' => 'AB' 
                        ];
                    }
                    else{
                        $subject_marks[] = [
                            'mark' => $mark->mark 
                        ];
                    }
                    
                }
                $marks[] = [
                    'admission_number' => $student->admission_number,
                    'name' => $student->fullName,
                    'class_room' => $mark_class_room_name,
                    'subject_marks' => $subject_marks 
                ];
            }
            // Get data for chart
            $class_rooms = ClassRoom::where('id',$request->class_room)->get();
            $data = [];
            foreach($subjects as $subject){
                $average = [];
                $average[] = "'" . $subject->name . "'";
                foreach($class_rooms as $class_room){
                    // Get average mark
                    $class_students = ClassRoomStudent::where('class_room_id',$class_room->id)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
                    $mark_total = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$class_students)->where('subject_id',$subject->id)->sum('mark');
                    $mark_count = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$class_students)->where('is_absent',0)->where('subject_id',$subject->id)->count('mark');
                    if($mark_count==0){
                        $average[] = 0;
                    }
                    else{
                        $average[] = $mark_total / $mark_count;
                    }
                }
                $data[] =[
                    implode(',',$average)
                ];
            }
        }
        elseif ($request->has('grade') && $request->grade > 0) {
            $marks = [];
            $class_rooms = ClassRoom::where('grade_id', $request->grade)->pluck('id')->toArray(); 
            if($request->has('subject')){
                $subjects = Subject::whereIn('id',$request->subject)->get();
            }
            else{
                $subjects = Subject::where('grade_id',$request->grade)->get();
            }
            //$std = ClassRoomStudent::whereIn('class_room_id',$class_rooms)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
            $std = ExamMark::whereIn('class_room_id',$class_rooms)->where('exam_id',$exam->id)->pluck('student_id')->toArray();
            $students = Student::whereIn('id',$std)->orderBy('present_class_room_id')->get();
            foreach($students as $student){
                $subject_marks = [];
                foreach($subjects as $subject){
                    $mark = ExamMark::where('exam_id',$exam->id)->where('student_id',$student->id)->where('subject_id',$subject->id)->first();
                    if($mark==null){
                        $subject_marks[] = [
                            'mark' => 'null' 
                        ];
                    }
                    elseif($mark->is_absent==1){
                        $subject_marks[] = [
                            'mark' => 'AB' 
                        ];
                    }
                    else{
                        $subject_marks[] = [
                            'mark' => $mark->mark 
                        ];
                    }
                }
                $marks[] = [
                    'admission_number' => $student->admission_number,
                    'name' => $student->fullName,
                    'class_room' => $student->present_class_room->name,
                    'subject_marks' => $subject_marks 
                ];
            }
            // Get data for chart
            $class_rooms = ClassRoom::where('grade_id',$request->grade)->get();
            $data = [];
            foreach($subjects as $subject){
                $average = [];
                $average[] = "'" . $subject->name . "'";
                foreach($class_rooms as $class_room){
                    // Get average mark
                    $class_students = ClassRoomStudent::where('class_room_id',$class_room->id)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
                    $mark_total = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$class_students)->where('subject_id',$subject->id)->sum('mark');
                    $mark_count = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$class_students)->where('is_absent',0)->where('subject_id',$subject->id)->count('mark');
                    if($mark_count==0){
                        $average[] = 0;
                    }
                    else{
                        $average[] = $mark_total / $mark_count;
                    }
                }
                $data[] =[
                    implode(',',$average)
                ];
            }
        }
        // Covert data to chart
        $chart = "";
        foreach($data as $item){
            foreach($item as $i){
                $chart .= "[" . $i  . "],";
            }
        }
        //dd($chart);
        return (String) view('partials.ajax.exam_analyze_report',['marks'=>$marks,'exam' =>$exam, 'subjects' => $subjects,'chart' => $chart, 'class_rooms' => $class_rooms]);

    }

    public function examClassAnalyze()
    {
        $grades = Grade::whereIn('id',[1,2,3,4,5,6,7,8,9,10,11,12,13,14])->get();
        $exams = Exam::orderBy('id','desc')->get();
        return view('reports.exam_class_analyze', compact('exams','grades'));
    }

    public function postExamClassAnalyze(Request $request)
    {
        $validated_data = $request->validate([
            'exam' => 'required',
            'class_room' => 'required'
        ]);

        $exam = Exam::findOrFail($request->exam);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $marks = [];

            $class_room = ClassRoom::findOrFail($request->class_room);
            $subject_id = ExamMark::where('class_room_id',$request->class_room)->where('exam_id',$exam->id)->pluck('subject_id')->toArray();
            $subjects = Subject::whereIn('id',$subject_id)->get();

            $std = ExamMark::where('class_room_id',$request->class_room)->where('exam_id',$exam->id)->pluck('student_id')->toArray();
            
            $students = Student::whereIn('id',$std)->orderBy('admission_number')->get();
            
            foreach($students as $student){
                $subject_marks = [];
                $rank = StudentExamRank::where('student_id',$student->id)->where('exam_id',$exam->id)->first();
                foreach($subjects as $subject){
                    $mark = ExamMark::where('exam_id',$exam->id)->where('student_id',$student->id)->where('subject_id',$subject->id)->first();
                    if($mark==null){
                        $subject_marks[] = [
                            'mark' => 'null' 
                        ];
                    }
                    elseif($mark->is_absent==1){
                        $subject_marks[] = [
                            'mark' => 'AB' 
                        ];
                    }
                    else{
                        $subject_marks[] = [
                            'mark' => $mark->mark 
                        ];
                    }
                }
                $marks[] = [
                    'admission_number' => $student->admission_number,
                    'student_id' => $student->id,
                    'rank' => $rank==null?'0':$rank->rank,
                    'total' => $rank==null?'0':$rank->total,
                    'average' => $rank==null?'0':$rank->average,
                    'name' => $student->fullName,
                    'class_room' => $student->present_class_room->name,
                    'subject_marks' => $subject_marks 
                ];
            }

            return (String) view('partials.ajax.exam_class_analyze_report',['marks'=>$marks,'exam' =>$exam, 'subjects' => $subjects,'class_room' => $class_room]);
        }
    }
    public function examAnalyzeNew()
    {
        $grades = Grade::whereIn('id',[1,2,3,4,5,6,7,8,9,10,11,12,13,14])->get();
        $classrooms = ClassRoom::all();
        $subjects = Subject::all();
        $exams = Exam::orderBy('id','desc')->get();
        return view('reports.exam_analyze_new', compact('grades', 'classrooms', 'subjects', 'exams'));
    }

    public function postExamAnalyzeNew(Request $request)
    {
        $validated_data = $request->validate([
            'exam' => 'required',
        ]);

        $exam = Exam::findOrFail($request->exam);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $marks = [];
            $class_room = ClassRoom::findOrFail($request->class_room);
            $subject_id = ExamMark::where('class_room_id',$request->class_room)->where('exam_id',$exam->id)->pluck('subject_id')->toArray();
            $subjects = Subject::whereIn('id',$subject_id)->get();
            $std = ExamMark::where('class_room_id',$request->class_room)->where('exam_id',$exam->id)->pluck('student_id')->toArray();
            $students = Student::whereIn('id',$std)->orderBy('present_class_room_id')->get();
            foreach($students as $student){
                $subject_marks = [];
                $a = 0;
                $b = 0;
                $c = 0;
                $s = 0;
                $w = 0;
                $mark_class_room_name = '';
                foreach($subjects as $subject){
                    $mark = ExamMark::where('exam_id',$exam->id)->where('student_id',$student->id)->where('subject_id',$subject->id)->first();
                    if(!$mark==null){
                        $mark_class_room_name = $mark->class_room->name;
                    }
                    if($mark==null){
                        $subject_marks[] = [
                            'mark' => 'null' 
                        ];
                    }
                    elseif($mark->is_absent==1){
                        $subject_marks[] = [
                            'mark' => 'AB' 
                        ];
                    }
                    else{
                        $subject_marks[] = [
                            'mark' => $mark->mark 
                        ];
                        if($mark->mark  >= 75){
                            $a = $a + 1;
                        }
                        elseif($mark->mark  < 75 && $mark->mark  >= 65){
                            $b = $b + 1;
                        }
                        elseif($mark->mark  < 65 && $mark->mark  >= 50){
                            $c = $c + 1;
                        }
                        elseif($mark->mark  < 50 && $mark->mark  >= 40){
                            $s = $s + 1;
                        }
                        elseif($mark->mark  < 40 && $mark->mark  >= 0){
                            $w = $w + 1;
                        }
                        else{
                            
                        }
                    }
                }
                $rank = StudentExamRank::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('id','desc')->first();
                $marks[] = [
                    'admission_number' => $student->admission_number,
                    'name' => $student->fullName,
                    'class_room' => $mark_class_room_name,
                    'subject_marks' => $subject_marks,
                    'a' => $a,
                    'b' => $b,
                    'c' => $c,
                    's' => $s,
                    'w' => $w,
                    'total' => $rank==null?0:$rank->total,
                    'average' => $rank==null?0:number_format($rank->average,2),
                    'position' => $rank==null?0:$rank->rank
                ];
            }
            $class_rooms = ClassRoom::where('id',$request->class_room)->get();
            // Calculate bottom part of the report
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',75)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count[] = [
                'admission_number' => '',
                'name' => 'A-75',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',65)->where('mark','<',75)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count[] = [
                'admission_number' => '',
                'name' => 'B-65',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',50)->where('mark','<',65)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count[] = [
                'admission_number' => '',
                'name' => 'C-50',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',40)->where('mark','<',50)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count[] = [
                'admission_number' => '',
                'name' => 'S-40',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',0)->where('mark','<',40)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count[] = [
                'admission_number' => '',
                'name' => 'W',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('is_absent',1)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count[] = [
                'admission_number' => '',
                'name' => 'AB',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',1)->where('mark','<=',9)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '01-09',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',10)->where('mark','<=',19)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '10-19',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',20)->where('mark','<=',34)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '20-34',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',20)->where('mark','<=',34)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '35-49',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',50)->where('mark','<=',64)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '50-64',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',65)->where('mark','<=',74)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '65-74',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',75)->where('mark','<=',100)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => '75',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('is_absent',1)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => 'AB',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];
            $subject_mark_count = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->count();
                $subject_mark_count[] = [
                    'count' => $mark
                ];
            }
            $count2[] = [
                'admission_number' => '',
                'name' => 'Total',
                'class_room' => '',
                'subject_marks' => $subject_mark_count
            ];

            // Mean
            $mean = [];
            foreach($subjects as $subject){
                $mark = ExamMark::where('exam_id',$exam->id)->whereIn('student_id',$std)->where('subject_id',$subject->id)->where('mark','>=',0)->where('mark','<=',100)->where('is_absent',0)->get();
                if($mark->count('mark')==0){
                    $mean[] = [
                        'count' => 0
                    ];
                }
                else{
                    $mean[] = [
                        'count' => number_format($mark->sum('mark')/$mark->count('mark'),2)
                    ];
                }
            }
        }
        return (String) view('partials.ajax.exam_analyze_report_new',['marks'=>$marks,'exam' =>$exam, 'subjects' => $subjects, 'class_rooms' => $class_rooms, 'count' => $count, 'count2' => $count2, 'mean' => $mean]);

    }

    public function shuffled()
    {
        $classrooms = ClassRoom::all();
        $exams = Exam::orderBy('id','desc')->get();
        return view('reports.shuffled', compact('classrooms', 'exams'));
    }

    public function postShuffled(Request $request)
    {
        $validated_data = $request->validate([
            'exam' => 'required',
            'class_room' => 'required'
        ]);

        $exam = Exam::findOrFail($request->exam);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $marks = [];

            $class_room = ClassRoom::findOrFail($request->class_room);
            $subject_id = ExamMark::where('class_room_id',$request->class_room)->where('exam_id',$exam->id)->pluck('subject_id')->toArray();
            $subjects = Subject::whereIn('id',$subject_id)->get();

            $students = Student::where('present_class_room_id',$request->class_room)->orderBy('admission_number')->get();
            foreach($students as $student){
                $subject_marks = [];
                $rank = StudentExamRank::where('student_id',$student->id)->where('exam_id',$exam->id)->first();
                foreach($subjects as $subject){
                    $mark = ExamMark::where('exam_id',$exam->id)->where('student_id',$student->id)->where('subject_id',$subject->id)->first();
                    if($mark==null){
                        $subject_marks[] = [
                            'mark' => 'null' 
                        ];
                    }
                    elseif($mark->is_absent==1){
                        $subject_marks[] = [
                            'mark' => 'AB' 
                        ];
                    }
                    else{
                        $subject_marks[] = [
                            'mark' => $mark->mark 
                        ];
                    }
                }
                $marks[] = [
                    'admission_number' => $student->admission_number,
                    'student_id' => $student->id,
                    'previous_class_room' => $rank==null?'':$rank->class_room->name,
                    'rank' => $rank==null?'0':$rank->rank,
                    'total' => $rank==null?'0':$rank->total,
                    'average' => $rank==null?'0':$rank->average,
                    'name' => $student->fullName,
                    'class_room' => $student->present_class_room->name,
                    'subject_marks' => $subject_marks 
                ];
            }

            return (String) view('partials.ajax.shuffled_report',['marks'=>$marks,'exam' =>$exam, 'subjects' => $subjects,'class_room' => $class_room]);
        }
    }
    // Report related ajax call

    /**
     * Get class rooms by grade
     */
    public function getClass(Request $request)
    {
        $this->validate($request,[
            'grade_id' => 'required'
        ]);
        $class_rooms = ClassRoom::where('grade_id',$request->grade_id)->get();
        return $class_rooms;
    }

    /**
     * Get subjects by grade and medium
     */
    public function getSubject(Request $request)
    {
        $this->validate($request,[
            'grade_id' => 'required',
        ]);
        $subjects = Subject::with('language:id,name')->where('grade_id',$request->grade_id)->get();
        return $subjects;
    }

    /**
     * Get subjects by grade and medium
     */
    public function getSubjectWithMedium(Request $request)
    {
        $this->validate($request,[
            'grade_id' => 'required',
            'language_id' => 'required'
        ]);
        $subjects = Subject::with('language:id,name')->where('grade_id',$request->grade_id)->where('language_id',$request->language_id)->get();
        return $subjects;
    }

    public function suraksha()
    {
        $classrooms = ClassRoom::all();
        $grades = Grade::all();
        return view('reports.suraksha', compact('classrooms', 'grades'));
    }

    public function postSuraksha(Request $request)
    {
        $validated_data = $request->validate([
            'grade' => 'required'
        ]);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $students = Student::whereIn('present_class_room_id',$request->class_room)->orderBy('admission_number')->get();
            return (String) view('partials.ajax.suraksha_report',['students' => $students]);
        }
        else
        {
            $class_room_ids = ClassRoom::where('grade_id', $request->grade)->pluck('id')->toArray();
            $students = Student::whereIn('present_class_room_id',$class_room_ids)->orderBy('admission_number')->get();
            return (String) view('partials.ajax.suraksha_report',['students' => $students]);
        }
    }
    public function studentCount()
    {
        $classrooms = ClassRoom::all();
        $grades = Grade::all();
        return view('reports.student_count', compact('classrooms', 'grades'));
    }

    public function postStudentCount(Request $request)
    {
        $validated_data = $request->validate([
            'grade' => 'required'
        ]);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $students = Student::whereIn('present_class_room_id',$request->class_room)->whereNull('is_left')->orderBy('admission_number')->get();
            return (String) view('partials.ajax.student_count_report',['students' => $students]);
        }
        else
        {
            $class_room_ids = ClassRoom::where('grade_id', $request->grade)->pluck('id')->toArray();
            $students = Student::whereIn('present_class_room_id',$class_room_ids)->whereNull('is_left')->orderBy('admission_number')->get();
            return (String) view('partials.ajax.student_count_report',['students' => $students]);
        }
    }

    // New aloysius student report
    public function aloysiusStudent()
    {
        $classrooms = ClassRoom::all();
        $grades = Grade::all();
        return view('reports.aloysius_student', compact('classrooms', 'grades'));
    }

    public function postAloysiusStudent(Request $request)
    {
        $validated_data = $request->validate([
            'grade' => 'required'
        ]);
        
        if ($request->has('class_room') &&  $request->class_room > 0) {
            $students = Student::whereIn('present_class_room_id',$request->class_room)->orderBy('admission_number')->get();
            return (String) view('partials.ajax.aloysius_student_report',['students' => $students]);
        }
        else
        {
            $class_room_ids = ClassRoom::where('grade_id', $request->grade)->pluck('id')->toArray();
            $students = Student::whereIn('present_class_room_id',$class_room_ids)->orderBy('admission_number')->get();
            return (String) view('partials.ajax.aloysius_student_report',['students' => $students]);
        }
    }

    // New aloysius teacher report
    public function aloysiusTeacher()
    {
        $teachers = Teacher::whereNull('is_left')->get();
        return view('reports.aloysius_teacher', compact('teachers'));
    }

}
