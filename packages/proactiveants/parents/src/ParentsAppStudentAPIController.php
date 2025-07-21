<?php

namespace ProactiveAnts\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ProactiveAnts\Parents\ParentsAppUser;
use App\StudentParent;
use App\School;
use App\Student;
use App\StudentExamRank;
use App\Payment;
use App\ExamMark;
use App\Exam;
use App\Subject;
use App\Video;

class ParentsAppStudentAPIController extends Controller
{   
    public function getStudent(Request $request)
    {
        $user = ParentsAppUser::where('token', $request->token)->first();
        $parents_ids = StudentParent::where('father_telephone', $user->telephone)
        ->orWhere('mother_telephone',$user->telephone)
        ->orWhere('guardian_telephone',$user->telephone)
        ->pluck('id')
        ->toArray();
        $students = Student::with(['address','present_class_room','house','cluster','student_parent','transport'])->whereIn('student_parent_id', $parents_ids)->get();
        $data = [];
        foreach ($students as $student) {
            $data[] = [
                'id' => $student->id,
                'full_name' => $student->fullName,
                'admission_number' => $student->admission_number,
                'class_room' => $student->present_class_room->name,
                'address' => $student->address->address,
                'house' => $student->house->name,
                'cluster' => $student->cluster->name,
                'date_of_birth' => $student->date_of_birth,
                'gender' => $student->gender,
                'admitted_date' => $student->admitted_date,
                'admitted_class_room' => $student->admitted_class_room->name,
                'telephone' => $student->telephone,
                'religion' => $student->religion,
                'nationality' => $student->nationality,
                'type_of_transport' => $student->transport->name,
                'distance' => $student->distance,
                'town' => $student->town,
                'updated_at' => $student->updated_at,
                'photo' => $student->photo,
                'grade_id' => $student->present_class_room->grade->id
            ];
        }
        return ['students' => $data];
    }

    public function getExam(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'student_id' => 'required',
            'token' => 'required',
            'api_key' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $student = Student::find($request->student_id)->first();
        if($student==null){
            return response(['message' => 'Student was not found.'],400);
        }
        $exams = StudentExamRank::where('student_id', $request->student_id)->get();
        $data = [];
        foreach ($exams as $exam) {
            if($exam->exam->status=='Completed'){
                $data[] = [
                    'id' => $exam->id,
                    'student_id' => $exam->student->id,
                    'exam' => $exam->exam->name,
                    'exam_id' => $exam->exam_id,
                    'total' => number_format($exam->total,2,'.',''),
                    'average' => number_format($exam->average,2,'.',''),
                    'rank' => $exam->rank,
                    'number_of_subject' => $exam->number_of_subject,
                    'rank_one_average' => number_format($exam->rank_one_average,2,'.',''),
                    'class_room' => $exam->class_room->name,
                    'updated_at' => "",
                    'visibility' => $exam->class_room->id > 35 ? 1:0
                ];
            }
            
        }
        return ['exams' => $data];
    }

    public function getSchoolPayment(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'student_id' => 'required',
            'token' => 'required',
            'api_key' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $student = Student::find($request->student_id)->first();
        if($student==null){
            return response(['message' => 'Student was not found.'],400);
        }
        $payments = Payment::where('student_id', $request->student_id)->orderBy('id')->get();
        $data=[];
        foreach ($payments as $payment) {
            $data[] = [
                'id' => $payment->id,
                'student_id' => $payment->student_id,
                'description' => $payment->description,
                'date' => $payment->date,
                'amount' => $payment->amount,
                'category' => $payment->category->name
            ];
        }
        return ['payments' => $data];
    }

    public function getExamResult(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'student_id' => 'required',
            'exam_id' => 'required',
            'api_key' => 'required',
            'token' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $student = Student::find($request->student_id)->first();
        if($student==null){
            return response(['message' => 'Student was not found.'],400);
        }
        $exam = Exam::find($request->exam_id)->first();
        if($exam==null){
            return response(['message' => 'Exam was not found.'],400);
        }
        $marks = ExamMark::where('student_id', $request->student_id)->where('exam_id',$request->exam_id)->get();
        
        $data = [];
        foreach ($marks as $mark) {
            $data[] = [
                'id' => $mark->id,
                'student_id' => $mark->student_id,
                'exam_id' => $mark->exam_id,
                'subject' => $mark->subject->name . " (" . $mark->subject->language->name . ")",
                'mark' => $mark->mark,
                'absent' => $mark->is_absent,
                'mark_grade' => $mark->mark_grade,
                'class_room' => $mark->class_room->name,
                'visibility' => $mark->class_room->id > 35 ? 1:0
            ];
        }
        return ['examMarks' => $data];
    }

    public function getSubject(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'grade_id' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $subjects = Subject::where('grade_id', $request->grade_id)->get();
        if($subjects==null){
            return response(['message' => 'Subject was not found.'],400);
        }
        $data=[];
        foreach ($subjects as $subject) {
            $data[] = [
                'id' => $subject->id,
                'name' => $subject->name
            ];
        }
        return ['subjects' => $data];
    }

    public function getVideo(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'subject_id' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $videos = Video::where('subject_id', $request->subject_id)->orderBy('number')->get();
        if($videos==null){
            return response(['message' => 'Video was not found.'],400);
        }
        $data=[];
        foreach ($videos as $video) {
            $data[] = [
                'number' => $video->number,
                'name' => $video->name,
                'url' => $video->url
            ];
        }
        return ['videos' => $data];
    }
}