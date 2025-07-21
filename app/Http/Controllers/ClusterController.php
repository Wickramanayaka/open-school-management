<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cluster;
use App\Student;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clusters.index',['clusters' => Cluster::all() ]);
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
            'code' => 'required|unique:clusters',
            'name' => 'required'
        ]);

        Cluster::create($request->all());
        return redirect(route('cluster.index'))->with('alert','The cluster has been created successfuly');
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
        $cluster = Cluster::findOrFail($id);
        return view('clusters.edit',['cluster' => $cluster]);
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
            'code' => 'required|unique:clusters,code,' .$id,
            'name' => 'required'
        ]);

        $cluster = Cluster::findOrFail($id);
        $cluster->code = $request->code;
        $cluster->name = $request->name;
        $cluster->description = $request->description;
        $cluster->update();
        return redirect(route('cluster.index'))->with('alert','The cluster has been updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cluster = Cluster::findOrFail($id);
        //Check in Student
        if (!Student::where('cluster_id',$cluster->id)->first() == null) {
            return redirect(route('cluster.index'))->withErrors(["The cluster can not be deleted."]);
        }
        else {
            $cluster->delete();
            return redirect(route('cluster.index'))->with('alert',"The cluster has been deleted.");
        }
    }
}
