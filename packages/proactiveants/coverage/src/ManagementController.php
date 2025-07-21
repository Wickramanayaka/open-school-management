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
use ProactiveAnts\Coverage\Warning;

class ManagementController extends Controller
{
    public function index()
    {
       return view('coverage::index');
    }
    public function classRoom()
    {
        //$devices = Device::all();
        //$devices = classRoom::all();
        $devices = classRoom::where('id','>','35')->where('id','<','131')->get();
        $data = [];
        foreach ($devices as $device) {
            $count = 0;
            //if(substr($device->name,-6)<>"DEVICE"){
                // Check for class rooms with teachers
                $period = Period::where('class_room_id',$device->id)->whereNull('time_out')->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->first();
                if($period==null){
                    $type = true;
                    $teacher = "";
                    $subject = "";
                    $teacher_role = "";
                }
                else{
                    $type = false;
                    $teacher = $period->teacher->surname;
                    $subject = $period->subject->name;
                    $teacher_role = $period->teacher_role=="TEMPORARY"?"[T]":"";
                }
                // Marked register
                $period_reg = Period::where('class_room_id',$device->id)->where('type','REGISTER')->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->first();
                if($period_reg==null){
                    $registered = false;
                }
                else{
                    $registered = true;
                }
                $period_count = Period::where('class_room_id',$device->id)->whereNull('time_out')->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->count();
                if($period_count>0){
                    $count = $period_count;
                }
                else{
                    $count = 0;
                }
                // Check for warning
                $warning = Warning::where('class_room_id',$device->id)->whereNull('warning_off')->first();
                if($warning==null){
                    $warning = false;
                }
                else{
                    $warning = true;
                }

                $student_count = Student::where('present_class_room_id',$device->id)->count();
                $student_ids = Student::where('present_class_room_id',$device->id)->pluck('id')->toArray();
                $attendance = StudentAttendance::whereIn('student_id',$student_ids)->where('begin_date',\Carbon\Carbon::now()->format('Y-m-d'))->count();

                // get last period feedback
                $best = false;
                $good = false;
                $bad = false;
                $total = 0;
                $last_period = Period::where('class_room_id',$device->id)->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->orderBy('id','desc')->first();
                if($last_period != null){
                    $last_feedback = Feedback::where('period_id',$last_period->id)->get();
                    if(count($last_feedback)>0){
                        $total = $last_feedback->sum('point')/$last_feedback->count('point');
                        if($total >= 70){
                            $best = true;
                        }
                        elseif($total >= 34){
                            $good = true;
                        }
                        else{
                            $bad = true;
                        }
                    }
                }
                $data[] = [
                    'id' => $device->id,
                    'name' => $device->name,
                    'type' => $type,
                    'registered' => $registered,
                    'count' => $count,
                    'teacher' => $teacher,
                    'subject' => $subject,
                    'warning' => $warning,
                    'teacher_role' => $teacher_role,
                    'attendance' => $attendance . "/" . $student_count,
                    'best' => $best,
                    'good' => $good,
                    'bad' => $bad,
                    'total' => $total
                ];
            //}
        }
        return $data;
    }
    public function view($id)
    {
        $class_room =ClassRoom::findOrFail($id);
        $teacher = Teacher::where('present_class_room_id',$class_room->id)->first();
        $subjects = Subject::where('grade_id',$class_room->grade_id)->get();
        $periods = Period::where('class_room_id',$id)->orderBy('id')->get();
        $period_ids = Period::where('class_room_id',$id)->orderBy('id')->pluck('id')->toArray();
        $today_periods = Period::where('class_room_id',$id)->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->orderBy('id')->get();
        //$feedbacks = Feedback::whereIn('period_id',$period_ids)->selectRaw('teacher_id,sum(point) as total, count(point) as number_of')->groupBy('teacher_id')->get();
        
        // New change the feedback only shows today per teacer per subject. A teacher may get feedback icon for each subject
        $today_period_ids = Period::where('class_room_id',$id)->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->orderBy('id')->pluck('id')->toArray();
        $feedbacks = Feedback::whereIn('period_id',$today_period_ids)->selectRaw('period_id,sum(point) as total, count(point) as number_of')->groupBy('period_id')->get();
        
        return view('coverage::view', compact('periods','id','class_room','feedbacks','teacher','subjects','today_periods'));
    }
    public function chart($id)
    {
        $class_room =ClassRoom::findOrFail($id);
        $subjects = Subject::where('grade_id',$class_room->grade->id)->get();
        $subject_complete = [];
        foreach($subjects as $subject){
            $duration = 0;
            $periods = Period::where('subject_id',$subject->id)->where('class_room_id',$class_room->id)->where('academic_year_id',getCurrentAcademicYear()->id)->get();
            foreach($periods as $period){
                if($period->time_out==null){

                }
                else{
                    // Check the period within the week

                    $week_start=\Carbon\Carbon::now()->startOfWeek();
                    $week_end=\Carbon\Carbon::now()->endOfWeek();
                    if($period->date >= $week_start && $period->date <= $week_end){
                        $diff = $period->time_out->diffInMinutes($period->time_in);
                        $duration = $duration + $diff;
                    }
                    
                }
            }
            $subject_complete[] = [
                'name' => $subject->name,
                'language' => $subject->language->name,
                'complete' => $subject->duration>0?number_format(($duration/$subject->duration)*100,0):0
            ];
        }
        $chart = new Chart();
        $chart->col(array(array("Subject","string"),array("Coverage","number")));
        foreach ($subject_complete as $item) {
            $chart->row(array($item['name']." (".$item['language'].")",$item['complete']));
        }
        return $chart->toString();
    }
    public function attendance($id)
    {
        $class_room =ClassRoom::findOrFail($id);
        $student_count = Student::where('present_class_room_id',$class_room->id)->count();
        $student_ids = Student::where('present_class_room_id',$class_room->id)->pluck('id')->toArray();
        $attendance = StudentAttendance::whereIn('student_id',$student_ids)->where('begin_date',\Carbon\Carbon::now()->format('Y-m-d'))->count();
        $chart = new Chart();
        $chart->col(array(array("Attendance","string"),array("Count","number")));
        $chart->row(array("Present",$attendance));
        $chart->row(array("Absent",$student_count - $attendance));
        return $chart->toString();
    }
    public function period($id)
    {
        $class_room =ClassRoom::findOrFail($id);
        $periods = Period::where('class_room_id',$class_room->id)->where('date',\Carbon\Carbon::now()->format('Y-m-d'))->where('type','TEACHING')->orderBy('id')->get();
        $chart = new Chart();
        $chart->col(array(array("Period","string"),array("Duration","number")));
        $i=1;
        foreach ($periods as $period) {
            $chart->row(array($i,$period->time_out==null?'0':$period->time_out->diffInMinutes($period->time_in)));
            $i++;
        }
        return $chart->toString();
    }
}
