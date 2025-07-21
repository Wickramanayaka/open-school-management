<?php

namespace ProactiveAnts\Discipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProactiveAnts\Discipline\DisobedienceCategory;
use ProactiveAnts\Discipline\Disobedience;
use ProactiveAnts\Discipline\DisobedienceStudent;
use Auth;
use App\Student;

class DisobedienceStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discipline::disobey_students.index',['students' => DisobedienceStudent::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DisobedienceCategory::orderBy('id')->get();
        foreach($categories as $category){
            $list[$category->name] = $category->disobediences->pluck('name','id')->toArray();
        }
        return view('discipline::disobey_students.create',['disobediences' => Disobedience::all(),'list' => $list]);
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
            'admission_number' => 'required',
            'date' => 'required',
            'disobedience_id' => 'authorized'
        ]);
        // Get student id from admission number
        $student = Student::where('admission_number', $request->admission_number)->firstOrFail();
        $disobedience = Disobedience::findOrFail($request->disobedience_id);
        
        DisobedienceStudent::create([
            'student_id' => $student->id,
            'disobedience_id' => $request->disobedience_id,
            'point_deduct' => $disobedience->category->point_deduct,
            'date' => $request->date,
            'charge_sheet_number' => $request->charge_sheet_number,
            'remark' => $request->remark,
            'teacher_id' => Auth::user()->teacher_id==null?0:Auth::user()->teacher_id,
            'academic_year_id' => getCurrentAcademicYear()->id
        ]);
        return redirect(url('discipline/student/create'))->with('alert','The student charge has been created successfuly.');
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
        $disobey = DisobedienceStudent::findOrFail($id);
        $student = Student::findOrFail($disobey->student_id);
        return view('discipline::disobey_students.edit',['disobediences' => Disobedience::all(), 'disobey'=> $disobey, 'student' => $student]);
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
            'admission_number' => 'required',
            'date' => 'required'
        ]);
        // Get student id from admission number
        $student = Student::where('admission_number', $request->admission_number)->firstOrFail();
        $disobedience = Disobedience::findOrFail($request->disobedience_id);


        if(Auth::user()->roles->contains('id',1)){
            // nothing
        }
        elseif(Auth::user()->teacher_id==$disobey->teacher_id){
            // nothing
        }
        else{
            return redirect(url('/discipline/student'))->withErrors(["You are not the owner of the record."]);
        }

        
        DisobedienceStudent::find($id)->update([
            'student_id' => $student->id,
            'disobedience_id' => $request->disobedience_id,
            'point_deduct' => $disobedience->category->point_deduct,
            'date' => $request->date,
            'charge_sheet_number' => $request->charge_sheet_number,
            'remark' => $request->remark,
            'teacher_id' => Auth::user()->teacher_id==null?0:Auth::user()->teacher_id,
            'academic_year_id' => getCurrentAcademicYear()->id
        ]);
        return redirect(url('discipline/student'))->with('alert','The student charge has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Only creator or admin can delete
        $disobey = DisobedienceStudent::findOrFail($id);
        if(Auth::user()->roles->contains('id',1)){
            $disobey->delete();
            return redirect(url('/discipline/student'))->with('alert',"The student change has been deleted.");
        }
        elseif(Auth::user()->teacher_id==$disobey->teacher_id){
            $disobey->delete();
            return redirect(url('/discipline/student'))->with('alert',"The student change has been deleted.");
        }
        else{
            return redirect(url('/discipline/student'))->withErrors(["You are not the owner of the record."]);
        }
        
    }
}
