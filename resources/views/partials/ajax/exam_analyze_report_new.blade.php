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
            <h3><center>Exam Marks Analyze Report (S1)</center></h3>
            <p>Examination: {{$exam->name}}<br>
            Class room : {{ $class_rooms->first()->name}}<br>    
            Printed on: {{date('Y-m-d',time())}}</p>
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Admission No</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Full name</th>
                        @foreach ($subjects as $subject)
                            <th colspan="2"  style="writing-mode: sideways-lr; text-orientation:mixed">{{$subject->name}}<br>({{$subject->language->name}})</th>
                        @endforeach
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>S</th>
                        <th>W</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Total</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Average</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Position</th>
                    </tr>
                    <tr>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed"></th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed"></th>
                        @foreach ($subjects as $subject)
                            <th>M</th>
                            <th>G</th>
                        @endforeach
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed"></th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed"></th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marks as $item)
                        <tr>
                            <td>{{$item['admission_number']}}</td>
                            <td>{{$item['name']}}</td>
                            @foreach ($item['subject_marks'] as $mark)
                            <td style="background-color:{{getMarkColor($mark['mark'])}} !important">
                                {{$mark['mark']=='null'?'':$mark['mark']}}
                                {{$mark['mark']=='0' ?'0':''}}
                            </td>
                            <td style="background-color:{{getMarkColor($mark['mark'])}} !important">
                                @php
                                    if($mark['mark']=='null'){
                                        echo "";
                                    }
                                    elseif($mark['mark']  >= 75){
                                        echo "A";
                                    }
                                    elseif($mark['mark']  < 75 && $mark['mark']  >= 65){
                                        echo "B";
                                    }
                                    elseif($mark['mark']  < 65 && $mark['mark']  >= 50){
                                        echo "C";
                                    }
                                    elseif($mark['mark']  < 50 && $mark['mark']  >= 40){
                                        echo "S";
                                    }
                                    elseif($mark['mark']  < 40 && $mark['mark']  >= 0){
                                        echo "W";
                                    }
                                    else{
                                        echo "";
                                    }
                                @endphp
                            </td>
                        @endforeach
                            <td>{{$item['a']}}</td>
                            <td>{{$item['b']}}</td>
                            <td>{{$item['c']}}</td>
                            <td>{{$item['s']}}</td>
                            <td>{{$item['w']}}</td>
                            <td>{{$item['total']}}</td>
                            <td>{{$item['average']}}</td>
                            <td>{{$item['position']}}</td>
                        </tr>
                    @endforeach
                    <tr style="background-color: gray !important;">
                        <td></td>
                        <td></td>
                        @foreach ($count[0]['subject_marks'] as $mark)
                            <td></td>
                            <td></td>
                        @endforeach
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>Mean</b></td>
                        @foreach ($mean as $item)
                            <td>{{$item['count']}}</td>
                            <td></td>
                        @endforeach
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="background-color: gray !important;">
                        <td></td>
                        <td></td>
                        @foreach ($count[0]['subject_marks'] as $mark)
                            <td></td>
                            <td></td>
                        @endforeach
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($count as $item)
                        <tr>
                            <td></td>
                            <td><b>{{$item['name']}}</b></td>
                            @foreach ($item['subject_marks'] as $mark)
                                <td>{{$mark['count']=='null'?'':$mark['count']}}</td>
                                <td style="background-color: gray !important;"></td>
                            @endforeach
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr style="background-color: gray !important;">
                        <td></td>
                        <td></td>
                        @foreach ($count[0]['subject_marks'] as $mark)
                            <td></td>
                            <td></td>
                        @endforeach
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($count2 as $item)
                        <tr>
                            <td></td>
                            <td><b>{{$item['name']}}</b></td>
                            @foreach ($item['subject_marks'] as $mark)
                                <td style="background-color: gray !important;"></td>
                                <td>{{$mark['count']=='null'?'':$mark['count']}}</td>
                            @endforeach
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed"></th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Subjects</th>
                        @foreach ($subjects as $subject)
                            <th colspan="2"  style="writing-mode: sideways-lr; text-orientation:mixed">{{$subject->name}}<br>({{$subject->language->name}})</th>
                        @endforeach
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>S</th>
                        <th>W</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Total</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Average</th>
                        <th style="writing-mode: sideways-lr; text-orientation:mixed">Position</th>
                    </tr>
                </tfoot>
            </table>
            <br><br>
            <div class="row text-center">
                <div class="col-md-6">
                    <p>_______________________________</p>
                    <p>Class Teacher</p>
                </div>
                <div class="col-md-6">
                    <p>_______________________________</p>
                    <p>Principal</p>
                </div>
            </div>
        </div>
    </div>   
</div>
<script type="text/javascript">
</script>
