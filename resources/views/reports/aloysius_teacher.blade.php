@extends('layouts.app')
@section('content')
<div class="panel panel-primary" id="content-panel">
    <div class="panel-heading">
        <div class="row">
            <div class="col-lg-6">
                Report Data
            </div>
            <div class="col-lg-6">
                    <ul class="nav navbar-nav navbar-right tool-bar">
                        <li><a href="#" onclick="print_table()"><i class="fa fa-print"></i></a></li>
                        <li><a href="#" onclick="export_table()"><i class="fa fa-download fa-fw"></i></a></li>
                    </ul>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div id="report-content" style="overflow-x: scroll">
            <div class="row">
                <div class="col-lg-12 text-right">
                    @php
                        $school = App\School::first();
                        echo '<img width="50px;" src="' . url('images/profiles/school/') . '/' . $school->logo . '"><br>';
                        echo $school->name . '<br>';
                        echo $school->address . '<br>';
                        echo $school->telephone . '<br>';
                    @endphp
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3><center>College Teachers' Below Details</center></h3>
                    {{--<p>College Students' Below Details<br>--}}
                    Printed on: {{date('Y-m-d',time())}}</p>
                    <table class="table table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>EMP NO.</th>
                                <th>TEACHERS FULL NAME</th>
                                <th>ADDRESS</th>
                                <th>TEL. NO.</th>
                                <th>NIC. NO.</th>
                                <th>EMAIL</th>
                                <th>GENDER</th>
                                <th>SUBJECT OF APPOINTMENT</th>
                                <th>APPOINTMENT DATE</th>
                                <th>DATE OF APPOINTMENT (THIS SCHOOL)</th>
                                <th>EXPERIENCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{$teacher->admission_number}}</td>
                                    <td>{{$teacher->fullName}}</td>
                                    <td>{{$teacher->address->address}}</td>
                                    <td>{{$teacher->telephone}}</td>
                                    <td>{{$teacher->id_number}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->gender}}</td>
                                    <td>{{$teacher->appointment_subject}}</td>
                                    <td>{{$teacher->appointment_date}}</td>
                                    <td>{{$teacher->appointment_date_this_school}}</td>
                                    <td>
                                        @php
                                            foreach($teacher->experiences as $exp){
                                                echo $exp->subject." (".$exp->type.")"." - " .$exp->grade. ', ';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <p style="font-size:10px">Number of Teachers : {{count($teachers)}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    function print_table(){
        var tableToPrint = document.getElementById("report-content");
        newWin = window.open();
        newWin.document.write('<link href="{{ asset("css/app.css") }}" rel="stylesheet">');
        newWin.document.write(tableToPrint.outerHTML);
    }
    function export_table(){
        $("#data-table").tableToCSV();
    }     
</script>
@endsection