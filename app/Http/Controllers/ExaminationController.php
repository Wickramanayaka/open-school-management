<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\AcademicYear;
use App\Term;
use App\ExamCategory;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        $academic_years = AcademicYear::orderBy('start','desc')->get();
        $terms = Term::orderBy('start','desc')->get();
        $categories = ExamCategory::all();
        return view('examinations.index',compact('exams','academic_years','terms','categories'));
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
            'code' => 'required|unique:exams',
            'name' => 'required',
            'exam_category_id' => 'required',
            'academic_year_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'status' => 'required',
        ]);
        Exam::create($request->all());
        return redirect(route('examination.index'))->with('alert','The examination has been created successfuly');
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
        $exam = Exam::findOrFail($id);
        $academic_years = AcademicYear::all();
        $terms = Term::all();
        $categories = ExamCategory::all();
        return view('examinations.edit',compact('exam','academic_years','terms','categories'));
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
            'code' => 'required|unique:exams,code,' .$id,
            'name' => 'required',
            'exam_category_id' => 'required',
            'academic_year_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'status' => 'required'
        ]);
        Exam::findOrFail($id)->update($request->all());
        return redirect(route('examination.index'))->with('alert','The examination has been updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        //Check in Student Exam
        
        // if (!Student::where('house_id',$house->id)->first() == null) {
        //     return redirect(route('house.index'))->withErrors(["The house can not be deleted."]);
        // }
        // else {
        //     $house->delete();
        //     return redirect(route('house.index'))->with('alert',"The house has been deleted.");
        // }

        $exam->delete();
        return redirect(route('examination.index'))->with('alert',"The Exam has been deleted.");
    }
}
