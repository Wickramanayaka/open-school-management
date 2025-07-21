<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use ProactiveAnts\Coverage\Period;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        
        $this->validateLogin($request);
        $user = User::where('pin_code',$request->pin_code)->first();
        if($user==null){
            return $this->sendFailedLoginResponse($request);
        }
        /**
         * This code block prevent user login if the user has an incompleted period.
         */
        else{
            $teacher_id = $user->teacher_id;
            $period = Period::where('teacher_id',$teacher_id)->whereNull('time_out')->first();
            if(!$period==null){
                return Response::json(['message'=>'Incomplete period found.'], 401);
            }
        }

        $user->generateToken();
        return response()->json([
                 'data' => $user->toArray(),
             ]);

        // if($this->attemptLogin($request)){
        //     $user = $this->guard()->user();
        //     $user->generateToken();

        //     return response()->json([
        //         'data' => $user->toArray(),
        //     ]);
        // }
        // return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user){
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'],200);
    }
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'pin_code' => 'required'
        ]);
    }
}
