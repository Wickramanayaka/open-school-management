<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Teacher;
use App\Grade;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $teachers = Teacher::active()->orderBy('surname')->get();
        $grades = Grade::all();
        return view('sections.index',compact('sections','teachers','grades'));
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
        $validated_data = $request->validate([
            'name' => 'required',
            'grade_id' => 'required',
            'teacher_id' => 'required'
        ]);
        $teacher = Teacher::where('id',$request->teacher_id)->firstOrFail();
        $section = Section::create([
            'name' => $request->name,
            'current_section_head' => $teacher->id,
            'uid' => str_random(30).time()
        ]);
        foreach ($request->grade_id as $grade) {
            $grade = Grade::findOrFail($grade);
            $section->grades()->save($grade);
        }
        return redirect()->back()->with('alert', 'Section has been created.');
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
        $section = Section::where('uid', $id)->firstOrFail();
        $teachers = Teacher::active()->orderBy('surname')->get();
        $grades = Grade::all();
        return view('sections.edit',compact('section','teachers','grades'));
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
        $validated_data = $request->validate([
            'name' => 'required',
            'grade_id' => 'required',
            'teacher_id' => 'required'
        ]);
        $teacher = Teacher::where('id',$request->teacher_id)->firstOrFail();
        $section = Section::where('uid', $id)->firstOrFail();
        $section->name = $request->name;
        $section->current_section_head = $teacher->id;
        $section->save();
        $section->grades()->sync($request->grade_id);
        return redirect('/section')->with('alert', 'Section has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::where('uid', $id)->firstOrFail();
        $section->grades()->detach();
        $section->delete();
        return redirect()->back()->with('alert', 'Section has been deleted.');
    }
}
