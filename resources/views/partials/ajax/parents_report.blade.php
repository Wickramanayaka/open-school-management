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
            <h3><center>Parents Report</center></h3>
            <p>Parents Basic Information<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable" id="data-table">
                <thead>
                    <tr>
                        <th>Father Name</th><th>Mother Name</th><th>Guardian Name</th><th>Student</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parents as $item)
                        <tr>
                            <td>
                                {{$item->father_name}}<br>
                                {{$item->f_occupation->name}}<br>
                                {{$item->father_telephone}}
                            </td>
                            <td>
                                {{$item->mother_name}}<br>
                                {{$item->m_occupation->name}}<br>
                                {{$item->mother_telephone}}
                            </td>
                            <td>
                                {{$item->guardian_name}}<br>
                                {{$item->g_occupation->name}}<br>
                                {{$item->guardian_telephone}}
                            </td>
                            <td>
                                <table class="table table-bordered">
                                    @foreach ($item->students as $student)
                                        <tr>
                                            <td>{{$student->admission_number}}</td><td>{{$student->fullName}}</td><td>{{$student->present_class_room->name}}</td>
                                        </tr>
                                    @endforeach
                                    
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <p style="font-size:10px">Number of Parents : {{count($parents)}}</p>
        </div>
    </div>
</div>