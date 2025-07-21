<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Student;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('houses.index',['houses' => House::all()]);
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
        $this->validate($request,[
            'code' => 'required|unique:houses',
            'name' => 'required'
        ]);

        House::create($request->all());
        return redirect(route('house.index'))->with('alert','The house has been created successfuly');
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
        $house = House::findOrFail($id);
        return view('houses.edit',['house' => $house]);
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
            'code' => 'required|unique:houses,code,' .$id,
            'name' => 'required'
        ]);

        $house = House::findOrFail($id);
        $house->code = $request->code;
        $house->name = $request->name;
        $house->update();
        return redirect(route('house.index'))->with('alert','The house has been updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::findOrFail($id);
        //Check in Student
        if (!Student::where('house_id',$house->id)->first() == null) {
            return redirect(route('house.index'))->withErrors(["The house can not be deleted."]);
        }
        else {
            $house->delete();
            return redirect(route('house.index'))->with('alert',"The house has been deleted.");
        }
    }
}
