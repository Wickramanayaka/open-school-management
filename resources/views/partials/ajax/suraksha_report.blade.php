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
                        <th>ADMISSION NO</th><th colspan="2">GRADE</th><th>NAME WITH INITIALS</th><th>NAME IN FULL</th><th>D</th><th>M</th><th>Y</th><th>GENDER</th>
                        <th>FATHER'S NAME</th><th>MOTHER'S NAME</th><th>PARENT/GUARDIAN ADDRESS</th><th>FATHER'S NIC NO</th><th>MOTHER'S NIC NO</th><th>CONTACT NO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$student->admission_number}}</td>
                            <td>{{$student->present_class_room->grade->name}}</td>
                            <td>{{$student->present_class_room->division->name}}</td>
                            <td>
                                @php
                                    $name = strtoupper(substr($student->first_name,0,1)) . "." . strtoupper(substr($student->other_name,0,1)) . "." . " " . $student->surname;
                                    $name = str_replace("..",".",$name);
                                    echo $name;
                                @endphp
                            </td>
                            <td>{{$student->fullName}}</td>
                            <td>{{date('d',strtotime($student->date_of_birth))}}</td>
                            <td>{{date('m',strtotime($student->date_of_birth))}}</td>
                            <td>{{date('Y',strtotime($student->date_of_birth))}}</td>
                            <td>{{$student->gender}}</td>
                            <td>{{$student->student_parent->father_name}}</td>
                            <td>{{$student->student_parent->mother_name}}</td>
                            <td>{{$student->address->address}}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                                @if (!$student->student_parent->father_telephone=='')
                                    {{$student->student_parent->father_telephone}}
                                @elseif(!$student->student_parent->mother_telephone=='')
                                    {{$student->student_parent->mother_telephone}}
                                @else
                                    {{$student->student_parent->guardian_telephone}}
                                @endif
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
            <p style="font-size:10px">Number of Students : {{count($students)}}</p>
        </div>
    </div>
</div>