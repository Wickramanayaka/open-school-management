<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\ClassRoom;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validated_data = $request->validate([
            'name' => 'required|unique:divisions'
        ]);
        Division::create($request->all());
        return redirect(route('grade.index'))->with('alert','The division has been created successfuly.');
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
        return view('divisions.edit',['division' => Division::find($id)]);
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
            'name' => 'required|unique:divisions,name,' .$id
        ]);
        Division::find($id)->update($request->all());
        return redirect(route('grade.index'))->with('alert','The Division has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::find($id);
        // Check Class Room is used
        if (!ClassRoom::where('division_id',$division->id)->first() == null) {
            return redirect(route('grade.index'))->withErrors(["The Division can not be deleted."]);
        }
        else{
            $division->delete();
            return redirect(route('grade.index'))->with('alert',"The Division has been deleted.");
        }
    }
}
