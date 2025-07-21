<table class="table table-compact">
    <tr>
        <th>Name</th>
        @foreach ($subjects as $subject)
            <th class="text-center">{{$subject->name}}({{$subject->language->name}})</th>
        @endforeach
        <th>H-Count</th>
    </tr>
    @foreach ($students as $student_key => $student)
        <tr>
            <td>{{$student->admission_number}} - {{$student->fullName}}</td>
            @php $i=0; @endphp
            @foreach ($subjects as $subject_key => $subject)
                @php
                    $mark = \App\ExamMark::where('exam_id',$exam->id)->where('student_id',$student->id)->where('subject_id',$subject->id)->first();
                    if($mark==null){
                        $mark = '';
                    }
                    elseif($mark->is_absent==1){
                        $mark = "AB";
                        $i++;
                    }
                    else{
                        $mark = $mark->mark;
                        $i++;
                    }
                @endphp
                <td class="text-center"><input  data-toggle="tooltip" readonly="readonly" title="{{$student->admission_number}}/{{$subject->name}}({{$subject->language->name}})" class="stored" size="25px" type="text" onchange="update(this)" name="mark[{{$student->id}}][{{$subject->id}}]" data-id="{{$student->id}}|{{$exam->id}}|{{$subject->id}}" id="{{$subject_key}}-{{$student_key}}" placeholder="{{$student->admission_number}}/{{$subject->name}}({{$subject->language->name}})" value="{{$mark}}"></td>
            @endforeach
            <td>{{$i}}</td>
        </tr>
    @endforeach
</table>
<hr>
<table class="table table-bordered" style="width:150px;">
    <tr>
        <th>Subject</th>
        <th>Count</th>
    </tr>
    @foreach ($subjects as $subject)
    <tr>
        <td>
            {{$subject->name}}({{$subject->language->name}})
        </td>
        <td>
            @php
                $mark = \App\ExamMark::where('exam_id',$exam->id)->where('subject_id',$subject->id)->where('class_room_id',$class_room->id)->count();
                echo $mark;
            @endphp
        </td>
    </tr>
    @endforeach
</table>