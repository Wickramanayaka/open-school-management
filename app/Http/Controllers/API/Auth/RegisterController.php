<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\UserCreatedSuccessfully;
use Illuminate\Http\Request;
use App\UserRole;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('web');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'teacher_id' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'teacher_id' => $data['teacher_id'],
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'teacher_id' => 'required',
            'role_id' => 'required'
        ]);

        try{
            $validatedData['password'] = bcrypt(array_get($validatedData, 'password'));
            $validatedData['activation_code'] = str_random(30).time();
            $user = app(User::class)->create($validatedData);

            // Assign Roles
            if(count($request['role_id'])>0){
                foreach ($request['role_id'] as $key => $value) {
                    UserRole::create([
                        'user_id' => $user->id,
                        'role_id' => $value
                    ]);
                }
            }

        }
        catch(\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('alert','Unable to create new user.');
        }
        $user->notify(new UserCreatedSuccessfully($user));
        return redirect()->back()->with('alert','Succssefully created a new account. Please check the mail and activate');
    }

    public function activateUser(String $activation_code)
    {
        try{
            $user = app(User::class)->where('activation_code', $activation_code)->first();
            if(!$user){
                return "The code does not exist for any user in the system.";
            }
            $user->status = 1;
            $user->activation_code = null;
            $user->save();
            auth()->login($user);
        }
        catch(\Exception $exception){
            logger()->error($exception);
            return "Error occured, please try again later.";
        }
        return redirect()->to('/home');
    }

    protected function registered(Request $request, $user){
        $user->generateToken();

        return response()->json(['data' => $user->toArray()],201);
    }

}
