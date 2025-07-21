@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            Dashboard
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row" style="height:auto;">
                        <div class="col-lg-12">
                            <div id="student-attendance"></div>
                        </div>
                    </div>
                    {{--<div class="col-lg-12" style="margin-top:20px;">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                TOP STUDENTS
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    @foreach ($ranks as $rank)
                                        <div class="col-lg-3 text-center">
                                            <img class="img-circle img-responsive" src="{{url('images/profiles/students/') ."/" . $rank->student->photo}}" />
                                            <a href="{{route('student.show',$rank->student->id)}}">{{$rank->student->surname}}</a><br>
                                            <small>{{$rank->rank}} place <br> class {{$rank->student->present_class_room->name}}</small>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default" style="background-color:#B13C2E; color:#FFF;height:100px;">
                                <div class="panel-body text-center">
                                    TEACHERS<h1 style="margin:0;" id="teacher-count"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-default" style="background-color:#008548; color:#FFF;height:100px;">
                                <div class="panel-body text-center">
                                    STUDENTS<h1 style="margin:0;" id="student-count"></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default" style="background-color:#F39C12; color:#FFF;height:100px; margin-bottom:5px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3 text-center">
                                            <h1><i class="fa fa-list-ol fa-fw"></i></h1>
                                        </div>
                                        <div class="col-lg-9">
                                            GRADES
                                            <h1 style="margin:0;" id="grade-count"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default" style="background-color:#00A65A; color:#FFF;height:100px; margin-bottom:5px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3 text-center">
                                            <h1><i class="fa fa-book fa-fw"></i></h1>
                                        </div>
                                        <div class="col-lg-9">
                                            SUBJECTS
                                            <h1 style="margin:0;" id="subject-count"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default" style="background-color:#DD4B39; color:#FFF; height:100px; margin-bottom:5px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3 text-center">
                                            <h1><i class="fa fa-building fa-fw"></i></h1>
                                        </div>
                                        <div class="col-lg-9">
                                            CLASS ROOMS
                                            <h1 style="margin:0;" id="class_room-count"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default" style="background-color:#00C0EF; color:#FFF;height:100px; margin-bottom:20px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3 text-center">
                                            <h1><i class="fa fa-graduation-cap fa-fw"></i></h1>
                                        </div>
                                        <div class="col-lg-9">
                                            EXAMINATIONS
                                            <h1 style="margin:0;" id="exam-count"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function(){
            $.get('./dashboard/getCount', function(data){
                $('#teacher-count').text(data.teacher);
                $('#student-count').text(data.student);
                $('#grade-count').text(data.grade);
                $('#class_room-count').text(data.class_room);
                $('#subject-count').text(data.subject);
                $('#exam-count').text(data.exam);
            });
        });
    </script>
    <script type="text/javascript"  src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStacked);

        function drawStacked() {

            var jsonData = $.ajax({
                    url: "{{url('./dashboard/getStudentAttendanceForThisMonth')}}",
                    dataType: "json",
                    async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);

            var options = {
            title: 'Monthly Student Attendance',
            hAxis: {
            title: 'Days',
            },
            vAxis: {
            title: 'Attendance'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('student-attendance'));
        chart.draw(data, options);
        }
    </script>
@endsection