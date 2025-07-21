<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\AcademicYear;
use App\Language;
use App\ClassRoom;
use App\House;
use App\Cluster;
use App\StudentParent;
use App\EmergencyContact;
use App\Siblin;
use App\DataImport;
use App\Term;
use App\Subject;
use App\Student;
use App\Teacher;
use App\Grade;
use App\Division;
use App\Address;
use App\Map;
use App\ClassRoomStudent;
use App\ClassRoomTeacher;
use Illuminate\Support\MessageBag;
use App\Transport;
use App\SubjectStudent;

class DataImportController extends Controller
{
    protected $message_bag;

    public function __construct() {
        $this->message_bag = new MessageBag();
        $this->message_bag->add('upload_file','Uploaded file is invalid, please check the file and upload it again.');
    }
    
    public function index(){
        return view('imports.index');
    }
    public function uploadAcademicYear(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            if($fileupload->invalidFile($data,['name','start','end'],3)){
                return redirect()->back()->withErrors($this->message_bag);
            }    
            foreach ($data as $item) {
                AcademicYear::create([
                    'name' => $item['name'],
                    'start' => $item['start'],
                    'end' => $item['end']
                ]);
            }      
        }
        return redirect()->back()->with('alert','File upload successfuly.');

    }
    public function uploadTerm(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            if($fileupload->invalidFile($data,['name','start','end','academic_year_id','number_of_days','sequence','code'],7)){
                return redirect()->back()->withErrors($this->message_bag);
            }  
            foreach ($data as $item) {
                // Check for duplicate code
                $term = Term::where('code', $item['code'])->first();
                if(!$term==null) continue;
                Term::create([
                    'name' => $item['name'],
                    'start' => $item['start'],
                    'end' => $item['end'],
                    'academic_year_id' => $item['academic_year_id'],
                    'number_of_days' => $item['number_of_days'],
                    'sequence' => $item['sequence'],
                    'code' => $item['code'],
                ]);
            }
        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }
    public function uploadSubject(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            if($fileupload->invalidFile($data,['name','description','language_id','grade_id','code'],5)){
                return redirect()->back()->withErrors($this->message_bag);
            }  
            foreach ($data as $item) {
                // Check for duplicate code
                $subject = Subject::where('code', $item['code'])->first();
                if(!$subject==null) continue;
                Subject::create([
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'language_id' => $item['language_id'],
                    'grade_id' => $item['grade_id'],
                    'code' => $item['code'],
                ]);
            }
        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }
    public function uploadGrade(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            if($fileupload->invalidFile($data,['class_room','grade','division'],3)){
                return redirect()->back()->withErrors($this->message_bag);
            }  
            foreach ($data as $item) {
                // Check for Grade
                $grade = Grade::where('name',$item['grade'])->first();
                if($grade==null){
                    $grade = Grade::create([
                        'name' => $item['grade']
                    ]);
                }
                // Check for Division
                $division = Division::where('name',$item['division'])->first();
                if($division==null){
                    $division = Division::create([
                        'name' => $item['division']
                    ]);
                }
                ClassRoom::create([
                    'name' => $item['class_room'],
                    'grade_id' => $grade->id,
                    'division_id' => $division->id,
                ]);
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }
    public function uploadStudent(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            if($fileupload->invalidFile($data,[
                'admission_number','admitted_date','admitted_academic_year_id','admitted_class_room_id',
                'house_id','cluster_id','surname','first_name','other_name','date_of_birth','id_number','gender',
                'photo','present_class_room_id','transport_id','distance','town','scholarship_mark'
            ],20)){
                return redirect()->back()->withErrors($this->message_bag);
            }  
            foreach ($data as $item) {
                // Check for duplicate admission number
                $student = Student::where('admission_number', $item['admission_number'])->first();
                if(!$student==null) continue;
                
                // Formulate address and connect with the student
                $address = Address::create([
                    'address' => $item['address']
                ]);
                // Get GEo location and update address
                $map = new Map();
                $map_data = $map->getLatLng($address);
                $address->latitude = $map_data['lat'];
                $address->longitude = $map_data['lng'];
                $address->save();
                // Create empty parent record
                $parent = new StudentParent();
                $parent->save();

                // Create empty emergency contact record
                $emergency = new EmergencyContact();
                $emergency->save();

                $student = Student::create([
                    'admission_number' => $item['admission_number'],
                    'admitted_date' => $item['admitted_date'],
                    'admitted_academic_year_id' => $item['admitted_academic_year_id'],
                    'admitted_class_room_id' => $item['admitted_class_room_id'],
                    'house_id' => $item['house_id'],
                    'cluster_id' => $item['cluster_id'],
                    'surname' => $item['surname'],
                    'first_name' => $item['first_name'],
                    'other_name' => $item['other_name'],
                    'date_of_birth' => $item['date_of_birth'],
                    'id_number' => $item['id_number'],
                    'gender' => $item['gender'],
                    'photo' => $item['photo'],
                    'present_class_room_id' => $item['present_class_room_id'],
                    'address_id' => $address->id,
                    'student_parent_id' => $parent->id,
                    'emergency_contact_id' => $emergency->id,
                    'transport_id' => $item['transport_id'],
                    'distance' => $item['distance'],
                    'town' => $item['town'],
                    'scholarship_mark' => $item['scholarship_mark']==''?null:$item['scholarship_mark'],
                ]);

                // Add record to class_room_students
                // If admitted_class_room defer the present class room
                // Need to create two different record
                if($item['admitted_class_room_id'] == $item['present_class_room_id']){
                    ClassRoomStudent::create([
                        'student_id' => $student->id,
                        'class_room_id' => $item['admitted_class_room_id'],
                        'academic_year_id' => $item['admitted_academic_year_id'],
                        'date' => $item['admitted_date'],
                        'comment' => 'Admission'
                    ]);
                }
                else{
                    // Admitted Class Room
                    ClassRoomStudent::create([
                        'student_id' => $student->id,
                        'class_room_id' => $item['admitted_class_room_id'],
                        'academic_year_id' => $item['admitted_academic_year_id'],
                        'date' => $item['admitted_date'],
                        'comment' => 'Admission'
                    ]);
                    // Present Class Room
                    ClassRoomStudent::create([
                        'student_id' => $student->id,
                        'class_room_id' => $item['present_class_room_id'],
                        'academic_year_id' => $item['present_academic_year_id'],
                        'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                        'comment' => 'Present Class Upload'
                    ]);
                }
                // Allocate present class room subjects
                $class_room = ClassRoom::find($item['present_class_room_id']);
                $subjects = Subject::where('grade_id',$class_room->grade_id)->get();
                foreach($subjects as $subject){
                    SubjectStudent::create([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'academic_year_id' => $item['present_academic_year_id']
                    ]);
                }
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }
    public function uploadTeacher(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            if($fileupload->invalidFile($data,[
                'admission_number','surname','first_name','other_name','date_of_birth','id_number','gender','photo','present_class_room_id','telephone','email'
            ],13)){
                return redirect()->back()->withErrors($this->message_bag);
            }
            foreach ($data as $item) {
                // Formulate address and connect with the student
                $address = Address::create([
                    'address' => $item['address']
                ]);
                // Get GEo location and update address
                $map = new Map();
                $map_data = $map->getLatLng($address);
                $address->latitude = $map_data['lat'];
                $address->longitude = $map_data['lng'];
                $address->save();

                $teacher = Teacher::create([
                    'surname' => $item['surname'],
                    'first_name' => $item['first_name'],
                    'other_name' => $item['other_name'],
                    'date_of_birth' => $item['date_of_birth'],
                    'id_number' => $item['id_number'],
                    'gender' => $item['gender'],
                    'photo' => $item['photo'],
                    //'present_class_room_id' => $item['present_class_room_id'],
                    'address_id' => $address->id,
                    'telephone' => $item['telephone'],
                    'email' => $item['email'],
                    'admission_number' => $item['admission_number'],
                ]);

                // Add record to class_room_students
                /*ClassRoomTeacher::create([
                    'teacher_id' => $teacher->id,
                    'class_room_id' => $item['present_class_room_id'],
                    'academic_year_id' => $item['present_academic_year_id'],
                    'date' => \Carbon\Carbon::now()->format('Y-m-d') ,
                    'comment' => 'Data Upload'
                ]);*/
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }
    public function uploadParents(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            foreach ($data as $item) {
                $parents = StudentParent::create([
                    'father_name' => $item['father_name'],
                    'father_telephone' => $item['father_mobile'],
                    'father_email' => $item['father_email'],
                    'father_occupation' => $item['father_occupation'],
                    'father_name_of_employment' => $item['father_name_of_employment'],
                    'father_address_of_employment' => $item['father_address_of_employment'],
                    'father_office_telephone' => $item['father_office_telephone'],
                    'mother_name' => $item['mother_name'],
                    'mother_telephone' => $item['mother_mobile'],
                    'mother_email' => $item['mother_email'],
                    'mother_occupation' => $item['mother_occupation'],
                    'mother_name_of_employment' => $item['mother_name_of_employment'],
                    'mother_address_of_employment' => $item['mother_address_of_employment'],
                    'mother_office_telephone' => $item['mother_office_telephone'],
                    'guardian_name' => $item['guardian_name'],
                    'guardian_telephone' => $item['guardian_mobile'],
                    'guardian_email' => $item['guardian_email'],
                    'guardian_occupation' => $item['guardian_occupation'],
                    'guardian_name_of_employment' => $item['guardian_name_of_employment'],
                    'guardian_address_of_employment' => $item['guardian_address_of_employment'],
                    'guardian_office_telephone' => $item['guardian_office_telephone'],
                ]);
                // Map with student
                $student = Student::where('admission_number',$item['admission_number'])->first();
                if(!$student==null){
                    $student->student_parent_id = $parents->id;
                    $student->update();
                }
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }

    public function uploadSiblin(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            foreach ($data as $item) {
                Siblin::create([
                    'left_student_id' => $item['left_student_id'],
                    'right_student_id' => $item['right_student_id'],
                    'relation' => $item['relation']
                ]);
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }

    public function uploadEmergancyContact(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);

        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            foreach ($data as $item) {
                // Formulate address and connect with the student
                $address = Address::create([
                    'address' => $item['address']
                ]);
                // Get GEo location and update address
                $map = new Map();
                $map_data = $map->getLatLng($address);
                $address->latitude = $map_data['lat'];
                $address->longitude = $map_data['lng'];
                $address->save();

                 $e_contact = EmergencyContact::create([
                    'name' => $item['name'],
                    'address_id' => $address->id,
                    'telephone' => $item['telephone'],
                    'relationship' => $item['relationship']
                ]);
                // Map with student
                $student = Student::find($item['id']);
                if(!$student==null){
                    $student->emergency_contact_id = $e_contact->id;
                    $student->update();
                }
            }

        }
        return redirect()->back()->with('alert','File upload successfuly.');
    }

    public function downloadAcademicYear()
    {

        $condition = "Conditions:\nname|start|end are mandatory\nDate Format=2018-01-01\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_academic_year.csv'),$condition);
        File::append(storage_path('data_template_academic_year.csv'),"name,start,end");
        return response()->download(storage_path('data_template_academic_year.csv'));
    }
    public function downloadTerm()
    {
        $condition = "Conditions:\ncode|name|academic_year_id|start|end|number_of_days|sequence are mandatory\nDate Format=2018-01-01\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_term.csv'),$condition);
        File::append(storage_path('data_template_term.csv'),"Academic Year\n");
        $academic_years_content = '';

        $academic_years = AcademicYear::all();
        foreach ($academic_years as $year) {
            $academic_years_content .= "Id=" . $year->id . ',' . 'Name=' . $year->name . "\n";
        }
        File::append(storage_path('data_template_term.csv'),$academic_years_content);
        File::append(storage_path('data_template_term.csv'),"code,name,academic_year_id,start,end,number_of_days,sequence");
        return response()->download(storage_path('data_template_term.csv'));
    }
    public function downloadSubject()
    {
        $condition = "Conditions:\ncode|name|description|language_id|grade_id are mandatory\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_subject.csv'),$condition);
        File::append(storage_path('data_template_subject.csv'),"Grade\n");

        $grade_content = '';

        $grades = Grade::all();
        foreach ($grades as $grade) {
            $grade_content .= "Id=" . $grade->id . ',' . 'Name=' . $grade->name . "\n";
        }
        File::append(storage_path('data_template_subject.csv'),$grade_content);
        File::append(storage_path('data_template_subject.csv'),"Language\n");

        $language_content = '';

        $languages = Language::all();
        foreach ($languages as $language) {
            $language_content .= "Id=" . $language->id . ',' . 'Name=' . $language->name . "\n";
        }

        File::append(storage_path('data_template_subject.csv'),$language_content);
        File::append(storage_path('data_template_subject.csv'),"code,name,description,language_id,grade_id");
        return response()->download(storage_path('data_template_subject.csv'));
    }
    public function downloadGrade()
    {
        $condition = "Conditions:\nclass_room|grade|division are mandatory\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_grade.csv'),$condition);
        File::append(storage_path('data_template_grade.csv'),"class_room,grade,division");
        return response()->download(storage_path('data_template_grade.csv'));

    }
    public function downloadStudent()
    {
        $condition = "Conditions:\nadmission_number|surname|first_name|date_of_birth\n|gender|address|admitted_date\n|admitted_class_room_id|house_id|cluster_id|\npresent_class_room_id|present_academic_year_id,transport_id,distance,town are mandatory\nDate Format=2018-01-01\nGender=Male/Female\nOverwrite is not possible only append\nRemove all lines above the headers before upload\nMaximum number of records for a sheet is 1000\n";
        File::put(storage_path('data_template_student.csv'),$condition);
        // Houses
        File::append(storage_path('data_template_student.csv'),"House\n");

        $house_content = '';

        $houses = House::all();
        foreach ($houses as $house) {
            $house_content .= "Id=" . $house->id . ',' . 'Name=' . $house->name . "\n";
        }
       
        File::append(storage_path('data_template_student.csv'),$house_content);

        // Clusters
        File::append(storage_path('data_template_student.csv'),"Cluster\n");

        $cluster_content = '';

        $clusters = Cluster::all();
        foreach ($clusters as $cluster) {
            $cluster_content .= "Id=" . $cluster->id . ',' . 'Name=' . $cluster->name . "\n";
        }
       
        File::append(storage_path('data_template_student.csv'),$cluster_content);

        // Class Room
        File::append(storage_path('data_template_student.csv'),"Class Room\n");

        $class_room_content = '';

        $class_rooms = ClassRoom::all();
        foreach ($class_rooms as $class) {
            $class_room_content .= "Id=" . $class->id . ',' . 'Name=' . $class->name . "\n";
        }
       
        File::append(storage_path('data_template_student.csv'),$class_room_content);

        // Academic Year
        File::append(storage_path('data_template_student.csv'),"Academic Year\n");

        $academic_years_content = '';

        $academic_years = AcademicYear::all();
        foreach ($academic_years as $year) {
            $academic_years_content .= "Id=" . $year->id . ',' . 'Name=' . $year->name . "\n";
        }
        File::append(storage_path('data_template_student.csv'),$academic_years_content);

        // Transport
        File::append(storage_path('data_template_student.csv'),"Type of transport\n");

        $transports_content = '';

        $transports = Transport::all();
        foreach ($transports as $year) {
            $transports_content .= "Id=" . $year->id . ',' . 'Name=' . $year->name . "\n";
        }
        File::append(storage_path('data_template_student.csv'),$transports_content);


        File::append(storage_path('data_template_student.csv'),"admission_number,surname,first_name,other_name,date_of_birth,id_number,gender,address,photo,admitted_date,admitted_academic_year_id,admitted_class_room_id,house_id,cluster_id,present_class_room_id,present_academic_year_id,transport_id,distance,town,scholarship_mark");
        return response()->download(storage_path('data_template_student.csv'));
    }
    public function downloadTeacher()
    {
        $condition = "Conditions:\nadmission_number|surname|first_name|date_of_birth|id_number|gender\n|address|telephone|email|present_class_room_id|present_academic_year_id are mandatory\nDate Format=2018-01-01\nGender=Male/Female\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_teacher.csv'),$condition);
        File::append(storage_path('data_template_teacher.csv'),"Class Room\n");

        $class_room_content = '';

        $class_rooms = ClassRoom::all();
        foreach ($class_rooms as $class) {
            $class_room_content .= "Id=" . $class->id . ',' . 'Name=' . $class->name . "\n";
        }
        File::append(storage_path('data_template_teacher.csv'),$class_room_content);

        // Academic Year
        File::append(storage_path('data_template_teacher.csv'),"Academic Year\n");

        $academic_years_content = '';

        $academic_years = AcademicYear::all();
        foreach ($academic_years as $year) {
            $academic_years_content .= "Id=" . $year->id . ',' . 'Name=' . $year->name . "\n";
        }
        File::append(storage_path('data_template_teacher.csv'),$academic_years_content);

        File::append(storage_path('data_template_teacher.csv'),"admission_number,surname,first_name,other_name,date_of_birth,id_number,gender,address,telephone,email,photo,present_class_room_id,present_academic_year_id");
        return response()->download(storage_path('data_template_teacher.csv'));
    }
    public function downloadParents()
    {
        $condition = "Conditions:\nAll fields are optional\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_parents.csv'),$condition);
        File::append(storage_path('data_template_parents.csv'),"admission_number,name,father_name,father_mobile,father_email,father_occupation,father_name_of_employment,father_address_of_employment,father_office_telephone,mother_name,mother_mobile,mother_email,mother_occupation,mother_name_of_employment,mother_address_of_employment,mother_office_telephone,guardian_name,guardian_mobile,guardian_email,guardian_occupation,guardian_name_of_employment,guardian_address_of_employment,guardian_office_telephone\n");
        // Fill the sheet with students
        // $students = Student::All();
        // foreach ($students as $student) {
        //     $str = "$student->id,$student->admission_number,$student->fullName,\n";
        //     $str = "";
        //     File::append(storage_path('data_template_parents.csv'),$str);
        // }
        return response()->download(storage_path('data_template_parents.csv'));
    }
    public function downloadSiblin()
    {
        $condition = "Conditions:\nAll fields are mandatory\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_siblin.csv'),$condition);
        File::append(storage_path('data_template_siblin.csv'),"left_student_id,right_student_id,relation");
        return response()->download(storage_path('data_template_siblin.csv'));
    }
    public function downloadEmergencyContact()
    {
        $condition = "Conditions:\nAll fields are optional\nOverwrite is not possible only append\nRemove all lines above the headers before upload\n";
        File::put(storage_path('data_template_emergencyContact.csv'),$condition);
        File::append(storage_path('data_template_emergencyContact.csv'),"id,admission_number,student_name,name,address,telephone,relationship\n");
        // Fill the sheet with students
        $students = Student::All();
        foreach ($students as $student) {
            $str = "$student->id,$student->admission_number,$student->fullName,\n";
            File::append(storage_path('data_template_emergencyContact.csv'),$str);
        }
        return response()->download(storage_path('data_template_emergencyContact.csv'));
    }
    public function mark(Request $request)
    {
        $this->validate($request,[
            'upload_file' => 'required'
        ]);
        $output = '';
        $fileupload = new DataImport($request->upload_file);
        $fileupload->upload();
        $data = $fileupload->parseCSV();
        if(count($data)>0){
            // Validate invalid file upload and parsing.
            $field = ["Admission","Name","Attendance","Exam","Class"];
            foreach ($field as $value) {
                if(!array_key_exists($value, $data[0])){
                    return redirect()->back()->withErrors($this->message_bag);
                }
            }  
            foreach ($data as $item) {
                $student = Student::where('admission_number',$item['Admission'])->first();
                if($student==null){
                    continue;
                }
                foreach($item as $key => $i){
                    if($key>0){
                        // Add subject marks
                        $mark = $i;
                        $is_absent = 0;
                        // Remove null mark subject
                        if($mark==null || $mark==''){
                            continue;
                        }
                        elseif ($mark=="AB" || $mark=="ab") {
                            $mark = 0;
                            $is_absent = 1;
                        }
                        // Get mark grade
                        if(!$mark==null){
                            $mark_grade = \App\MarkGrade::where('low','<=',$mark)->where('high','>=',$mark)->first();
                        }
                        // if($mark_grade==null){
                        //     $mark_grade = new \App\MarkGrade();
                        // }
                        \App\ExamMark::create([
                            'exam_id' => $item['Exam'],
                            'student_id' => $student->id,
                            'subject_id' => $key,
                            'mark' => $mark,
                            'is_absent' => $is_absent,
                            'mark_grade' => $mark_grade->grade,
                            'class_room_id' => $item['Class']
                        ]);
                    }
                }
                // If exam has rank enabled calculate rank
                $exam = \App\Exam::find($item['Exam']);
                $class_room = \App\ClassRoom::find($item['Class']);
                if($exam->has_rank){
                    event(new \App\Events\ExamMarkUpdate($exam,$class_room));
                }
                // Mark the attendance
                if($item['Attendance']==null || $item['Attendance']==''){
                    // nothing ignore
                }
                else{
                    // Get the term
                    $term = \App\Term::find($exam->term_id);
                    if($term==null){
                        // nothing ignore
                    }
                    else{
                        \App\StudentAttendance::create([
                            'student_id' => $student->id,
                            'frequency' => 90,
                            'begin_date' => $term->start,
                            'end_date' => $term->end,
                            'attendance' => $item['Attendance'],
                            'remark' => 'Exam mark upload'
                        ]);
                    }
                }
                

            }      
        }
        return redirect()->back()->with('alert',"Data upload has been done.");
    }
}
