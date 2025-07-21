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
            <h3><center>Exam Report</center></h3>
            <p>Examination: {{$exam->name}}<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable" id="data-table">
                <thead>
                    <tr>
                        <th>Admission No</th><th>Full name</th><th>Class Room</th><th>Average</th><th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranks as $item)
                        <tr>
                            <td>{{$item->student->admission_number}}</td>
                            <td>{{$item->student->fullName}}</td>
                            <td>{{$item->class_room->name}}</td>
                            <td>{{number_format($item->average,2)}}</td>
                            <td>{{$item->rank}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <p style="font-size:10px">Number of Students : {{count($ranks)}}</p>
        </div>
    </div>
</div>