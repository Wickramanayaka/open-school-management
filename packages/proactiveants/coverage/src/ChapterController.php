<?php

namespace ProactiveAnts\Coverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use ProactiveAnts\Coverage\Chapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coverage::chapters.index',['subjects' => Subject::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $subject = Subject::findOrFail($id);
        $chapters = Chapter::where('subject_id',$id)->orderBy('number')->get();
        return view('coverage::chapters.create',compact('subject','chapters'));
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
            'subject_id' => 'required',
            'name' => 'required',
            'number' => 'required',
            'number_of_period' => 'required'
        ]);
        Chapter::create($request->all());
        return redirect()->back();
        //dd($request->all());
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
        $chapter = Chapter::findOrFail($id);
        return view('coverage::chapters.edit',compact('chapter'));
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
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->all());
        $chapter->save();
        return redirect(url("chapter/$chapter->subject_id/create"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();
        return redirect()->back();
    }
}
