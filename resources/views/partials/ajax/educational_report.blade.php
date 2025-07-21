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
            <h3><center>Educational Report</center></h3>
            <p>Examination: {{$exam->name}}<br>
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered datatable" id="data-table">
                <thead>
                    <tr>
                        <th>Admission No</th><th>Subject</th><th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{$item->student->admission_number}} - {{$item->student->fullName}} ({{$item->class_room->name}})</td>
                            <td>{{$item->subject->code}} - {{$item->subject->name}} ({{$item->subject->language->name}})</td>
                            <td>{{$item->mark}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>