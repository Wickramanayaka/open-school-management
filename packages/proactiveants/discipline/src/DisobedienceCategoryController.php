<?php

namespace ProactiveAnts\Discipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProactiveAnts\Discipline\DisobedienceCategory;
use ProactiveAnts\Discipline\Disobedience;
use Spatie\Permission\Models\Role;
use ProactiveAnts\Discipline\DisobedienceCategoryRole;

class DisobedienceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discipline::categories.index',['disobeys' => DisobedienceCategory::orderBy('point_deduct')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discipline::categories.create',['roles' => Role::all()]);
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
            'point_deduct' => 'required',
            'role_id' => 'required'
        ]);
        $category = DisobedienceCategory::create($request->all());

        if($request->has('role_id')){
            foreach($request->role_id as $role){
                DisobedienceCategoryRole::create([
                    'role_id' => $role,
                    'disobedience_category_id' => $category->id
                ]);
            }
        }
        return redirect('discipline/category/create')->with('alert','The category has been created successfuly.');
        
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
        return view('discipline::categories.edit',['category'=> DisobedienceCategory::findOrFail($id), 'roles' => Role::all()]);
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
            'point_deduct' => 'required'
        ]);

        $data = $request->all();
        if(!$request->has('is_critical'))
            $data['is_critical'] = 0;
        
        DisobedienceCategory::findOrFail($id)->update($data);

        if($request->has('role_id')){
            // Delete existing
            DisobedienceCategoryRole::where('disobedience_category_id',$id)->delete();
            foreach($request->role_id as $role){
                DisobedienceCategoryRole::create([
                    'role_id' => $role,
                    'disobedience_category_id' => $id
                ]);
            }
        }

        return redirect(url('discipline/category'))->with('alert','The category has been updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = DisobedienceCategory::findOrFail($id);
        //Check uses for category
        if (!Disobedience::where('disobedience_category_id',$id)->first() == null) {
            return redirect(url('/discipline/category'))->withErrors(["The category can not be deleted."]);
        }
        else{
            $category->delete();
            // Delete roles
            DisobedienceCategoryRole::where('disobedience_category_id',$id)->delete();
            return redirect(url('/discipline/category'))->with('alert',"The category has been deleted.");
        }
    }
}
