<?php

namespace ProactiveAnts\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ProactiveAnts\Parents\ParentsAppUser;
use App\StudentParent;
use App\School;
use GuzzleHttp\Client;
use ProactiveAnts\Parents\ParentsAppVerificationCode;
use App\Student;

class ParentsAppAPIController extends Controller
{
    public function check()
    {
        return ['message' => 'End point is working...'];
    }

    public function verifyPhoneNumber(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'country_code' => 'required',
            'phone_number' => 'required',
            'device_id' => 'required',
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $telephone = "+" . $request->country_code . $request->phone_number;
        $parents = StudentParent::where('father_telephone', $telephone)
        ->orWhere('mother_telephone', $telephone)
        ->orWhere('guardian_telephone', $telephone)
        ->first();
        if($parents==null){
            $school = School::find(1);
            return response(['message' => 'Your number is not presented in the school database. Please contact school administrator by dialing ' . $school->telephone],401);
        }
        else{
            // Delete any exsisting unverified otp after 5 minutes from the schedule task
            $data = $request->all();
            $data['telephone'] = $telephone;
            $data['otp'] = mt_rand(100000,999999);
            $data['expired_at'] = \Carbon\Carbon::now()->addMinutes(15);
            // Delete exsisting opt with the same phone
            ParentsAppVerificationCode::where('telephone',$data['telephone'])->delete();
            $sms_code = ParentsAppVerificationCode::create($data);
        }
        // Send SMS
        $client = new Client();
        // Removing leading + symbol
        $mobile = substr($sms_code->telephone,1,strlen($sms_code->telephone)-1);
        $message = "<%23> Your Bluesmart App verification code is :" . $sms_code->otp . " %2B" . config('parents.sms_hash');
        $response = $client->request('GET', 'https://cpsolutions.dialog.lk/index.php/cbs/sms/send?destination='. $mobile . '&q='. config('parents.sms_api') .'&message='. $message);
        // Return success message back to API caller
        return ['message' => 'Verification code has been sent successfully.'];
    }

    public function verifySMSCode(Request $request)
    {
        // Create a parents app user and send sms verification code
        // Check whether the number is in school databasse
        $validated_data = Validator::make($request->all(), [
            'country_code' => 'required',
            'phone_number' => 'required',
            'device_id' => 'required',
            'sms_code' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $telephone = "+" . $request->country_code . $request->phone_number;
        // Verify sms code
        $sms_code = ParentsAppVerificationCode::where('otp',$request->sms_code)->where('telephone',$telephone)->where('expired_at','>',\Carbon\Carbon::now())->first();
        if($sms_code==null){
            return response(['message' => 'Invalid SMS verification code or code has been expired.'],400);
        }
        $parents = StudentParent::where('father_telephone', $sms_code->telephone)
        ->orWhere('mother_telephone', $sms_code->telephone)
        ->orWhere('guardian_telephone', $sms_code->telephone)
        ->first();
        if($parents==null){
            $school = School::find(1);
            return response(['message' => 'Your number is not presented in the school database. Please contact school administrator by dialing ' . $school->telephone],401);
        }
        else{
            $data = $request->all();
            $data['telephone'] = $sms_code->telephone;
            $data['token'] = str_random(64);
            // Check number belongs to whom
            if($parents->father_telephone==trim($telephone)){
                $data['relation'] = "FATHER";
                $data['full_name'] = $parents->father_name;
            }
            elseif ($parents->mother_telephone==trim($telephone)) {
                $data['relation'] = "MOTHER";
                $data['full_name'] = $parents->mother_name;
            }
            else{
                $data['relation'] = "GUARDIAN";
                $data['full_name'] = $parents->guardian_name;
            }
            if($data['full_name']==""){
                $data['full_name'] = "Undifined";
            }
            // Check for existing phone number
            $user = ParentsAppUser::where('telephone',$data['telephone'])->first();
            if($user==null){
                $user = ParentsAppUser::create($data);
            }
            else{
                $user->token = str_random(64);
                $user->save();
            }
            // Delete sms code
            $sms_code->delete();
        }
        return ['user' =>['token' => $user->token]];
    }

    public function verifyPayment(Request $request)
    {
        $user = ParentsAppUser::where('token', $request->token)->first();
        if($user==null){
            return response(['message' => 'The security token has been revoked, please uninstall and reinstall the mobile app again or contact Bluesmart.'],401);
        }
        $payments = ParentsAppPayment::where('parents_app_user_id',$user->id)->where('status',1)->where('canceled',0)->get();
        if($payments->count()==0){
            return response(['message' => 'Payment was not found'],411);
        }
        foreach ($payments as $payment) {
            if($payment->expiry_date > \Carbon\Carbon::now()){
                return ['message' => 'Payment is upto date'];
            }
        }
        return response(['message' => 'Payment has been expired, please renew it.'],412);
    }

    public function verifyToken(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'token' => 'required',
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        $user = ParentsAppUser::where('token', $request->token)->first();
        if($user==null){
            return response(['message' => 'The security token has been revoked, please uninstall and reinstall the mobile app again or contact Bluesmart.'],401);
        }
        if($user->suspended==1){
            $school = School::find(1);
            return response(['message' => 'You account has been suspended by the school. Please contact school administrator by dialing ' . $school->telephone],401);
        }
        $user->token = str_random(64);
        $user->save();

        $licence_expiry = '';
        foreach ($user->payments as $payment) {
            if($payment->expiry_date > \Carbon\Carbon::now()){
                $licence_expiry = $payment->expiry_date;
            }
        }
        return ['user' =>['token' => $user->token, 'name' => $user->full_name, 'relation' => $user->relation, 'licence_expiry' => $licence_expiry, 'telephone' => $user->telephone]];
    }

    public function renew(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'token' => 'required',
            'api_key' => 'required'
        ]);
        if($validated_data->fails()){
            return response(['message' => 'Provided inputs are invalid.'],400);
        }
        // Check wheather the user is having existing payments
        $user = ParentsAppUser::where('token', $request->token)->firstOrFail();
        $last_payment = ParentsAppPayment::where('parents_app_user_id',$user->id)->confirmed()->where('canceled',0)->orderBy('expiry_date','desc')->first();
        $price = $this->getAppPrice($user);
        if($last_payment==null){
            // No payment exists and app price
            $payment = ParentsAppPayment::create([
                'payment_date' => \Carbon\Carbon::now()->format("Y-m-d"),
                'expiry_date' => \Carbon\Carbon::now()->addYear(1)->format('Y-m-d'),
                'amount' => $price,
                'parents_app_user_id' => $user->id,
                'canceled' => 0,
                'status' => 0,
                'method' => 'ONLINE'
            ]);
            
        }
        else{
            $payment = ParentsAppPayment::create([
                'payment_date' => \Carbon\Carbon::now()->format("Y-m-d"),
                'expiry_date' => date('Y-m-d',strtotime('+1 year' , strtotime($last_payment->expiry_date))),
                'amount' => $price,
                'parents_app_user_id' => $user->id,
                'canceled' => 0,
                'status' => 0,
                'method' => 'ONLINE'
            ]);
        }
        $data = [
            'id' => $payment->id,
            'amount' => $payment->amount,
            'date' => $payment->created_at->format('Y-m-d H:i:s'),
        ];
        return ['payRequest' => $data];
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
                            return $price;
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
                            return $price;
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
                            return $price;
                        }
                    }

                }
                break;    
            default:
                # code...
                break;
        }
        return $price;
    }
}