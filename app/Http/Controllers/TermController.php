<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\AcademicYear;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('terms.index',['terms' => Term::all(),'years' => AcademicYear::orderBy('start','desc')->get()]);
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
            'code' => 'required|unique:terms',
            'name' => 'required',
            'academic_year_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'number_of_days' => 'required',
            'sequence' => 'required'
        ]);
        $term = Term::create($request->all());
        return redirect(route('term.index'))->with('alert','Term has been created successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $term = Term::findOrFailed($id);
        return $term;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('terms.edit',['term' => Term::findOrFail($id),'years' => AcademicYear::all()]);
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
            'code' => 'required|unique:terms,code,' . $id,
            'name' => 'required',
            'academic_year_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'number_of_days' => 'required',
            'sequence' => 'required'
        ]);
        $term = Term::findOrFail($id)->update($request->all());
        return redirect(route('term.index'))->with('alert','Term has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();
        return redirect()->back()->with('alert','Term has been deleted successfuly.');
    }
}
