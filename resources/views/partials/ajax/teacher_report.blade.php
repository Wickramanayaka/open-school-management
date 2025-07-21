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
            <h3><center>Teacher Report</center></h3>
            <p>Teacher Basic Information<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable" id="data-table">
                <thead>
                    <tr>
                        <th>Admission No</th><th>Full Name</th><th>Class Room</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{$teacher->admission_number}}</td>
                            <td>{{$teacher->fullName}}</td>
                            <td>{{$teacher->present_class_room->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <p style="font-size:10px">Number of Teachers : {{count($teachers)}}</p>
        </div>
    </div>
</div>