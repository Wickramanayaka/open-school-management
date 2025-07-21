<?php

namespace ProactiveAnts\Discipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;

class DisciplineController extends Controller
{
    public function getStudent(Request $request)
    {
        $student = new Student();
        if($request->has('id')){
            $student = Student::where('admission_number', $request->id)->first();
        }
        return (String) view('discipline::ajax.student_info',['student' => $student]);
    }

}
