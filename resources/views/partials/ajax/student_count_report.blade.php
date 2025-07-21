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
            <h3><center>Student Details</center></h3>
            <p>Student Basic Information<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>ADMISSION NO</th><th>GRADE</th><th>NAME WITH INITIALS</th><th>NAME IN FULL</th><th>GENDER</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $male = 0;
                        $female = 0;
                    @endphp
                    @foreach ($students as $student)
                        @if ($student->gender=="Male")
                            <tr>
                                <td>{{$student->admission_number}}</td>
                                <td>{{$student->present_class_room->grade->name}} {{$student->present_class_room->division->name}}</td>
                                <td>
                                    @php
                                        $name = strtoupper(substr($student->first_name,0,1)) . "." . strtoupper(substr($student->other_name,0,1)) . "." . " " . $student->surname;
                                        $name = str_replace("..",".",$name);
                                        echo $name;
                                    @endphp
                                </td>
                                <td>{{$student->fullName}}</td>
                                <td>{{$student->gender}}</td>
                            </tr>
                            @php
                                $male++;
                            @endphp
                        @endif
                    @endforeach
                    @if ($male>0)
                        <tr><td colspan="5" class="text-left" style="font-size:14px;"><b>Student Count: {{$male}}</b></td></tr>
                    @endif
                    @foreach ($students as $student)
                        @if ($student->gender=="Female")
                            <tr>
                                <td>{{$student->admission_number}}</td>
                                <td>{{$student->present_class_room->grade->name}} {{$student->present_class_room->division->name}}</td>
                                <td>
                                    @php
                                        $name = strtoupper(substr($student->first_name,0,1)) . "." . strtoupper(substr($student->other_name,0,1)) . "." . " " . $student->surname;
                                        $name = str_replace("..",".",$name);
                                        echo $name;
                                    @endphp
                                </td>
                                <td>{{$student->fullName}}</td>
                                <td>{{$student->gender}}</td>
                            </tr>
                            @php
                                $female++;
                            @endphp
                        @endif
                    @endforeach
                    @if ($female>0)
                        <tr><td colspan="5" class="text-left" style="font-size:14px;"><b>Student Count: {{$female}}</b></td></tr>
                    @endif
                        <tr><td colspan="5" class="text-left" style="font-size:16px;"><b>Total Number of Students: {{count($students)}}</b></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>