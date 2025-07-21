<?php

namespace ProactiveAnts\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProactiveAnts\Parents\ParentsAppUser;
use App\StudentParent;
use App\Student;

class ParentsAppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = ParentsAppUser::orderBy('id')
        ->where(function($query) use($request){
            if(!$request->name==""){
                $query->where('full_name','like', '%'.$request->name.'%');
            }
        })
        ->where(function($query) use($request){
            if(!$request->telephone==""){
                $query->where('telephone','like', '%'.$request->telephone.'%');
            }
        })
        ->where(function($query) use($request){
            if($request->has('suspended')){
                $query->where('suspended',1);
            }
        })->paginate(100);
        return view('parents::parents.index', ['users' => $users ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = ParentsAppUser::findOrFail($id);
        // Get students
        $parents_ids = StudentParent::where('father_telephone', $user->telephone)
        ->orWhere('mother_telephone',$user->telephone)
        ->orWhere('guardian_telephone',$user->telephone)
        ->pluck('id')
        ->toArray();
        $students = Student::whereIn('student_parent_id', $parents_ids)->get();
        $payments = ParentsAppPayment::where('parents_app_user_id', $id)->confirmed()->get();
        return view('parents::parents.view', compact('user','students','payments'));
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
        // Toggle suspended
        $user = ParentsAppUser::findOrFail($id);
        $user->suspended = $user->suspended * (- $user->suspended) + 1;
        $user->save();
        return redirect()->back();
    }

    public function toggle($id)
    {
        // Toggle suspended
        $user = ParentsAppUser::findOrFail($id);
        $user->suspended = $user->suspended * (- $user->suspended) + 1;
        $user->save();
        return redirect()->back();
    }

    public function create() {
        return view('parents::parents.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'telephone' => 'required|max:10',
            'otp' => 'required',
        ]);
        if(substr($request->telephone,0,1)==0){
            $valid_telephone = substr($request->telephone,1);
        }
        else{
            $valid_telephone = $request->telephone;
        }
        // Check the nummber in user database
        $user = ParentsAppUser::where('phone_number', $valid_telephone)->first();
        if($user==null){
            // Check number in student parents column
            $telephone = "+94" .  $valid_telephone;
            $parents = StudentParent::where('father_telephone', $telephone)
            ->orWhere('mother_telephone', $telephone)
            ->orWhere('guardian_telephone', $telephone)
            ->first();
            if($parents==null){
                return back()->withErrors(['telephone' => ['The telephone number you entered was not in the school database or your account has been suspended.']]);
            }
            else{
                // Create parents app user
                $data = [];
                $data['telephone'] = $telephone;
                $data['token'] = str_random(64);
                $data['phone_number'] = $valid_telephone;
                $data['country_code'] = '94';
                $data['suspended'] = 0;
                $data['otp'] = $request->otp;
                if($parents->father_telephone==trim($telephone)){
                    $data['relation'] = "FATHER";
                    $data['full_name'] = $parents->father_name==""?"N/A":$parents->father_name;
                }
                elseif ($parents->mother_telephone==trim($telephone)) {
                    $data['relation'] = "MOTHER";
                    $data['full_name'] = $parents->mother_name==""?"N/A":$parents->mother_name;
                }
                else{
                    $data['relation'] = "GUARDIAN";
                    $data['full_name'] = $parents->guardian_name==""?"N/A":$parents->guardian_name;
                }
                $user = ParentsAppUser::create($data);
            }
        }
        return redirect('/parents');
    }
    public function destroy($id)  {
        $user = ParentsAppUser::findOrFail($id);
        $user->delete();
        return redirect('/parents');
    }
}
