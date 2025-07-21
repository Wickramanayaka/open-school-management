<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProactiveAnts\Parents\ParentsAppPayment;
use ProactiveAnts\Parents\ParentsAppUser;
use ProactiveAnts\SMS\SmsMessage;
use App\Jobs\SendSMS;
use App\StudentParent;
use App\School;
use App\Student;
use App\StudentExamRank;
use App\Payment;
use App\ExamMark;
use App\Exam;
use App\Subject;
use App\Video;

class StudentWebController extends Controller
{
    public function login()
    {
        return view('student_web.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'telephone' => 'required|min:9|max:10',
            'otp' => 'required'
        ]);
        if(substr($request->telephone,0,1)==0){
            $valid_telephone = substr($request->telephone,1);
        }
        else{
            $valid_telephone = $request->telephone;
        }
        $user = ParentsAppUser::where('phone_number', $valid_telephone)->where('otp', $request->otp)->first();
        if($user==null){
            return redirect(route('t'))->withErrors(['telephone'=>['Either phone number or pin is invalid.']]);
        }
        $token = $user->token;
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
                'photo' => $student->photo,
                'grade_id' => $student->present_class_room->grade->id
            ];
        }
        return view('student_web.profile', compact('token','data'));
    }
    public function getSubject($id)
    {
        $subjects = Subject::where('grade_id', $id)->orderBy('name')->get();
        return $subjects;
    }

    public function getVideo($id)
    {
        $videos = Video::where('subject_id', $id)->orderBy('number')->get();
        return $videos;
    }

    private function getAppPrice(ParentsAppUser $user)
    {
        $price = config('parents.app_one');
        $parents = StudentParent::where('father_telephone', $user->telephone)
            ->orWhere('mother_telephone',$user->telephone)
            ->orWhere('guardian_telephone',$user->telephone)
            ->firstOrFail();
        switch ($user->relation) {
            case 'FATHER':
                $app_users = ParentsAppUser::whereIn('telephone',[$parents->mother_telephone,$parents->guardian_telephone])->whereIn('relation',['MOTHER','GUARDIAN'])->get();
                foreach ($app_users as $u) {
                    // Check whether other related user has valid subscription
                    foreach ($u->payments as $p) {
                        if($p->expiry_date > \Carbon\Carbon::now()){
                            $price = config('parents.app_two');
                            break;
                        }
                    }

                }
                break;
            case 'MOTHER':
                $app_users = ParentsAppUser::whereIn('telephone',[$parents->father_telephone,$parents->guardian_telephone])->whereIn('relation',['FATHER','GUARDIAN'])->get();
                foreach ($app_users as $u) {
                    // Check whether other related user has valid subscription
                    foreach ($u->payments as $p) {
                        if($p->expiry_date > \Carbon\Carbon::now()){
                            $price = config('parents.app_two');
                            break;
                        }
                    }

                }
                break;
            case 'GUARDIAN':
                $app_users = ParentsAppUser::whereIn('telephone',[$parents->mother_telephone,$parents->father_telephone])->whereIn('relation',['FATHER','MOTHER'])->get();
                foreach ($app_users as $u) {
                    // Check whether other related user has valid subscription
                    foreach ($u->payments as $p) {
                        if($p->expiry_date > \Carbon\Carbon::now()){
                            $price = config('parents.app_two');
                            break;
                        }
                    }

                }
                break;    
            default:
                return $price;
                break;
        }
        return $price;
    }

    public function success(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_number' => 'required',
            'charge_total' => 'required',
            'trx_ref_number' => 'required',
            'trx_date_time' => 'required',
            'message' => 'required',
            'code' => 'required',
            'status' => 'required',
            'txn_token' => 'required'
        ]);
        // Validate the resp token
        $token =config('app.secretCode').$request->code.$request->charge_total.config('app.currency').$request->trx_date_time.$request->trx_ref_number.$request->invoice_number.config('app.storeName');
        $token = hash('sha256', $token);
        if($token==$request->txn_token){
            // Get id from invoice
            $id = substr($request->invoice_number, strpos($request->invoice_number,"_")+1);
            $payment = ParentsAppPayment::findOrFail($id);
            $payment->status = 1;
            $payment->save();
            return view('student_web.genie.success');
        }
        else{
            abort(401);
        }
    }

    public function error()
    {
        return view('student_web.genie.error');
    }

    public function getInfo($id)
    {
        $student = Student::with(['house','cluster','transport','admitted_academic_year','admitted_class_room','address'])->where('id', $id)->first();
        return $student;
    }

    public function getExam($id)
    {
        $exam_ranks = StudentExamRank::with(['exam'])->where('student_id',$id)->get();
        return $exam_ranks;
    }

    public function getResult($id, $exam)
    {
        $student = Student::with(['house','cluster','transport','admitted_academic_year','admitted_class_room','address'])->where('id', $id)->first();
        return $student;
    }


}
