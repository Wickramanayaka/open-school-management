<?php

namespace ProactiveAnts\Discipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProactiveAnts\Discipline\DisobedienceCategory;
use ProactiveAnts\Discipline\Disobedience;
use ProactiveAnts\Discipline\DisobedienceStudent;


class DisobedienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discipline::disobediences.index',['disobeys' => Disobedience::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discipline::disobediences.create',['categories' => DisobedienceCategory::all()]);
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
            'name' => 'required',
        ]);
        Disobedience::create($request->all());
        return redirect('discipline/disobedience/create')->with('alert','The disobedience has been created successfuly.');
        
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
        return view('discipline::disobediences.edit',['categories'=> DisobedienceCategory::all(), 'disobedience' => Disobedience::findOrFail($id)]);
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
        ]);
        
        Disobedience::findOrFail($id)->update($request->all());
        return redirect(url('discipline/disobedience'))->with('alert','The disobedience has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disobey = Disobedience::findOrFail($id);
        //Check uses for disobedience
        if (!DisobedienceStudent::where('disobedience_id',$id)->first() == null) {
            return redirect(url('/discipline/disobedience'))->withErrors(["The disobedience can not be deleted."]);
        }
        else{
            $disobey->delete();
            return redirect(url('/discipline/disobedience'))->with('alert',"The disobedience has been deleted.");
        }
    }
}
