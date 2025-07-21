<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teacher;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\UserRole;
use Hash;
use App\Jobs\SendSMS;
use ProactiveAnts\SMS\SmsMessage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index',['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::active()->get();
        $roles = Role::all();
        return view('users.create',compact('teachers','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // User creation is handled by RegisterController
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.view',['users' => User::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $teachers = Teacher::active()->get();
        return view('users.edit',['user' => User::find($id),'roles' => $roles,'teachers' => $teachers]);
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'teacher_id' => 'required'
        ]);

        $user = User::find($id);
        // Recreate user roles
        UserRole::where('user_id',$user->id)->delete();
        // Assign Roles
        if(count($request['role_id'])>0){
            foreach ($request['role_id'] as $key => $value) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => $value
                ]);
            }
        }


        $user->update($request->all());
        return redirect()->back()->with('alert','The user has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * User can delete itself
         * Admin user account can not be deleted
         */

        if(Auth::user()->id==$id){
            return redirect()->back()->withErrors(['User can not be deleted.']);
        }
        if($id==1){
            return redirect()->back()->withErrors(['User can not be deleted.']);
        }

        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('alert','User has been deleted.');
    }

    public function permission()
    {
        
    }

    public function role()
    {
        return view('users.role');
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request,[
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Check the current passowrd
        $user = User::find($id);
        //if(Hash::check($request->current_password,$user->password)){
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with('alert','User password has been updated.');
        //}
        //return redirect()->back()->with('alert','Invalid password');
    }

    function getOTP(Request $request) {
        $this->validate($request,[
            'telephone' => 'required|exists:teachers,telephone'
        ]);
        $teacher = Teacher::where('telephone', $request->telephone)->firstOrFail();
        $user = User::where('teacher_id', $teacher->id)->firstOrFail();
        $otp = rand(100000,999999);
        $user->activation_code = $otp;
        $user->save();
        // Send OTP
        $sms = SMSMessage::create([
            'message' => "Your password reset OTP is " . $otp,
            'type' => 1,
            'phone_number' => $request->telephone ,
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'created_by' => 1,
            'number_of_sms' => 1,
            'length' => 33,
            'delivery' => 0,
            'teacher_id' => $teacher->id,
        ]);
        // Send sms function here
        SendSMS::dispatch($sms);
        return redirect(url('password/verifyOTP'));
    }

    function verifyOTP() {
        return view('auth.passwords.reset');
    }

    function postVerifyOTP(Request $request){
        $this->validate($request,[
            'telephone' => 'required|exists:teachers,telephone',
            'otp' => 'required|exists:users,activation_code',
        ]);
        $teacher = Teacher::where('telephone', $request->telephone)->firstOrFail();
        $user = User::where('teacher_id', $teacher->id)->where('activation_code', $request->otp)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/');
    }
}
