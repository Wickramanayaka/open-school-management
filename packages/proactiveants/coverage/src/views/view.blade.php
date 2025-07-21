<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="{{url('images/logo.png')}}" />
    <title>Management Portal</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
    <style>
        html body{
            font-family: 'Lato', sans-serif;
        }
        h3{
            font-size: 15px;
            font-weight: 900
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Bluesmart School</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{url('management')}}"><i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i> Back</a></li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container-fluid" style="margin-top:50px;">
        <div class="row">
            <div class="col-lg-12">
                <h3>{{$class_room->name}} - Time spent on each subject for this week</h3>
                <div id="progress"></div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <h3>Student Today Attendance</h3>
                <div id="attendance"></div>
            </div>
            <div class="col-lg-6">
                <h3>Time Spent for Each Period (Today)</h3>
                <div id="period"></div>
            </div>
            <div class="col-lg-3">
                <h3>Class Room Statistics</h3>
                <table class="table table-compact">
                    <tr>
                        <td>Class Room</td><td><b>{{$class_room->name}}</b></td>
                    </tr>
                    <tr>
                    <td>Class Teacher</td>
                    @if($teacher==null)
                        <td>Not defined</td>
                    @else
                        <td><img class="img-circle" src="{{url('images/profiles/teachers/') . "/" . $teacher->photo}}" style="width:30px; display:inline-block; margin: 0 auto;"> <b><a href="{{route('teacher.show',$teacher->id)}}">{{$teacher->fullName}}</a></b></td>
                    @endif
                    </tr>
                    <tr>
                        <td>No. of Student</td><td><b>{{$class_room->currentStudents->count()}}</b></td>
                    </tr>
                    <tr>
                        <td>Subjects</td><td><b>{{$subjects->count()}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-5">
                <h3>Teachers' Period Attendance (Today)</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Teacher</th><th>IN</th><th>OUT</th>
                    </tr>
                    @foreach ($today_periods as $period)
                        <tr>
                            <td><img class="img-circle" src="{{url('images/profiles/teachers/') . "/" . $period->teacher->photo}}" style="width:30px; display:inline-block; margin: 0 auto;"> <a href="{{route('teacher.show',$period->teacher->id)}}">{{$period->teacher->fullName}}</a></td>
                            <td>{{$period->time_in==null?'':$period->time_in->toTimeString()}}</td>
                            <td>{{$period->time_out==null?'':$period->time_out->toTimeString()}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-7">
                <h3>Student Feedback</h3>
                <div class="row">
                    @foreach ($feedbacks as $feedback)
                        <div class="col-lg-2">
                            <img class="img-circle" src="{{url('images/profiles/teachers/') . "/" . $feedback->period->teacher->photo}}" style="width: {{$feedback->total/$feedback->number_of}}px; display:block; margin: 0 auto;">
                            <h2 class="text-center">{{ number_format($feedback->total/$feedback->number_of,0) }}%</h2>
                        <p class="text-center"><a href="{{route('teacher.show',$feedback->period->teacher->id)}}">{{$feedback->period->teacher->fullName}}</a><br>{{$feedback->period->subject->name}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"  src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStacked);

        function drawStacked() {

            var jsonData = $.ajax({
                    url: "{{url("management/$id/chart")}}",
                    dataType: "json",
                    async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);

            var options = {
            title: '',
            colors: ['#e6693e'],
            height: '1200',
            chartArea: {width: '50%', height: '90%'},
            hAxis: {
            title: 'Completion (%)',
            minValue: 0,
            maxValue:100,
            textStyle: {fontName: 'Lato'},
            },
            vAxis: {
            title: '',
            textStyle: {fontName: 'Lato', fontSize: '12'},
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('progress'));
        chart.draw(data, options);
        }
    </script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStacked);

        function drawStacked() {

            var jsonData = $.ajax({
                    url: "{{url("management/$id/attendance")}}",
                    dataType: "json",
                    async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);

            var options = {
            title: '',
            colors: ['#109618','#DC3912'],
            chartArea: {width: '70%'},
            hAxis: {
            title: '',
            minValue: 0,
            maxValue:100,
            textStyle: {fontName: 'Lato'},
            },
            vAxis: {
            title: '',
            textStyle: {fontName: 'Lato', fontSize: '12'},
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('attendance'));
        chart.draw(data, options);
        }
    </script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStacked);

        function drawStacked() {

            var jsonData = $.ajax({
                    url: "{{url("management/$id/period")}}",
                    dataType: "json",
                    async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);

            var options = {
            title: '',
            colors: ['#109618'],
            chartArea: {width: '75%'},
            hAxis: {
            title: 'Period',
            minValue: 0,
            maxValue:45,
            textStyle: {fontName: 'Lato'},
            },
            vAxis: {
            title: 'Minutes',
            textStyle: {fontName: 'Lato', fontSize: '12'},
            },
            legend: {position: 'none'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('period'));
        chart.draw(data, options);
        }
    </script>
</body>
</html>