<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siblin;
use App\Student;

class SiblinController extends Controller
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
    public function create($id)
    {
        $student = Student::findOrFail($id);
        return view('student_siblings.create',['student_list' => Student::active()->get(), 'student' => $student]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $siblin = Siblin::find($id);
        $left_student_id = $siblin->left_student_id;
        $right_student_id = $siblin->right_student_id;
        $siblin->delete();
        // Delete reverse relation 
        $siblin_reverse = Siblin::where('left_student_id',$right_student_id)->where('right_student_id',$left_student_id)->first();
        $siblin_reverse->delete();
        return redirect(url("student/$left_student_id#family"))->with('alert','Information has been deleted.');
    }
}
