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
            <h3><center>Short Message Report</center></h3>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>Admission Number</th><th>Student Name</th><th>Class Room</th><th>Message</th><th>Date</th><th>Phone</th><th>Created By</th><th>No. of SMS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $item)
                        <tr>
                            <td>{{$item->student->admission_number}}</td>
                            <td>{{$item->student->fullName}}</td>
                            <td>{{$item->class_room->name}}</td>
                            <td>{{$item->message}}</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->number_of_sms}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <p style="font-size:10px">Number of Rows : {{count($messages)}} </p>
        </div>
    </div>
</div>
    