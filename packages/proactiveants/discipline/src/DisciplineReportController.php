<?php

namespace ProactiveAnts\Discipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClassRoom;
use App\Grade;
use App\Student;
use App\AcademicYear;
use ProactiveAnts\Discipline\Disobedience;
use ProactiveAnts\Discipline\DisobedienceCategory;
use ProactiveAnts\Discipline\PointBalance;


class DisciplineReportController extends Controller
{

    public function getDisobedience()
    {
        $class_rooms = ClassRoom::all();
        $grades = Grade::all();
        $disobediences = Disobedience::all();
        $categories = DisobedienceCategory::all();
        return view("discipline::reports.disobedience",compact('class_rooms','grades','disobediences','categories'));
    }

    public function postDisobedience(Request $request)
    {
        $this->validate($request,[
            'date_from' => 'required',
            'date_to' => 'required'
        ]);
        $disobediences = DisobedienceStudent::orderBy('date')
            ->where('date','>=',$request->date_from)
            ->where('date','<=',$request->date_to)
            ->where(function($query) use($request){
                if($request->has('grade_id')){
                    $class_rooms = ClassRoom::whereIn('grade_id',$request->grade_id)->pluck('id')->toArray();
                    $students = Student::whereIn('present_class_room_id',$class_rooms)->pluck('id')->toArray();
                    $query->whereIn('student_id',$students);
                }
            })
            ->where(function($query) use($request){
                if($request->has('class_room_id')){
                    $students = Student::whereIn('present_class_room_id',$request->class_room_id)->pluck('id')->toArray();
                    $query->whereIn('student_id',$students);
                }
            })
            ->where(function($query) use($request){
                if($request->has('category_id')){
                    $disobeys = Disobedience::whereIn('disobedience_category_id',$request->category_id)->pluck('id')->toArray();
                    $query->whereIn('disobedience_id',$disobeys);
                }
            })
            ->where(function($query) use($request){
                if($request->has('disobedience_id')){
                    $query->whereIn('disobedience_id',$request->disobedience_id);
                }
            })
            ->where(function($query) use($request){
                if($request->has('admission_number') && !$request->admission_number==''){
                    $student = Student::where('admission_number',$request->admission_number)->pluck('id')->toArray();
                    $query->whereIn('student_id',$student);
                }
            })
            ->get();
        return (String) view('discipline::ajax.disobedience_list',['disobediences'=>$disobediences,'date_from'=>$request->date_from,'date_to'=>$request->date_to]);
    }
    public function getPoint()
    {
        $class_rooms = ClassRoom::all();
        $grades = Grade::all();
        return view("discipline::reports.point",compact('class_rooms','grades'));
    }

    public function postPoint(Request $request)
    {
        $this->validate($request,[
            'date_to' => 'required'
        ]);
        // Get academic year begin date from the given date
        $year = AcademicYear::where('start','<=',$request->date_to)->where('end','>=',$request->date_to)->first();
        if($year==null){
            return new PointBalance();
        }    
        $points = PointBalance::orderBy('student_id')
            ->where('created_at','>=',$year->start)
            ->where('created_at','<=',$request->date_to)
            ->where(function($query) use($request){
                if($request->has('grade_id')){
                    $class_rooms = ClassRoom::whereIn('grade_id',$request->grade_id)->pluck('id')->toArray();
                    $students = Student::whereIn('present_class_room_id',$class_rooms)->pluck('id')->toArray();
                    $query->whereIn('student_id',$students);
                }
            })
            ->where(function($query) use($request){
                if($request->has('class_room_id')){
                    $students = Student::whereIn('present_class_room_id',$request->class_room_id)->pluck('id')->toArray();
                    $query->whereIn('student_id',$students);
                }
            })
            ->where(function($query) use($request){
                if($request->has('admission_number') && !$request->admission_number==''){
                    $student = Student::where('admission_number',$request->admission_number)->pluck('id')->toArray();
                    $query->whereIn('student_id',$student);
                }
            })
            ->selectRaw('student_id, sum(point) as point, sum(deduct) as deduct, sum(point-deduct) as balance')
            ->groupBy('student_id')
            ->orderBy('student_id');
            

            if(!$request->point_from==null){
                $points->having('balance','>=',$request->point_from);
            }

            if(!$request->point_to==null){
                $points->having('balance','<=',$request->point_to);
            }

            $points = $points->get();
            
        return (String) view('discipline::ajax.point_list',['points'=>$points,'date_from'=>$year->start,'date_to'=>$request->date_to]);
    }
    
}
