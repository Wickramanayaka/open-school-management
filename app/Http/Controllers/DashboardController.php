<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
use App\ClassRoom;
use App\Subject;
use App\Grade;
use App\Exam;
use App\StudentAttendance;
use App\Chart;
use App\TeacherAttendance;

class DashboardController extends Controller
{
    // All methods are called by ajax and all methods are only type of GET
    public function getStudentAttendanceForThisMonth()
    {
        $data = StudentAttendance::selectRaw('begin_date as date, sum(attendance) as total')->latest('date')->groupBy('begin_date')->take(10)->get()->reverse();
        $chart = new Chart();
        $chart->col(array(array("Date","string"),array("Count","number")));
        foreach ($data as $item) {
            $chart->row(array($item->date,$item->total));
        }
        return $chart->toString();
    }
    public function getTeacherAttendanceForThisMonth()
    {
        $data = TeacherAttendance::selectRaw('teacher_id, sum(attendance) as total')->orderBy('total','asc')->groupBy('teacher_id')->take(5)->get();
        $chart = new Chart();
        $chart->col(array(array("Name","string"),array("Count","number")));
        foreach ($data as $item) {
            $chart->row(array($item->teacher->surname,$item->total));
        }
        return $chart->toString();
    }
    public function getCount()
    {
        $student = Student::active()->count('id');
        $teacher = Teacher::active()->count('id');
        $class_room = ClassRoom::count('id');
        $subject = Subject::count('id');
        $grade = Grade::count('id');
        $exam = Exam::count('id');
        return response()->json([
            'student' => $student, 
            'teacher' => $teacher, 
            'class_room' => $class_room,
            'subject' => $subject,
            'grade' => $grade,
            'exam' => $exam
        ]);
    }
}
