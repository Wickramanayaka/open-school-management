<div id="report-content">
    <div class="row">
        <div class="col-lg-12 text-right" style="overflow: auto">
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
        <div class="col-lg-12" style="overflow: auto">
            <h3><center>Exam Marks Analyze Report (Shuffled class rooms)</center></h3>
            <p>Examination : {{$exam->name}}<br>
                Class room : {{ $class_room->name}}<br>
                Printed on : {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th class="vertical-text">Admission No</th>
                        <th class="vertical-text">Full name</th>
                        <th class="vertical-text">Previous Class Room</th>
                        @foreach ($subjects as $subject)
                            <th class="vertical-text">{{$subject->name}}({{$subject->language->name}})</th>
                        @endforeach
                        <th class="vertical-text">Average</th>
                        <th class="vertical-text">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marks as $item)
                        <tr>
                            <td>{{$item['admission_number']}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['previous_class_room']}}</td>
                            @foreach ($item['subject_marks'] as $mark)
                                <td style="background-color:{{getMarkColor($mark['mark'])}} !important">{{$mark['mark']=='null'?'':$mark['mark']}}</td>
                            @endforeach
                            <td>
                                {{number_format($item['average'],2)}}
                            </td>
                            <td>
                                {{$item['rank']}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>   
</div>
