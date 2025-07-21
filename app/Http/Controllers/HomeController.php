<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Grade;
use App\Student;
use App\Subject;
use App\StudentExamRank;
use App\Exam;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = [];
        $students = Student::active()->get();
        foreach ($students as $student) {
            $lat = $student->address->latitude;
            $lng = $student->address->longitude;
            $cities[] = [
                "new google.maps.LatLng($lat,$lng)"
            ];
        }
        // Get the latest exam
        $exam = Exam::orderBy('end','desc')->pluck('id')->first();
        $ranks = StudentExamRank::orderBy('average','desc')->where('exam_id',$exam)->take(10)->get();
        $subjects = Subject::all();
        
        if(Auth::user()->can('admin dashboard')){
            return view('dashboard',['sections' => Section::all(), 'grades' => Grade::all(), 'cities' => $cities, 'subjects' => $subjects, 'ranks' => $ranks]);
        }
        else{
            return view('dashboard_teacher',['grades' => Grade::all(),'subjects' => $subjects, 'ranks' => $ranks]);
        }
        
    }

    
}
