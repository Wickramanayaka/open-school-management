<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassRoom;
use App\Exam;
use App\Student;
use App\Grade;
use App\ExamMark;
use App\Events\ExamMarkUpdate;
use App\StudentExamRank;
use App\Subject;
use App\MarkGrade;
use App\RankIncomplete;

class ExamMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_rooms = ClassRoom::all();
        $exams = Exam::orderBy('id','desc')->get();
        $subjects = Subject::all();
        return view('exam_marks.index',compact('class_rooms','exams','subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class_rooms = ClassRoom::all();
        $exams = Exam::orderBy('id','desc')->where('status','<>','Completed')->get();
        $subjects = Subject::all();
        return view('exam_marks.create',compact('class_rooms','exams','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * Any student can get zero mark when he is absent and actually gets zero merk at exam.
     * the difference between type of zero is when the student get zero at absent the absent flag is raised.
     * otherwise get mark as zero without flag.
     * 
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'exam_id' => 'required',
            'mark' => 'required'
        ]);
        dd($request->all());
        foreach ($request->mark as $student => $item) {
            foreach ($item as $subject => $mark) {
                $is_absent = 0;
                //$not_relavent = 0;
                $remove = 0;

                // Remove null mark subject
                if($mark==null){
                    //$not_relavent = 1;
                    continue;
                }
                elseif ($mark=="AB" || $mark=="ab") {
                    $mark = 0;
                    $is_absent = 1;
                }
                elseif($mark=="D"){
                    $remove = 1;
                }
                
                // Get mark grade
                if(!$mark==null){
                    $mark_grade = MarkGrade::where('low','<=',$mark)->where('high','>=',$mark)->first();
                }
                
                
                if($mark==null){
                    $mark_grade = new MarkGrade();
                }
                
                $student_object = Student::find($student);
                
                // Check for update
                $exam_mark = ExamMark::where('exam_id',$request->exam_id)->where('student_id', $student)->where('subject_id', $subject)->first();
                if($exam_mark==null){
                    ExamMark::create([
                        'exam_id' => $request->exam_id,
                        'student_id' => $student,
                        'subject_id' => $subject,
                        'mark' => $mark,
                        'is_absent' => $is_absent,
                        //'not_relavent' => $not_relavent
                        'mark_grade' => $mark_grade->grade,
                        'class_room_id' => $student_object->present_class_room_id
                    ]);
                }
                else{
                    if($remove==1){
                        $exam_mark->delete();
                    }
                    else{
                        $exam_mark->mark = $mark;
                        $exam_mark->is_absent = $is_absent;
                        $mark_grade = MarkGrade::where('low','<=',$mark)->where('high','>=',$mark)->first();
                        $exam_mark->mark_grade = $mark_grade->grade;
                        $exam_mark->save();
                    }
                }
                
            }
        }
        // If exam has rank enabled calculate rank

        $exam = Exam::find($request->exam_id);
        $class_room = ClassRoom::find($request->class_room_id);
        if($exam->has_rank){
            event(new ExamMarkUpdate($exam,$class_room));
        }

        return redirect()->back()->with('alert','Examination marks have bee uploaded successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function grade()
    {
        return view('exam_marks.grade');
    }

    public function getStudent(Request $request)
    {
        //dd($request->all());

       $this->validate($request,[
           'class_room_id' => 'required',
           'exam_id' => 'required'
       ]);

       $exam = Exam::find($request->exam_id);
       $class_room = ClassRoom::find($request->class_room_id);
       $grade = Grade::find($class_room->grade_id);

       if($request->has('subject_id')){
           $subjects = Subject::whereIn('id',$request->subject_id)->get();
       }
       else{
           $subjects = Subject::where('grade_id',$grade->id)->get();
       }

       $students = Student::where('present_class_room_id',$request->class_room_id)->orderBy('admission_number')->get();
       return (string) view('partials.ajax.mark_list',['students' => $students,'grade' => $grade, 'subjects' => $subjects, 'exam' => $exam, 'class_room' => $class_room]) ;
    }

    public function getReport(Request $request)
    {
       $this->validate($request,[
           'student_id' => 'required',
           'exam_id' => 'required'
       ]);
       $exam_marks = ExamMark::where('exam_id',$request->exam_id)->where('student_id',$request->student_id)->get();
       $exam_rank = StudentExamRank::where('exam_id',$request->exam_id)->where('student_id',$request->student_id)->first();
       $student = Student::find($request->student_id);
       $exam = Exam::find($request->exam_id);
       return (string) view('partials.ajax.mark_sheet',['student' => $student,'exam_marks' => $exam_marks,'exam_rank' => $exam_rank,'exam' => $exam]) ;
    }

    public function getMark(Request $request)
    {
        //dd($request->all());

       $this->validate($request,[
           'exam_id' => 'required'
       ]);
        if($request->class_room_id==0 && $request->subject_id==0){
            $marks = ExamMark::where('exam_id',$request->exam_id)->get();
        }
        elseif($request->class_room_id==0 && $request->subject_id<>0){
            $marks = ExamMark::where('exam_id',$request->exam_id)->where('subject_id',$request->subject_id)->get();
        }
        elseif($request->class_room_id<>0 && $request->subject_id==0){
            //$class_students = Student::where('present_class_room_id',$request->class_room_id)->pluck('id')->toArray();
            //$marks = ExamMark::where('exam_id',$request->exam_id)->whereIn('student_id',$class_students)->get();
            $marks = ExamMark::where('exam_id',$request->exam_id)->where('class_room_id',$request->class_room_id)->get();
        }
        else{
            //$class_students = Student::where('present_class_room_id',$request->class_room_id)->pluck('id')->toArray();
            //$marks = ExamMark::where('exam_id',$request->exam_id)->whereIn('student_id',$class_students)->where('subject_id',$request->subject_id)->get();
            $marks = ExamMark::where('exam_id',$request->exam_id)->where('class_room_id',$request->class_room_id)->where('subject_id',$request->subject_id)->get();
        }
        return (string) view('partials.ajax.mark_list_edit',['marks' => $marks,]) ;
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'mark_id' => 'required'
        ]);
        foreach ($request->mark_id as $key => $id) {
            $mark = ExamMark::find($id);
            $student = Student::find($mark->student_id);
            $exam = Exam::find($mark->exam_id);
            event(new ExamMarkUpdate($exam,$student->present_class_room));
            $mark->delete();
        }
        return redirect()->back()->with('alert','Marks have been deleted.');
        
    }

    public function markUpdateAjax(Request $request)
    {
        $data = explode('|', $request->id);
        $is_absent = 0;
        $remove = 0;
        $valid = 1;
        $mark = $request->value;

        // Remove null mark subject
        if($request->value==''){
            $remove = 1;
            $valid = 0;
        }
        elseif ($request->value=="AB" || $request->value=="ab") {
            $mark = 0;
            $is_absent = 1;
            $valid = 0;
        }
        elseif($request->value=='D' || $request->value=='d'){
            $remove = 1;
            $valid = 0;
        }
        
        // Get mark grade
        if($valid == 1){
            $mark_grade = MarkGrade::where('low','<=',$mark)->where('high','>=',$mark)->first();
        }
        else{
            $mark_grade = new MarkGrade();
        }
        
        $student_object = Student::find($data[0]);
        
        // Check for update
        $exam_mark = ExamMark::where('student_id',$data[0])->where('exam_id',$data[1])->where('subject_id',$data[2])->first();
        if($exam_mark==null){
            ExamMark::create([
                'exam_id' => $data[1],
                'student_id' => $data[0],
                'subject_id' => $data[2],
                'mark' => $mark,
                'is_absent' => $is_absent,
                'mark_grade' => $mark_grade->grade,
                'class_room_id' => $student_object->present_class_room_id
            ]);
        }
        else{
            if($remove==1){
                $exam_mark->delete();
            }
            else{
                $exam_mark->mark = $mark;
                $exam_mark->is_absent = $is_absent;
                $mark_grade = MarkGrade::where('low','<=',$mark)->where('high','>=',$mark)->first();
                $exam_mark->mark_grade = $mark_grade->grade;
                $exam_mark->save();
            }
        }

        /**
         * Add record to rank incomplete table to indicate the mark changes and inform to run the rank again
         * if the exam has ranking
         * 
         */
        $exam = Exam::find($data[1]);
        if($exam->has_rank==1){
            $incomplete = RankIncomplete::where('exam_id',$data[1])->where('class_room_id',$student_object->present_class_room_id)->first();
            if($incomplete==null){
                RankIncomplete::create([
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'exam_id' => $data[1],
                    'class_room_id' => $student_object->present_class_room_id
                ]);
            }
            else{
                $incomplete->date = \Carbon\Carbon::now()->format('Y-m-d');
                $incomplete->save();
            }
        }
        
        return ['message' => 'completed'];
    }
    public function rankAjax(Request $request)
    {
        if($request->class_room_id=='' || $request->exam_id==''){
            return ['message' => 'Invalid inputs'];
        }
        else{
            $exam_id = $request->exam_id;
            $class_room_id = $request->class_room_id;
            $exam = Exam::findOrFail($exam_id);
            $class_room = ClassRoom::findOrFail($class_room_id);
            if($exam->has_rank){
                event(new ExamMarkUpdate($exam,$class_room));
                // Remove rank incomplete record
                $incomplete = RankIncomplete::where('exam_id',$exam->id)->where('class_room_id',$class_room->id)->first();
                if(!$incomplete==null){
                    $incomplete->delete();
                }
                return ['message' => 'The rank has been calculated manually.'];
            }
            else{
                return ['message' => 'The exam has no rank enabled'];
            }
        }
    }
    public function rank(Request $request)
    {
        if($request->has('exam') && $request->has('class_room')){
            $exam = Exam::findOrFail($request->exam);
            $class_room = ClassRoom::findOrFail($request->class_room);
            event(new ExamMarkUpdate($exam,$class_room));
            // Remove rank incomplete record
            $incomplete = RankIncomplete::where('exam_id',$exam->id)->where('class_room_id',$class_room->id)->first();
            if(!$incomplete==null){
                $incomplete->delete();
            }
        }
        $ranks = RankIncomplete::all();
        return view('exam_marks.rank',compact('ranks'));
    }
}
