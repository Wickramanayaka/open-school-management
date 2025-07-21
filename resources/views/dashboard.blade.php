@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            Dashboard
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    {{--<div id="floating-panel">
                    <button onclick="toggleHeatmap()">Toggle Heatmap</button>
                    <button onclick="changeGradient()">Change gradient</button>
                    <button onclick="changeRadius()">Change radius</button>
                    <button onclick="changeOpacity()">Change opacity</button>
                    </div>
                    <div id="heat-map" style="height:540px;"></div>--}}
                    <img src="{{asset('images/dashboard.jpg')}}" alt="" class="img-fluid">

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
            <div class="row" style="height:350px;">
                <div class="col-lg-12">
                    <div id="student-attendance"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-8">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            PAYMENT COLLECTION
                        </div>
                        <div class="panel-body">
                            <div id="payment-collection"></div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            SECTIONS HEADS
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach ($sections as $section)
                                    <div class="col-lg-4 text-center">
                                        <img class="img-circle img-responsive" src="{{url('images/profiles/teachers/') ."/" . $section->teacher->photo}}" />
                                        <a href="{{route('teacher.show',$section->teacher->id)}}">{{$section->teacher->surname}}</a><br>
                                        <small>{{$section->name}}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            TEACHERS' ATTENDANCE
                        </div>
                        <div class="panel-body">
                            <div id="teacher-attendance"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{--<div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            GRADE STUDENTS COMPOSITION
                        </div>
                        <div class="panel-body">
                            <table class="table table-compact" style="font-size:12px;">
                                <tr>
                                    <th>GRADE</th><th>STUDENT COUNT</th><th></th>
                                </tr>
                                @foreach ($grades as $grade)
                                    <tr>
                                    <td>{{$grade->name}}</td>
                                    <td style="width:500px;">
                                        @php
                                            $count = 0;
                                            foreach ($grade->classRooms as $classRoom){
                                                $count = $count + $classRoom->currentStudents->count();
                                            }
                                        @endphp

                                        <div class="progress">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="{{$count}}" aria-valuemin="0" aria-valuemax="50" style="width: {{$count}}%;">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$count}}
                                    </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
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
            title: 'Student Attendance Last 10 days',
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
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStacked);

        function drawStacked() {

            var jsonData = $.ajax({
                    url: "{{url('./dashboard/getTeacherAttendanceForThisMonth')}}",
                    dataType: "json",
                    async: false
            }).responseText;

            var data = new google.visualization.DataTable(jsonData);

            var options = {
            title: 'Top Teacher Attendance',
            hAxis: {
            title: 'Teacher',
            },
            vAxis: {
            title: 'Attendance'
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('teacher-attendance'));
        chart.draw(data, options);
        }

    </script>
    <script>

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {

        var jsonData = $.ajax({
                url: "{{route('payment.getPaymentForYear')}}",
                dataType: "json",
                async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
        title: 'Payment Distrbutions',
        hAxis: {
          title: 'Days',
        },
        vAxis: {
          title: 'Amount (LKR)'
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('payment-collection'));
      chart.draw(data, options);
    }

</script>
    <script>
      var map, heatmap;

      function initMap() {
        map = new google.maps.Map(document.getElementById('heat-map'), {
          zoom: 10,
          center: {lat: 6.901311, lng: 79.873521},
          mapTypeId: 'satellite'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map
        });
      }

      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }

      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }

      // Heatmap data: 500 Points
      function getPoints() {
        return [
                @php
                    foreach($cities as $item){
                        echo $item[0].',';
                    }
                @endphp
            ];
      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=visualization&callback=initMap">
    </script>

@endsection