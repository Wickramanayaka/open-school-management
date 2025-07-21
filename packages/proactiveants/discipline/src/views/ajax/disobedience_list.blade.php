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
            <h3><center>Student Disobedience Report</center></h3>
            <p>From {{$date_from}} To {{$date_to}}<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>Admission Number</th><th>Full name</th><th>Class Room</th><th>Date</th><th>Disobedience</th><th>Point Deduct</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disobediences as $item)
                        <tr>
                            <td>
                                {{$item->student->admission_number}}
                            </td>
                            <td>
                                {{$item->student->fullName}}
                            </td>
                            <td>
                                {{$item->student->present_class_room->name}}
                            </td>
                            <td>
                                {{$item->date}}
                            </td>
                            <td>
                                {{$item->disobedience->name}}
                            </td>
                            <td>
                                {{$item->point_deduct}}
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
            <p style="font-size:10px">Number of Rows : {{count($disobediences)}}</p>
        </div>
    </div>
</div>