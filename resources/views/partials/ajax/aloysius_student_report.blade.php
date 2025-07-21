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
            <h3><center>College Students' Below Details</center></h3>
            {{--<p>College Students' Below Details<br>--}}
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>FULL NAME</th><th>NAME WITH INITIAL</th><th>ADMISSION NO.</th><th>BIRTHDAY</th><th>ADDRESS</th><th>EMAIL</th><th>TEL. NO.</th><th>NIC. NO.</th>
                        <th>FATHER'S NAME</th><th>MOTHER'S NAME</th><th>GUARDIAN'S NAME</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$student->fullName}}</td>
                            <td>
                                @php
                                    // $surname = explode(" ", $student->surname);
                                    // $first_name = explode(" ", $student->first_name);
                                    // $other_name = $student->other_name;
                                    // $initials = '';
                                    // foreach ($surname as $key => $value) {
                                    //     $initials = $initials . strtoupper(substr($value,0,1)) . "." ;
                                    // }
                                    // foreach ($first_name as $key => $value) {
                                    //     $initials = $initials . strtoupper(substr($value,0,1)) . "." ;
                                    // }
                                    // $initials = $initials . ' ' . $other_name;
                                    // echo $initials;
                                @endphp
                                @php
                                    $name = strtoupper(substr($student->first_name,0,1)) . "." . strtoupper(substr($student->other_name,0,1)) . "." . " " . $student->surname;
                                    $name = str_replace("..",".",$name);
                                    echo $name;
                                @endphp
                            </td>
                            <td>{{$student->admission_number}}</td>
                            <td>{{$student->date_of_birth}}</td>

                            <td>{{$student->address->address}}</td>
                            <th>{{$student->email}}</th>
                            <th>{{$student->telephone}}</th>
                            <th>{{$student->id_number}}</th>
                            <td>{{$student->student_parent->father_name}}</td>
                            <td>{{$student->student_parent->mother_name}}</td>
                            <td>{{$student->student_parent->guardian_name}}</td>

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