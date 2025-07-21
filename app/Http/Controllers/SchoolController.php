<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('school.view',['school' => School::findOrFail(1) ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('school.edit',['school' => School::findOrFail($id)]);
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
        $validated_data = $request->validate([
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);
        $data = $request->all();
        // Logo upload
        if($request->file('logo_file')){
            $validated_data = $request->validate([
                'logo_file' => 'required|mimes:jpeg,jpg,png,gif,tiff|max:1024',
            ]);
            $file_name = str_random(16) . "_" . $request->logo_file->getClientOriginalName();
            $request->logo_file->move(public_path('images/profiles/school'),$file_name);
            $data['logo'] = $file_name;
        }
        // Anthem upload
        if($request->file('anthem_file')){
            $validated_data = $request->validate([
                'anthem_file' => 'required|max:5120',
            ]);
            $file_name = str_random(16) . "_" . $request->anthem_file->getClientOriginalName();
            $request->anthem_file->move(public_path('images/profiles/school'),$file_name);
            $data['anthem_audio'] = $file_name;
        }
        // Flag upload
        if($request->file('flag_file')){
            $validated_data = $request->validate([
                'flag_file' => 'required|mimes:jpeg,jpg,png,gif,tiff|max:1024',
            ]);
            $file_name = str_random(16) . "_" . $request->flag_file->getClientOriginalName();
            $request->flag_file->move(public_path('images/profiles/school'),$file_name);
            $data['flag'] = $file_name;
        }
        School::find(1)->update($data);
        return redirect()->back()->with('alert','Information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
