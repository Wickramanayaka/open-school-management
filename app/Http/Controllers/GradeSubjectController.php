<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\Subject;
use App\AcademicYear;
use App\GradeSubject;

class GradeSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('grade_subjects.index',['grades' => Grade::all(), 'subjects' => Subject::all(),'academic_years' => AcademicYear::all(),'academic_year_id' => $request->academic_year_id]);
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
            'grade_id' => 'required',
            'subject_id' => 'required'
        ]);
        $grade = Grade::find($request->grade_id);
        // Remove exting data
        GradeSubject::where('grade_id',$grade->id)->where('academic_year_id', getCurrentAcademicYear()->id)->delete();
        $grade->subjects()->attach($request->subject_id,['academic_year_id' => getCurrentAcademicYear()->id]);
        return redirect()->back()->with('alert','Added subjects to the grade successfuly.');
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
        //
    }
}
