<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Cluster;
use App\House;
use App\ClassRoom;
use App\AcademicYear;
use App\Address;
use App\Grade;
use App\Division;
use App\Map;
use App\ClassRoomStudent;
use App\StudentParent;
use App\Siblin;
use App\Term;
use App\PaymentCategory;
use App\Exam;
use App\Payment;
use App\ExamMark;
use App\StudentExamRank;
use App\Subject;
use App\SubjectStudent;
use File;
use App\EmergencyContact;
use App\Transport;
use App\Occupation;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class_rooms = ClassRoom::all();
        $houses = House::all();
        $clusters = Cluster::all();
        $academic_years = AcademicYear::orderBy('start','desc')->get();
        $transports = Transport::all();
        if(count($class_rooms)==0 || count($houses)==0 || count($clusters)==0 || count($academic_years)==0){
            return view('dependancy',['message' => 'In order to create a student following data exists on the application is must. Academic years, class rooms, houses, and clusters.']);
        }
        return view('students.create',compact('class_rooms','houses','clusters','academic_years','transports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated_data = $request->validate([
            'admission_number' => 'required|unique:students',
            'surname' => 'required',
            'first_name' => 'required',
            'admitted_date' => 'required',
            'admitted_academic_year_id' => 'required',
            'admitted_class_room_id' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'house_id' => 'required',
            'cluster_id' => 'required'
        ]);

        $data = $request->all();

        // Formulate the address
        $address = Address::create($request->all());
        $data = $request->all();
        $data['address_id'] = $address->id;
        // Add present class room
        $data['present_class_room_id'] = $request->admitted_class_room_id;

        // Get GEo location and update address
        $map = new Map();
        $map_data = $map->getLatLng($address);
        $address->latitude = $map_data['lat'];
        $address->longitude = $map_data['lng'];
        $address->save();

        // Check for the photo
        if($request->file('photo')){
            $validated_data = $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif,tiff|max:1024',
            ]);
            $file_name = str_random(16) . "_" . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('images/profiles/students'),$file_name);
            $data['photo'] = $file_name;
        }

        // Create empty parent record and attache it to student
        $parent = new StudentParent();
        $parent->save();
        $data['student_parent_id'] = $parent->id;
        // Create empty emergency contact record and attached it to student
        $emergency = new EmergencyContact();
        $emergency->save();
        $data['emergency_contact_id'] = $emergency->id;

        // Create student
        $student = Student::create($data);

        // Put student into a Class Room (the class room is the same as admitted class room)
        ClassRoomStudent::create([
            'student_id' => $student->id,
            'class_room_id' => $student->admitted_class_room_id,
            'academic_year_id' => $student->admitted_academic_year_id,
            'date' => $student->admitted_date,
            'comment' => 'New admission'
        ]);
        // Allocate all subjects belongs to the class room
        $class_room = ClassRoom::find($student->admitted_class_room_id);
        $subjects = Subject::where('grade_id',$class_room->grade_id)->compulsory()->get();
        foreach($subjects as $subject){
            SubjectStudent::create([
                'student_id' => $student->id,
                'subject_id' => $subject->id,
                'academic_year_id' => $student->admitted_academic_year_id
            ]);
        }
        return redirect(route('student.show',$student->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam_marks = ExamMark::where('student_id',$id)->selectRaw('exam_id, sum(mark) as sum, sum(case when not_relavent = 0 then 1 else 0 end) as number')->groupBy('exam_id')->get();
        $exam_ranks = StudentExamRank::where('student_id',$id)->get();
        $exams = Exam::all();
        $academic_years = AcademicYear::all();
        $terms = Term::all();
        $categories = PaymentCategory::all();
        $payments = Payment::where('student_id',$id)->get();
        $subjects = SubjectStudent::where('student_id',$id)->where('academic_year_id', getCurrentAcademicYear()->id)->get();
        $occupations = Occupation::orderBy('id')->get();
        return view('students.view',[
            'student' => Student::find($id),
            'student_list' => Student::active()->get(),
            'academic_years' => $academic_years,
            'terms' => $terms,
            'exam_marks' => $exam_marks,
            'categories' => $categories,
            'payments' => $payments,
            'exams'=> $exams,
            'exam_ranks' => $exam_ranks,
            'subjects' => $subjects,
            'occupations' => $occupations
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class_rooms = ClassRoom::all();
        $houses = House::all();
        $clusters = Cluster::all();
        $academic_years = AcademicYear::all();
        $student = Student::find($id);
        $transports = Transport::all();
        return view('students.edit',compact('class_rooms','houses','clusters','academic_years','student','transports'));
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
        $validated_data = $request->validate([
            'admission_number' => 'required|unique:students,admission_number,' .$id,
            'surname' => 'required',
            'first_name' => 'required',
            'admitted_date' => 'required',
            'admitted_academic_year_id' => 'required',
            'admitted_class_room_id' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'house_id' => 'required',
            'cluster_id' => 'required'
        ]);

        $data = $request->all();
        $student = Student::find($id);

        // Formulate the address
        $address = Address::find($student->address_id);

        // Get GEo location and update address
        $map = new Map();
        $map_data = $map->getLatLng($address);
        $address->latitude = $map_data['lat'];
        $address->longitude = $map_data['lng'];
        $address->save();

        $address->update($data);
        $data['address_id'] = $address->id;
        
        // Update present class if admitted class room and present class room are equal.
        if($student->present_class_room_id==$student->admitted_class_room_id){
            $data['present_class_room_id'] = $request->admitted_class_room_id;    
        }
           
        // Delete existing class_room_student and add new record
        $class_room = ClassRoomStudent::where('comment','New admission')->where('student_id',$student->id)->first();
        if(!$class_room==null){$class_room->delete();}
              
        ClassRoomStudent::create([
            'student_id' => $student->id,
            'class_room_id' => $student->admitted_class_room_id,
            'academic_year_id' => $student->admitted_academic_year_id,
            'date' => $student->admitted_date,
            'comment' => 'New admission'
        ]);

        $student->update($data);
        return redirect(route('student.show',$student->id))->with('alert','The student infrmation has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        // Delete student class
        ClassRoomStudent::where('student_id', $student->id)->delete();
        $student->delete();
        return redirect('student/find');
    }

    public function find(){
        $grades = Grade::all();
        $divisions = Division::all();
        $houses = House::all();
        $clusters = Cluster::all();
        $academic_years = AcademicYear::all();
        return view('students.find', compact('grades','divisions','houses','clusters','academic_years'));
    }

    public function postFind(Request $request){
        // If the all the fields empty return empty array
        if($request->admission_number=='' && $request->surname=='' && $request->first_name=='' && $request->other_name=='' && $request->cluster_id==0 && 
        $request->admitted_academic_year_id==0 && $request->house_id==0 && $request->grade_id==0 && $request->division_id==0 &&
        $request->town==''){
            $students = [];
            return (String) view('partials.ajax.student_list',['students'=>$students]);
        }

        $students = Student::where(function($query)use($request){
                if($request->admission_number<>''){
                    $query->where('admission_number',$request->admission_number);
                }
                })
                ->where(function($query)use($request){
                    if($request->surname<>''){
                        $query->where('surname','like', '%' . $request->surname . '%');
                    }
                })
                ->where(function($query)use($request){
                    if($request->first_name<>''){
                        $query->where('first_name','like','%' . $request->first_name . '%');
                    }
                })
                ->where(function($query)use($request){
                    if($request->other_name<>''){
                        $query->where('other_name','like','%' . $request->other_name . '%');
                    }
                })
                ->where(function($query)use($request){
                    if($request->cluster_id<>0){
                        $query->where('cluster_id',$request->cluster_id);
                    }
                })
                ->where(function($query)use($request){
                    if($request->admitted_academic_year_id<>0){
                        $query->where('admitted_academic_year_id',$request->admitted_academic_year_id);
                    }
                })
                ->where(function($query)use($request){
                    if($request->house_id<>0){
                        $query->where('house_id',$request->house_id);
                    }
                })
                ->where(function($query)use($request){
                    if($request->grade_id<>0 && $request->division_id==0){
                        $class_room_id = ClassRoom::where('grade_id',$request->grade_id)->pluck('id')->toArray();
                        $query->whereIn('present_class_room_id',$class_room_id);
                    }
                })
                ->where(function($query)use($request){
                    if($request->grade_id<>0 && $request->division_id<>0){
                        $class_room_id = ClassRoom::where('grade_id',$request->grade_id)->where('division_id',$request->division_id)->pluck('id')->toArray();
                        $query->whereIn('present_class_room_id',$class_room_id);
                    }
                })
                ->where(function($query)use($request){
                    if($request->town<>'' && $request->range==''){
                        $address_id = Address::search($request->town)->pluck('id')->toArray();
                        $query->whereIn('address_id',$address_id);
                    }
                })
                ->where(function($query)use($request){
                    if($request->town<>'' && $request->range<>''){
                        //Get GEOCode for givent town append Sri Lanka
                        $map = new Map();
                        $address = new Address();
                        $address->address = $request->town . ', Sri Lanka';
                        $code = $map->getLatLng($address);
                        $address_id = Address::distance([$code['lat'],$code['lng'],$request->range])->pluck('id')->toArray();
                        $query->whereIn('address_id',$address_id);
                    }
                });

                if($request->student_left==1){
                    $students = $students->get();
                }
                else{
                    $students = $students->whereNull('is_left')->get();
                }
        
        return (String) view('partials.ajax.student_list',['students'=>$students]);
    }

    public function quick_find(Request $request)
    {
        if($request->name==''){
            $students = [];
        }
        else{
            $students = Student::whereNull('is_left')->where(function($query) use ($request){
                $query->orWhere('admission_number',$request->name)
                    ->orWhere('surname','like','%' .$request->name. '%')
                    ->orWhere('first_name','like','%' .$request->name. '%')
                    ->orWhere('other_name','like','%' .$request->name. '%');
            })->paginate(20);
        }
        
        return view('students.quick_find',['students' => $students,'name' => $request->name]);
    }

    public function photo_upload(Request $request)
    {
        if($request->file('photo')){
            $validated_data = $request->validate([
                'photo' => 'required|mimes:jpeg,jpg,png,gif,tiff|max:1024',
            ]);
            $file_name = str_random(16) . "_" . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('images/profiles/students'),$file_name);
            $student = Student::find($request->id);
            $student->photo = $file_name;
            $student->save();
        }
        return redirect(route('student.show',$student->id));

        
    }

    public function updateParents(Request $request, $id)
    {
        $parents = StudentParent::find($request->id);
        $parents->update($request->all());
        return redirect(url("student/$id#family"))->with('alert','Information updated successfuly.');
    }

    public function addSiblin(Request $request, $id)
    {
        /**
         * Before adding sibling need to prevent duplication and adding student himself as sibling.
         */
        if($request->has('siblin_id')){
            foreach ($request->siblin_id as $siblin_id) {
                // Check adding himself
                if($id==$siblin_id){
                    continue;
                }
                // Check for duplicate
                $siblin = Siblin::where('left_student_id',$id)->where('right_student_id',$siblin_id)->first();
                if($siblin==null){
                    Siblin::create([
                        'left_student_id' => $id,
                        'right_student_id' => $siblin_id
                    ]);
                    // Create reverse relation
                    // Check for duplication
                    $siblin = Siblin::where('left_student_id',$siblin_id)->where('right_student_id',$id)->first();
                    if($siblin==null){
                        Siblin::create([
                            'left_student_id' => $siblin_id,
                            'right_student_id' => $id
                        ]);
                    }
                }
                
            }
        }
        return redirect(url("student/$id#family"))->with('alert','Information added successfuly.');
    }

    public function leave(Request $request, $id)
    {
        $this->validate($request,[
            'reason_left' => 'required',
            'date_left' => 'required|date'
        ]);
        $student = Student::find($id);
        $student->is_left=1;
        $student->reason_left=$request->reason_left;
        $student->date_left=$request->date_left;
        $student->save();
        return redirect()->back()->with('alert','Information has been saved successfuly.');
    }

    public function Download()
    {
        $students = Student::all();
        $content = '';
        $content .= "id,admission_number,name,address,class_room,date of birth\n";
        foreach ($students as $student){
            $content .= "$student->id,$student->admission_number,$student->fullName,\"" . $student->address->address . "\"," . $student->present_class_room->name . ",$student->date_of_birth\n";
        }
        File::put(storage_path('app\templates\student_list.csv'),$content);
        return response()->download(storage_path('app\templates\student_list.csv'));
    }

    public function learn($id)
    {
        $student = Student::findOrFail($id);
        $student_subjects = SubjectStudent::where('student_id',$id)->where('academic_year_id',getCurrentAcademicYear()->id)->get();
        return view('student_subjects.index',['student' => Student::find($id),'subjects' => Subject::where('grade_id',$student->present_class_room->grade->id)->get(),'student_subjects' => $student_subjects]);
    }

    public function postLearn(Request $request, $id)
    {
        $this->validate($request,[
            'subject_id' => 'required'
        ]);
        foreach ($request->subject_id as $key => $value) {
            // Check for duplicate
            $subject = SubjectStudent::where('student_id',$id)->where('subject_id',$value)->where('academic_year_id',getCurrentAcademicYear()->id)->first();
            if($subject==null){
                SubjectStudent::create([
                    'student_id'=> $id,
                    'subject_id'=> $value,
                    'academic_year_id' => getCurrentAcademicYear()->id
                ]);
            }
        }
        return redirect()->back()->with('alert','The subject has been added.');
        
    }

    public function deleteLearn($id, $learn_id)
    {
        $subject = SubjectStudent::find($learn_id);
        $subject->delete();
        return redirect()->back()->with('alert','The subject has been removed.');
    }
    function getParents($id)
    {
        $student = Student::findOrFail($id);
        return (string) view('partials.students.family',['student_list' => Student::active()->get(), 'student' => $student]);
    }
}
