<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassRoom;
use App\Grade;
use App\Division;
use App\ClassRoomStudent;
use App\ClassRoomTeacher;
use App\SubjectTeacher;
use App\Student;
use App\AcademicYear;
use App\Subject;
use App\SubjectStudent;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'grade_list' => 'required',
            'division_list' => 'required'
        ]);
        $data = $request->all();
        foreach ($data['grade_list'] as $grade) {
            foreach ($data['division_list'] as $division) {
                $grade_name = Grade::find($grade);
                $division_name = Division::find($division);
                // If the class room is already created, silencely skip.
                $class_room = ClassRoom::where('grade_id',$grade)->where('division_id',$division)->first();
                if($class_room==null){
                    ClassRoom::create([
                        'name' => $grade_name->name.$division_name->name,
                        'grade_id' => $grade,
                        'division_id' => $division
                    ]);
                }
            }
        }
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
        $class_room = ClassRoom::find($id);
        $grades = Grade::all();
        $divisions = Division::all();
        return view('class_rooms.edit', compact('class_room','grades','divisions'));
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
        $this->validate($request,[
            'name' => 'required',
        ]);
        $class_room = ClassRoom::find($id)->update($request->all());
        return redirect(route('grade.index'))->with('alert','The Class Room has been updated successfuly.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_room = ClassRoom::find($id);
        // Check Class Room is used
        if (!ClassRoomStudent::where('class_room_id',$class_room->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Class room can not be deleted."]);
        }
        elseif (!ClassRoomTeacher::where('class_room_id',$class_room->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Class room can not be deleted."]);
        }
        elseif (!SubjectTeacher::where('class_room_id',$class_room->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Class room can not be deleted."]);
        }
        else{
            $class_room->delete();
            return redirect(route('grade.index'))->with('alert',"The Class room has been deleted.");
        }
        
    }

    public function transfer()
    {
        return view('class_rooms.transfer',['class_rooms' => ClassRoom::all(),'academic_years' => AcademicYear::orderByDesc('id')->get()]);
    }

    public function postTransfer(Request $request)
    {
        $this->validate($request,[
            'date' => 'required|date',
            'class_room_id' => 'required',
            'student_id' => 'required',
            'academic_year_id' => 'required'
        ]);
        foreach ($request->student_id as $key => $value) {
            $student = Student::find($value);
            if(!$student==null){
                // Change the student present class
                $student->present_class_room_id = $request->class_room_id;
                $student->save();
                // Add record to class room student
                ClassRoomStudent::create([
                    'student_id' => $student->id,
                    'class_room_id' => $request->class_room_id,
                    'academic_year_id' => $request->academic_year_id,
                    'date' => $request->date,
                    'comment' => $request->comment
                ]);
                // Get subjects belongs to the new grade
                $class_room = ClassRoom::find($request->class_room_id);
                $subjects = Subject::where('grade_id',$class_room->grade_id)->compulsory()->get();
                foreach($subjects as $subject){
                    // Check for duplicate
                    $subject_student = SubjectStudent::where('student_id' , $student->id)->where('subject_id' , $subject->id)->where('academic_year_id' , $request->academic_year_id)->first();
                    if($subject_student==null){
                        SubjectStudent::create([
                            'student_id' => $student->id,
                            'subject_id' => $subject->id,
                            'academic_year_id' => $request->academic_year_id
                        ]);
                    }
                }
            }
        }
        return redirect()->back()->with('alert','Class Room transfer is done successfuly.');
    }

    public function getStudent(Request $request)
    {
       $this->validate($request,[
           'class_room_id' => 'required'
       ]);
       $students = Student::active()->where('present_class_room_id',$request->class_room_id)->orderBy('admission_number')->get();
       return (string) view('partials.ajax.class_room_student',['students' => $students]) ;
    }
}
