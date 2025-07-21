<?php

namespace ProactiveAnts\Coverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\ClassRoom;
use App\Student;
use ProactiveAnts\Coverage\Chapter;
use ProactiveAnts\Coverage\Period;
use App\StudentAttendance;
use ProactiveAnts\Coverage\ChapterCoverage;
use App\Chart;
use ProactiveAnts\Coverage\Feedback;
use App\Teacher;
use ProactiveAnts\Coverage\Device;
use ProactiveAnts\Coverage\PeriodFeedback;

class CoverageReportController extends Controller
{
    public function teach(Request $request)
    {
        return view('coverage::reports.teach',['class_rooms' => ClassRoom::all(),'teachers' => Teacher::all(),'subjects' => Subject::all()]);
    }
    public function attendance(Request $request)
    {
        return view('coverage::reports.attendance',['class_rooms' => ClassRoom::all(),'teachers' => Teacher::all()]);
    }
    public function feedback(Request $request)
    {
        return view('coverage::reports.feedback',['class_rooms' => ClassRoom::all(),'teachers' => Teacher::all(),'subjects' => Subject::all()]);
    }
    public function postTeach(Request $request)
    {
        $this->validate($request,[
            'date_from' => 'required',
            'date_to' => 'required'
        ]);

        // Calculate number of week in the date period
        $date_from = \Carbon\Carbon::createFromFormat('Y-m-d',$request->date_from)->startOfWeek();
        $date_to = \Carbon\Carbon::createFromFormat('Y-m-d',$request->date_to)->endOfWeek();
        $diff = $date_to->diffInDays($date_from);
        $week = ($diff+1)/7;
        $periods = Period::selectRaw('teacher_id,class_room_id,subject_id, sum(difference) as total,teacher_role')
        ->where('date','>=',$request->date_from)
        ->where('date','<=',$request->date_to)
        ->where('type','TEACHING')
        ->where(function($query) use($request){
            if($request->has('teacher_id')){
                $query->whereIn('teacher_id',$request->teacher_id);
            }
        })
        ->where(function($query) use($request){
            if($request->has('class_room_id')){
                $query->whereIn('class_room_id',$request->class_room_id);
            }
        })
        ->where(function($query) use($request){
            if($request->has('subject_id')){
                $query->whereIn('subject_id',$request->subject_id);
            }
        })
        ->orderBy('teacher_id')
        ->groupBy(['teacher_id','class_room_id','subject_id','teacher_role'])
        ->get();
        return (String) view('coverage::reports.ajax.teach_list',['periods'=>$periods,'date_from'=>$request->date_from,'date_to'=>$request->date_to,'week'=> $week]);
    }
    public function postAttendance(Request $request)
    {
        $this->validate($request,[
            'date_from' => 'required',
            'date_to' => 'required'
        ]);
        $periods = Period::where('date','>=',$request->date_from)->where('date','<=',$request->date_to)->where('type','TEACHING')->orderBy('teacher_id');
        if($request->has('teacher_id')){
            $periods = $periods->whereIn('teacher_id',$request->teacher_id);
        }
        if($request->has('class_room_id')){
            $periods = $periods->whereIn('class_room_id',$request->class_room_id);
        }
        $periods = $periods->get();
        return (String) view('coverage::reports.ajax.attendance_list',['periods'=>$periods,'date_from'=>$request->date_from,'date_to'=>$request->date_to]);
    }
    public function postFeedback(Request $request)
    {
        $this->validate($request,[
            'date_from' => 'required',
            'date_to' => 'required'
        ]);
        $periods = PeriodFeedback::selectRaw('teacher_id,class_room_id,subject_id,sum(rating)/count(rating) as final')
        ->where('date','>=',$request->date_from)
        ->where('date','<=',$request->date_to)
        ->where(function($query) use($request){
            if($request->has('teacher_id')){
                $query->whereIn('teacher_id',$request->teacher_id);
            }
        })
        ->where(function($query) use($request){
            if($request->has('class_room_id')){
                $query->whereIn('class_room_id',$request->class_room_id);
            }
        })
        ->where(function($query) use($request){
            if($request->has('subject_id')){
                $query->whereIn('subject_id',$request->subject_id);
            }
        })
        ->groupBy(['teacher_id','class_room_id','subject_id'])
        ->get();
        return (String) view('coverage::reports.ajax.feedback_list',['periods'=>$periods,'date_from'=>$request->date_from,'date_to'=>$request->date_to]);
    }
}
