<?php

namespace ProactiveAnts\Coverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\ClassRoom;
use App\Student;
use ProactiveAnts\Coverage\Chapter;
use ProactiveAnts\Coverage\Period;
use App\StudentAttendance;
use ProactiveAnts\Coverage\ChapterCoverage;
use App\Chart;
use ProactiveAnts\Coverage\Feedback;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Storage;

class FeedbackController extends Controller
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
            'point' => 'required',
            'period_id' => 'required',
        ]);

        // Get period
        try{
            $period = Period::findOrFail($request->period_id);
            // Multiple period for combined class
            $combined_periods = Period::where('combined_code',$period->combined_code)->get();
        }
        catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Invalid period.'],404);
        }
        foreach($combined_periods as $period){
            $feedback = Feedback::create([
                'period_id' => $period->id,
                'teacher_id' => $period->teacher_id,
                'point' => $request->point,
            ]);
        }              
        return ['feedback' => $feedback];
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
