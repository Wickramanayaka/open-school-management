<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\Division;
use App\ClassRoom;
use App\GradeSubject;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        $divisions = Division::all();
        $class_rooms = ClassRoom::orderBy('grade_id')->orderBy('division_id')->paginate(50);
        return view('grades.index', compact('grades','divisions','class_rooms'));
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
            'name' => 'required|unique:grades'
        ]);
        Grade::create($request->all());
        return redirect(route('grade.index'))->with('alert','The grade has been created successfuly.');
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
        return view('grades.edit',['grade' => Grade::find($id)]);
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
            'name' => 'required|unique:grades,name,' .$id
        ]);
        Grade::find($id)->update($request->all());
        return redirect(route('grade.index'))->with('alert','The Grade has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        // Check Class Room is used
        if (!ClassRoom::where('grade_id',$grade->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Grade can not be deleted."]);
        }
        elseif (!GradeSubject::where('grade_id',$grade->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Grade can not be deleted."]);
        }
        else{
            $grade->delete();
            return redirect(route('grade.index'))->with('alert',"The Grade has been deleted.");
        }
    }
}
