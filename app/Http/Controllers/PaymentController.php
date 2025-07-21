<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\PayementCategory;
use App\Student;
use App\Chart;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payments.index');
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
            'student_id' => 'required',
            'date' => 'required|date',
            'description' => "required",
            'payment_category_id' => 'required'
        ]);
        Payment::create($request->all());
        return redirect(url("student/$request->student_id#payment"))->with('alert','Payment has been added.');

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
        $payment = Payment::find($id);
        $payment->is_canceled = 1;
        $payment->save();
        return redirect(url("student/$request->student_id#payment"))->with('alert','Payment has been canceled.');
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

    public function getPaymentForYear()
    {
        $data = Payment::selectRaw('date,sum(amount) as total')->groupBy('date')->orderBy('date','desc')->take(30)->get();
        $chart = new Chart();
        $chart->col(array(array("Month","string"),array("Amount","number")));
        foreach ($data as $item) {
            $chart->row(array($item->date,$item->total));
        }
        return $chart->toString();
    }

    public function getFeePaymentForClass()
    {
        $data = Student::all();
        $chart = new Chart();
        $chart->col(array(array("Student","string"),array("ID","number")));
        foreach ($data as $student) {
            $chart->row(array($student->fullName,$student->id));
        }
        return $chart->toString();
    }
}
