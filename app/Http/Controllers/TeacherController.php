<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Address;
use App\Map;
use App\ClassRoom;
use App\ClassRoomTeacher;
use App\AcademicYear;
use App\Subject;
use App\SubjectTeacher;
use File;
use Auth;
use App\Transport;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('name')){
            $teachers = Teacher::where('id_number',$request->name)
                ->orWhere('surname','like','%' .$request->name. '%')
                ->orWhere('email','like','%' .$request->name. '%')
                ->orWhere('telephone','like','%' .$request->name. '%')
                ->orWhere('first_name','like','%' .$request->name. '%')
                ->orWhere('other_name','like','%' .$request->name. '%')
                ->orWhere('admission_number',$request->name)
                ->orderBy('surname')->paginate(25);
        }
        else {
            $teachers = Teacher::orderBy('surname')->paginate(25);
        }
        return view('teachers.index',['teachers'=> $teachers,'parameter' => $request->name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create',['transports' => Transport::all()]);
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
            'surname' => 'required',
            'first_name' => 'required',
            'telephone' => 'required',
            'admission_number' => 'required|unique:teachers',
            'id_number' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required'
        ]);

        $data = $request->all();

        // Formulate the address
        $address = Address::create($request->all());
        $data['address_id'] = $address->id;
        $address->save();
        // Formulate temporary addres   
        $temp_address = Address::create(['address' => $request->temporary_address]);
        $data['temporary_address_id'] = $temp_address->id;
        $temp_address->save(); 

        // Check for the photo
        if($request->file('photo')){
            $validated_data = $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif,tiff|max:1024',
            ]);
            $file_name = str_random(16) . "_" . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('images/profiles/teachers'),$file_name);
            $data['photo'] = $file_name;
        }
        $teacher = Teacher::create($data);
        // Go to teacher's profile to complate other info
        return redirect(route('teacher.show',$teacher->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject_teach = SubjectTeacher::where('teacher_id',$id)->where('academic_year_id',getCurrentAcademicYear()->id)->get();
        return view('teachers.view',['teacher'=>Teacher::find($id),'class_rooms'=> ClassRoom::all(),'subject_teach' => $subject_teach]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('teachers.edit',['teacher'=>Teacher::find($id),'transports' => Transport::all()]);
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
        $this->validate($request,[
            'surname' => 'required',
            'first_name' => 'required',
            'date_of_birth' => 'required',
            'telephone' => 'required',
            'id_number' => 'required',
            'admission_number' => 'required|unique:teachers,admission_number,' . $id
        ]);

        $teacher = Teacher::find($id);
        $data = $request->all();
        // Update the address
        $address = Address::find($teacher->address_id);
        $address->update($request->all());
        $address->save();
        // Update temporary address
        $temp_address = Address::find($teacher->temporary_address_id);
        // If not exists create new
        if($temp_address==null){
            $temp_address = Address::create(['address' => $request->temporary_address]);
            $data['temporary_address_id'] = $temp_address->id;
        }
        else{
            $temp_address->update(['address' => $request->temporary_address]);
        }
        $temp_address->save();
        $teacher->update($data);
        // Go to teacher's profile to complate other info
        return redirect(route('teacher.show',$id))->with('alert','Teacher\'s basic information has got updated.');
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

    public function photo_upload(Request $request)
    {
        if($request->file('photo')){
            $validated_data = $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif,tiff|max:1024',
            ]);
            $file_name = str_random(16) . "_" . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('images/profiles/teachers'),$file_name);
            $teacher = Teacher::find($request->id);
            $teacher->photo = $file_name;
            $teacher->save();
        }
        return redirect(route('teacher.show',$teacher->id))->with('alert','Profile photo has been updated successfully.');

        
    }

    public function Download()
    {
        $teachers = Teacher::all();
        $content = '';
        $content .= "id,name,address,telephone,email\n";
        foreach ($teachers as $teacher){
            $content .= "$teacher->id_number,$teacher->fullName,\"" . $teacher->address->address . "\",$teacher->telephone,$teacher->email\n";
        }
        File::put(storage_path('app\templates\teacher_list.csv'),$content);
        return response()->download(storage_path('app\templates\teacher_list.csv'));
    }

    public function change_class(Request $request)
    {
        $this->validate($request,[
            'class_room_id' => 'required',
            'date' => 'required',
            'teacher_id' => 'required'
        ]);
        ClassRoomTeacher::create([
            'teacher_id' => $request->teacher_id,
            'class_room_id' => $request->class_room_id,
            'date' => $request->date,
            'comment' => 'Assigned by ' . Auth::user()->name,
            'academic_year_id' => getCurrentAcademicYear()->id
        ]);
        // Update present class room id
        $teacher = Teacher::find($request->teacher_id);
        $teacher->present_class_room_id = $request->class_room_id;
        $teacher->save();
        return redirect()->back()->with('alert','Class Room has been changed.');

    }

    public function resign(Request $request, $id)
    {
        $this->validate($request,[
            'teacher_id' => 'required',
            'is_left' => 'required',
            'date_left' => 'required',
            'reason_left' => 'required'
        ]);
        $teacher = Teacher::find($request->teacher_id);
        $teacher->update($request->all());
        return redirect()->back()->with('alert','Teacher has been resigned.');
    }

    public function teach($id)
    {
        $teacher = Teacher::find($id);
        $academic_years = AcademicYear::orderByDesc('id')->get();
        $class_rooms = ClassRoom::all();
        $subjects = Subject::all();
        $subject_teachers = SubjectTeacher::where('teacher_id',$id)->get();
        return view('subject_teachers.create',['teacher_id'=> $id,'academic_years'=>$academic_years,'class_rooms' => $class_rooms, 'subjects' => $subjects,'subject_teachers' => $subject_teachers,'teacher'=>$teacher]);
    }

    public function postTeach(Request $request, $id)
    {
        $this->validate($request,[
            'academic_year_id' => 'required',
            'subject_id' => 'required',
            'class_room_id' => 'required'
        ]);
        foreach ($request->class_room_id as $class_room_id) {
            SubjectTeacher::create([
                'teacher_id' => $id,
                'subject_id' => $request->subject_id,
                'academic_year_id' => $request->academic_year_id,
                'class_room_id' => $class_room_id,
                'remark' => ''
            ]);
        }
        return redirect()->back();
    }
}
