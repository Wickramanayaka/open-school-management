<?php

namespace ProactiveAnts\Coverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProactiveAnts\Coverage\Device;


class DeviceController extends Controller
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
        $validated_date = $request->validate([
            'device_id' => 'required',
            'class_room_id' => 'required'
        ]);
        // Check existing device for class room
        $device = Device::where('class_room_id', $request->class_room_id)->first();
        if($device==null){
            Device::create([
                'device_id' => $request->device_id,
                'class_room_id' => $request->class_room_id,
                'online' => 1,
                'last_sync' => \Carbon\Carbon::now()
            ]);
        }
        else{
            $device->device_id = $request->device_id;
            $device->online = 1;
            $device->last_sync = \Carbon\Carbon::now();
            $device->save();
        }
        return ['message' => 'The device has been registered successfully.'];
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
        //
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
        //
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
