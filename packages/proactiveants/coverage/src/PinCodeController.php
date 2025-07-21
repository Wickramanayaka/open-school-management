<?php

namespace ProactiveAnts\Coverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PinCodeController extends Controller
{
    public function index()
    {
        return view('coverage::pincodes.index',['users' => User::all()]);
    }

    public function edit($id)
    {
        return view('coverage::pincodes.edit',['user' => User::where('id',$id)->where('teacher_id','>',0)->firstOrFail()]);
    }

    public function update(Request $request)
    {
        $validated_data = $request->validate([
            'id' => 'required',
            'pin_code' => 'required|numeric|max:9999|min:1000|unique:users,pin_code,' .$request->id
        ]);
        $user = User::where('id',$request->id)->where('teacher_id','>',0)->firstOrFail();
        $user->pin_code = $request->pin_code;
        $user->save();
        return redirect('/pincode')->with('alert', 'PIN has been changed successfully.');
    }
}
