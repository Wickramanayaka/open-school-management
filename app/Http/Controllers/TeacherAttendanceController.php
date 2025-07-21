<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use File;
use App\TeacherAttendance;
use App\DataImport;

class TeacherAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get current Academic Year
        $academic_year = getCurrentAcademicYear();
        $total_attendance_for_year = $academic_year->terms->sum('number_of_days');
        if($total_attendance_for_year==0) $total_attendance_for_year=270;

        return view('attendances.teachers.index',['teachers' => Teacher::all(),'total' => $total_attendance_for_year]);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bulk()
    {
        return view('attendances.teachers.create_bulk');
    }
    
    public function download()
    {
        $teachers = Teacher::all();
        $content = '';
        $content .= "id,id_number,name,begin,end,count\n";
        foreach ($teachers as $teacher){
            $content .= "$teacher->id,$teacher->id_number,$teacher->fullName,,,,\n";
        }
        File::put(storage_path('teacher_attendance.csv'),$content);
        return response()->download(storage_path('teacher_attendance.csv'));
    }

    public function postBulk(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);
        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            foreach ($data as $item) {
                TeacherAttendance::create([
                    'teacher_id' => $item['id'],
                    'begin_date' => $item['begin'],
                    'end_date' => $item['end'],
                    'attendance' => $item['count'],
                ]);
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }

    /**
     * This new functionality is only for capturing teacher in time only.
     * Teacher out will not track here.
     */
    public function daily()
    {
        $teachers = Teacher::active()->orderBy('surname')->get();
        return view('attendances.teachers.create_daily', compact('teachers'));
    }

    public function postDaily(Request $request)
    {
        // Delete all today records
        $attendace = TeacherAttendance::where('begin_date', date('Y-m-d'))->delete();
        if($request->has('teacher')){
            foreach ($request->teacher as $key => $value) {
                TeacherAttendance::create([
                    'teacher_id' => $value,
                    'frequency' => 1,
                    'begin_date' => now(),
                    'end_date' => now(),
                    'attendance' => 1,
                    'remark' => ''
                ]);
            }
        }
        return redirect(route('teacherAttendance.dailyView'));
    }

    public function dailyView()
    {
        $teachers = Teacher::active()->get();
        $list = [];
        foreach($teachers as $teacher){
            $attendace = TeacherAttendance::where('begin_date', date('Y-m-d'))->where('teacher_id', $teacher->id)->first();
            $list[] =[
                'name' => $teacher->fullName,
                'attendance' => $attendace==null?"No":"Yes"
            ];
        }
        return (string) view('attendances.teachers.daily_view',compact('list'));
    }
}
