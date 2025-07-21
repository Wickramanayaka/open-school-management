<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Language;
use App\AcademicYear;
use App\GradeSubject;
use App\SubjectTeacher;
use App\Grade;
use App\ClassRoom;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        $languages = Language::all();
        $grades = Grade::all();
        return view('subjects.index',compact('subjects','languages','grades'));
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
            'code' => 'required|unique:subjects',
            'name' => 'required',
            'language_id' => 'required',
            'description' => 'required',
            'grade_id' => 'required'
        ]);
        Subject::create($request->all());
        return redirect(route('subject.index'))->with('alert','The subject has been created successfuly.');
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

        $subject = Subject::find($id);
        $languages = Language::all();
        $grades = Grade::all();
        return view('subjects.edit',compact('subject','languages','grades'));
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
            'code' => 'required|unique:subjects,code,' .$id,
            'name' => 'required',
            'language_id' => 'required',
            'description' => 'required',
            'grade_id' => 'required'
        ]);
        $data = $request->all();
        if($request->has('compulsory')){
            $data['compulsory'] = 1;
        }
        else{
            $data['compulsory'] = 0;
        }
        Subject::findOrFail($id)->update($data);
        return redirect(route('subject.index'))->with('alert','The subject has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        //Check uses for subjects
        if (!GradeSubject::where('subject_id',$subject->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Subject can not be deleted."]);
        }
        elseif (!SubjectTeacher::where('subject_id',$subject->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Subjectcan not be deleted."]);
        }
        else{
            $subject->delete();
            return redirect(route('subject.index'))->with('alert',"The Subject has been deleted.");
        }
    }

    public function getAjax(Request $request)
    {
        // Get class room object
        $class_room = ClassRoom::findOrFail($request->id);
        $subjects = Subject::where('grade_id',$class_room->grade_id)->get();
        $subject_array = [];
        foreach($subjects as $item){
            $subject_array[] = [
                'id' => $item->id,
                'name' => $item->name,
                'language' => $item->language->name,
                'code' => $item->code
            ];
        }
        return ['subjects' => $subject_array];
    }
}
