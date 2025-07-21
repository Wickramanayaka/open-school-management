<?php

namespace ProactiveAnts\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentParent;

class ParentsAppPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parents::parents.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $payment = [];
        $user = ParentsAppUser::findOrFail($id);
        $amount = number_format($this->getAppPrice($user),2). " LKR";
        $last_payment = ParentsAppPayment::where('parents_app_user_id',$user->id)->confirmed()->where('canceled',0)->orderBy('expiry_date','desc')->first();
        if($last_payment==null){
            // No payment exists and app price
            $payment =[
                'id' => $user->id,
                'name' => $user->full_name,
                'telephone' => $user->telephone,
                'date' => \Carbon\Carbon::now()->format("Y-m-d"),
                'expiry' => \Carbon\Carbon::now()->addYear(1)->format('Y-m-d'),
                'amount' => $amount
            ];
        }
        else{
            $payment =[
                'id' => $user->id,
                'name' => $user->full_name,
                'telephone' => $user->telephone,
                'date' => \Carbon\Carbon::now()->format("Y-m-d"),
                'expiry' => date('Y-m-d',strtotime('+1 year' , strtotime($last_payment->expiry_date))),
                'amount' => $amount
            ];
        }
        return ['data' => $payment];
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
            'modal_user_id' => 'required',
        ]);
        $user = ParentsAppUser::findOrFail($request->modal_user_id);
        $amount = number_format($this->getAppPrice($user),2). " LKR";
        $last_payment = ParentsAppPayment::where('parents_app_user_id',$user->id)->confirmed()->where('canceled',0)->orderBy('expiry_date','desc')->first();
        if($last_payment==null){
            // No payment exists and app price
            ParentsAppPayment::create([
                'parents_app_user_id' => $user->id,
                'payment_date' =>\Carbon\Carbon::now()->format("Y-m-d"),
                'expiry_date' => \Carbon\Carbon::now()->addYear(1)->format('Y-m-d'),
                'amount' => $amount,
                'method' => 2,
                'status' => 1
            ]);
        }
        else{
            ParentsAppPayment::create([
                'parents_app_user_id' => $user->id,
                'payment_date' =>\Carbon\Carbon::now()->format("Y-m-d"),
                'expiry_date' => date('Y-m-d',strtotime('+1 year' , strtotime($last_payment->expiry_date))),
                'amount' => $amount,
                'method' => 2,
                'status' => 1
            ]);
        }
        return redirect()->back()->with('alert','The payment has been done successfuly.');
    }

    public function cancel($id)
    {
        $payment = ParentsAppPayment::findOrFail($id);
        $payment->canceled = 1;
        $payment->save();
        return redirect()->back();
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

    public function successGenie(Request $request)
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
        $token =config('parents.secretCode').$request->code.$request->charge_total.config('parents.currency').$request->trx_date_time.$request->trx_ref_number.$request->invoice_number.config('parents.storeName');
        $token = hash('sha256', $token);
        if($token==$request->txn_token){
            // get the booking
            $payment = ParentsAppPayment::where('id', $request->invoice_number)->firstOrFail();
            $payment->status = 1;
            $payment->invoice_number = $request->invoice_number;
            $payment->charge_total = $request->charge_total;
            $payment->gross_amount = 0;
            $payment->trx_ref_number = $request->trx_ref_number;
            $payment->trx_date_time = $request->trx_date_time;
            $payment->message = $request->message;
            $payment->code = $request->code;
            $payment->ipg_status = $request->status;
            $payment->other_info = $request->other_info;
            $payment->resp_token = $request->txn_token;
            $payment->save();
            return redirect('/parents/genie/complete');
        }
        else{
            abort(401);
        }
    }

    public function errorGenie(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_number' => 'required',
        ]);
        $payment = ParentsAppPayment::where('id', $request->invoice_number)->delete();
        return redirect('/parents/genie/incomplete');
    }

    public function completeGenie()
    {
        return view('parents::genie.success');
    }

    public function incompleteGenie()
    {
        return view('parents::genie.error');
    }

}
