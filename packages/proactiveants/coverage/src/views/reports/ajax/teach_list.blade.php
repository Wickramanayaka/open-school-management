<div id="report-content">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-right">
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
        <div class="col-lg-8 col-lg-offset-2">
            <h3><center>Teacher Class Room Teaching Report</center></h3>
            <p>From {{$date_from}} To {{$date_to}}<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>Teacher</th><th>Class Room</th><th>Subject</th><th>Type</th><th>Time Spent (min)</th><th>Expected Time (min)</th><th>Difference (min)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periods as $period)
                        <tr>
                            <td>
                                {{$period->teacher->fullName}}
                            </td>
                            <td>
                                {{$period->class_room->name}}
                            </td>
                            <td>
                                {{$period->subject->name}}
                            </td>
                            <td>
                                {{$period->teacher_role}}
                            </td>
                            <td>
                                {{$period->total}}
                            </td>
                            <td>
                                {{$period->subject->duration * $week}}
                            </td>
                            <td>
                                {{($period->subject->duration * $week)-$period->total}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <p style="font-size:10px">Number of Rows : {{count($periods)}}</p>
        </div>
    </div>
</div>