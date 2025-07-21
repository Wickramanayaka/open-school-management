<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Grade;
use App\Subject;

class VideoController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('videos.index', compact('grades','subjects'));
    }
    public function get(Request $request)
    {
        $this->validate($request,[
            'grade' => 'required',
            'subject' => 'required'
        ]);
        $videos = Video::where('grade_id', $request->grade)->where('subject_id', $request->subject)->orderBy('number')->get();
        return (string) view('videos.video_list', compact('videos'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'grade' => 'required',
            'subject' => 'required',
            'number' => 'required',
            'name' => 'required',
            'url' => 'required'
        ]);
        $video = Video::create([
            'grade_id' => $request->grade,
            'subject_id' => $request->subject,
            'number' => $request->number,
            'name' => $request->name,
            'url' => $request->url,
        ]);
        return 1;
    }

    public function getSubject($id)
    {
        $subjects = Subject::where('grade_id', $id)->get();
        return $subjects;
    }

    public function delete($id)
    {
       $video = Video::findOrFail($id);
       $video->delete();
       return 1;
    }
}
