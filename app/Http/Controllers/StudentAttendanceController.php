<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassRoom;
use App\AcademicYear;
use App\Student;
use App\StudentAttendance;
use Storage;
use ZipArchive;
use App\DataImport;
//use App\Events\AttendanceMarking;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_rooms = ClassRoom::all();
        return view('attendances.students.index', compact('class_rooms'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendances.students.create',['class_rooms' => ClassRoom::all()]);
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
            'date' => 'required',
            'class_room_id' => 'required',
            'present' => 'required'
        ]);
        $count = 0;

        foreach ($request->present as $id) {
            StudentAttendance::create([
                'student_id' => $id,
                'begin_date' => $request->date,
                'end_date' => $request->date,
                'frequency' => 1,
                'attendance' => 1
            ]);
            $count++;
        }
        // If the SMS module installed use the event
        if(class_exists('\App\Events\AttendanceMarking'))
        {
            // Get absebt students
            $students = Student::where('present_class_room_id', $request->class_room_id)->whereNotIn('id',$request->present)->get();
            foreach($students as $student){
                event(new \App\Events\AttendanceMarking($student));
            }
        }
      
        return redirect(route('studentAttendance.create'))->with('alert','Number of attendaces are ' . $count);
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
        return view('attendances.students.create_bulk');
    }

    public function getStudent(Request $request)
    {
       $this->validate($request,[
           'class_room_id' => 'required'
       ]);
       $students = Student::whereIn('present_class_room_id',$request->class_room_id)->get();
       return (string) view('partials.ajax.student_attendance_daily',['students' => $students]) ;
    }

    public function find(Request $request)
    {
        // If the all the fields empty return empty array
        if($request->class_room_id==''){
            $students = [];
            return (String) view('partials.ajax.student_attendance',['students'=>$students]);
        }

        // Get current Academic Year
        $academic_year = getCurrentAcademicYear();
        $total_attendance_for_year = $academic_year->terms->sum('number_of_days');
        if($total_attendance_for_year==0) $total_attendance_for_year=270;

        $students = Student::where(function($query)use($request){
                    if($request->class_room_id<>''){
                        $query->where('present_class_room_id',$request->class_room_id);
                    }
                });
                
        $students = $students->get();
        return (String) view('partials.ajax.student_attendance',['students'=>$students,'total' => $total_attendance_for_year]);
    }

    public function download()
    {
        // Generate attendace upload files for each grade (Ex: 5,6,7,...)

        $class_rooms = ClassRoom::all();
        foreach ($class_rooms as $class_room){
            $content = '';
            $content .= "id,admission_number,name,begin,end,count\n";
            foreach ($class_room->currentStudents as $student) {
                $content .= "$student->id,$student->admission_number,$student->fullName,,,,\n";
            }
            Storage::disk('zip')->put($class_room->name . '.csv',$content);
        }
        
        $files = glob(storage_path('app/templates/attendances/zip/*.csv'));
        $archive_file = storage_path('app/download/files.zip');
        $archive = new ZipArchive();

        if($archive->open($archive_file, ZipArchive::CREATE | ZipArchive::OVERWRITE)){
            foreach ($files as $file) {
                if($archive->addFile($file,basename($file))){
                    continue;
                }
                else{
                    //
                }
            }
            if($archive->close()){
                return response()->download($archive_file,basename($archive_file))->deleteFileAfterSend(true);
            }
            else{
                //
            }
        }
        else{
            //
        }
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
                StudentAttendance::create([
                    'student_id' => $item['id'],
                    'begin_date' => $item['begin'],
                    'end_date' => $item['end'],
                    'attendance' => $item['count'],
                ]);
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }
}
