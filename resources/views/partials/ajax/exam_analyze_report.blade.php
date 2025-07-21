<div id="report-content">
    <div class="row">
        <div class="col-lg-12 text-right" style="overflow: auto">
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
        <div class="col-lg-12" style="overflow: auto">
            <h3><center>Exam Marks Analyze Report</center></h3>
            <p>Examination: {{$exam->name}}<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th class="vertical-text">Admission No</th>
                        <th class="vertical-text">Full name</th>
                        <th class="vertical-text">Class Room</th>
                        @foreach ($subjects as $subject)
                            <th class="vertical-text">{{$subject->name}}({{$subject->language->name}})</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marks as $item)
                        <tr>
                            <td>{{$item['admission_number']}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['class_room']}}</td>
                            @foreach ($item['subject_marks'] as $mark)
                            <td style="background-color:{{getMarkColor($mark['mark'])}} !important">
                                {{$mark['mark']=='null'?'':$mark['mark']}}
                                {{$mark['mark']=='0' ?'0':''}}
                            </td>
                        @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div style="overflow: auto" id="curve_chart"></div>
        </div>
    </div>
    
</div>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = new google.visualization.DataTable();
      data.addColumn('string', 'Subject');
    @php 
        foreach($class_rooms as $class_room){
            echo "data.addColumn('number', '" . $class_room->name . "');";
        }
    @endphp
      data.addRows([
        {!!$chart!!}
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: ''
        },
      };

    var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
    }
</script>
