<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicYear;
use App\Term;
use App\Student;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('academic_years.index',['academic_years' => AcademicYear::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'name' => 'required|unique:academic_years',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);
        AcademicYear::create($request->all());
        return redirect(route('academicYear.index'))->with('alert',"The Academic year has been created.");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('academic_years.edit',['academic_year' => AcademicYear::findOrFail($id)]);
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
            'name' => 'required|unique:academic_years,name,' .$id,
            'start' => 'required|date',
            'end' => 'required|date'
        ]);

        $academic_year = AcademicYear::findOrFail($id);
        $academic_year->name = $request->name;
        $academic_year->start = $request->start;
        $academic_year->end = $request->end;
        $academic_year->update();
        return redirect(route('academicYear.index'))->with('alert',"The Academic year has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $academic_year = AcademicYear::findOrFail($id);
        // Check for usage in Term
        if(!Term::where('academic_year_id',$academic_year->id)->first() == null) {
            return redirect(route('academicYear.index'))->withErrors(["The Academic year can not be deleted."]);
        }
        //Check in Student
        elseif (!Student::where('admitted_academic_year_id',$academic_year->id)->first() == null) {
            return redirect(route('academicYear.index'))->withErrors(["The Academic year can not be deleted."]);
        }
        else {
            $academic_year->delete();
            return redirect(route('academicYear.index'))->with('alert',"The Academic year has been deleted.");
        }
        
    }
}
