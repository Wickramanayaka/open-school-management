<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Term Examination Progress Report</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <style>
        body{
            background-color: #FFF;
            font-family: sans-serif;
            color: #000;
        }
        @media print{
            footer {
                page-break-after: always;
            }
            body{
                -webkit-print-color-adjust: exact;
            }
            .blue-text{
                color: blue !important;
                -webkit-print-color-adjust: exact;
            }
            .orange-text{
                color: orangered !important;
                -webkit-print-color-adjust: exact;
            }
        }
        .blue-text{
                color: blue;
        }
        .orange-text{
                color: orangered;
        }
        .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
            padding: 3px;
            font-size: 9pt;
        }
        .image{
            position: relative;
            width: 100%;
        }
        p{
            position: absolute;
            top: 10px;
            left: 10px;
            width: 100%;
        }
    </style>
</head>
<body>

@foreach ($students as $student)
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
		<div class="row">
                    <div class="col-lg-12">
                        <img src="{{asset('images/title.png')}}" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4><b>{{$exam_get_param->name}} <span style="float:right">{{count($class_room->grade->section)==0?"":$class_room->grade->section->first()->name}}</span></b></h4>
                    </div>
                </div>
                <div class="row" style="margin-top:0px; margin-bottom:-20px;">
                    <div class="col-lg-12">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div class="image">
                                        <img src="{{asset('images/name_bg.png')}}" alt="" style="width:400px; height:40px;">
                                        <p><strong>Name : </strong>{{$student->fullName}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="image">
                                        <img src="{{asset('images/name_bg.png')}}" alt="" style="width:100px; height:40px;">
                                        <p><strong>Class :  </strong>{{$class_room->name}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="image">
                                        <img src="{{asset('images/name_bg.png')}}" alt="" style="width:200px; height:40px;">
                                        <p><strong>Admission No :  </strong>{{$student->admission_number}}</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="background-color:#aab1f5 !important">SN</th>
                                <th class="text-center" style="background-color:#f8afb4 !important">Subjects</th>
                                @if($class_room->id >= 1 && $class_room->id <= 6)
                                    <th class="text-center" style="background-color:#e3df59 !important">Student Grade</th>
                                    <th class="text-center" style="background-color:#61c4e3 !important">Term One Grade</th>
                                    <th class="text-center" style="background-color:#60e75d !important">Term Two Grade</th>
                                @else
                                    <th class="text-center" style="background-color:#fb6362 !important">Student<br/>Marks</th>
                                    <th class="text-center" style="background-color:#e3df59 !important">Grade</th>
                                    <th class="text-center" style="background-color:#61c4e3 !important">1st Term<br>Marks</th>
                                    <th class="text-center" style="background-color:#60e75d !important">2nd Term<br>Marks</th>
                                @endif
                                
                            </tr>
                            @php $i=1; @endphp
                            @php
                              $exams = $student->exams->sortBy(function($query){
                                  return $query->pivot->subject_id;
                              });
                            @endphp
                            @foreach ($exams as $key => $exam)
                            @if($exam->id==$exam_get_param->id)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{App\Subject::find($exam->pivot->subject_id)->name}} ({{App\Subject::find($exam->pivot->subject_id)->language->name}})</td>
                                            @if($class_room->id >= 1 && $class_room->id <= 6)
                                                @if($exam->pivot->is_absent==0)
                                                    <td class="text-center">{{$exam->pivot->mark_grade}}</td>
                                                    <td class="text-center">{{term_one_grade($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                    <td class="text-center">{{term_two_grade($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                @else
                                                    <td class="text-center">ab</td>
                                                    <td class="text-center">{{term_one_grade($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                    <td class="text-center">{{term_two_grade($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                @endif
                                            @else
                                                @if($exam->pivot->is_absent==0)
                                                    <td class="text-center">{{$exam->pivot->mark}}</td>
                                                    <td class="text-center">{{$exam->pivot->mark_grade}}</td>
                                                    <td class="text-center">{{term_one($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                    <td class="text-center">{{term_two($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                @else
                                                    <td class="text-center">ab</td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-center">{{term_one($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                    <td class="text-center">{{term_two($student,$exam,App\Subject::find($exam->pivot->subject_id))}}</td>
                                                @endif
                                            @endif
                                            
                                        </tr>
                                    </div>
                                </div>
                                @php $i++ @endphp
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                @if($class_room->id >= 1 && $class_room->id <= 15)
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                @foreach ($student->examRanks as $examRank)
                                @if($examRank->id==$exam_get_param->id)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <tr class="text-center">
                                                <td style="background-color:#61c4e3 !important">Rank: {{$examRank->pivot->rank}}</td>
                                                <td style="background-color:#f7cf94 !important">Average of Class 1<sup>st</sup>: {{number_format($examRank->pivot->rank_one_average,2)}}</td>
                                                <td style="background-color:#f9f7ac !important">Total: {{$examRank->pivot->total}}</td>
                                                <td style="background-color:#f3c2f9 !important">Average: {{number_format($examRank->pivot->average,2)}}</td>
                                            </tr>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
                <div class="row" style="margin-top:-20px;">
                    <div class="col-lg-10 col-lg-offset-1">
                        <img src="{{asset('images/mark_grade.png')}}" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row" style="margin-top:20px; margin-bottom:0px;">
                    <div class="col-md-10 col-md-offset-1">
                        <img src="{{asset('images/chart_title_term3.png')}}" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="chart_{{$student->id}}" style="width: 725px; height: 400px;"></div>
                    </div>
                </div>
                <div class="row">
                    <table>
                        <tr>
                            <td rowspan="3">
                                <div id="attendance_{{$student->id}}" style="width:300px; height:150px;"></div>
                            </td>
                            <td rowspan="3" style="font-size:8px;">
                                {{--Discipline Point Balance :
                                <div class="col-md-3" style="background-color: {{getDisciplineColorCode($student,$exam)}} !important; width:50px height:100px; font-size:12px; margin-right:5px;">
                                    {{getDisciplinePointBalance($student,$exam)}}
                                </div>--}}
                            </td>
                            <td>
                                <img src="{{asset('images/remarks.png')}}" alt="" class="img-responsive">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset('images/class_teacher.png')}}" alt="" class="img-responsive">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset('images/reopening.png')}}" alt="" class="img-responsive">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <br>
                    <div class="col-md-12 text-center"><b>Powered By: <span class="blue-text">Blue</span><span class="orange-text">smart</span> Private Limited.</b></div>
                </div>
            </div>
        </div>       
        <footer class="text-center"></footer>
    </div>
    @if(isset($exam))
        <script type="text/javascript">
        //google.charts.load('current', {'packages':['corechart']});
        //google.charts.setOnLoadCallback(drawChart);
        google.load('visualization',"1.1", {'packages':['corechart'], callback: drawChart});

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Present',     {{$student->attendances->where('begin_date','>=',$exam->term->start)->where('begin_date','<=',$exam->term->end)->sum('attendance')}}],
            ['Absent',      {{$exam->term->number_of_days-($student->attendances->where('begin_date','>=',$exam->term->start)->where('begin_date','<=',$exam->term->end)->sum('attendance'))}}]
            ]);

            var options = {
                title: 'Attendance Review',
                legend: {position: 'left'},
                colors: ['green','red']
            };

            var chart = new google.visualization.PieChart(document.getElementById("attendance_{{$student->id}}"));

            chart.draw(data, options);
        }
        </script>
        <script type="text/javascript">
        //google.charts.load('current', {'packages':['bar']});
        //google.charts.setOnLoadCallback(drawChart);
        google.load('visualization',"1.1", {'packages':['corechart'], callback: drawChart});

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            {!!chart_data($student,$exam_get_param)!!}
            ]);

            var options = {
                title: '',
                vAxis: {
                    viewWindow: {
                        min: 0,
                        max: 100
                    },
                    ticks: [0,10,20,30,40,50,60,70,80,90,100]
                },
                colors: ['#61c4e3','#60e75d','red'],
                legend: {position: 'bottom'},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("chart_{{$student->id}}"));
            //chart.draw(data, google.visualization.ColumnChart.convertOptions(options));
            chart.draw(data, options);
        }
        </script>
    @endif
@endforeach
</body>
</html>
