<div class="row">
    <div class="col-lg-12">
        <table class="table table-compact">
            <tr>
                <th>
                    <input type="checkbox" name="master" id="master" onclick="check()"> Transfer
                </th>
                <th>Admission Number</th>
                <th>Name</th>
                <th>Class Room</th>

            </tr>
            @foreach ($students as $student)
                <tr>
                    <td>
                        <input type="checkbox" class="slave" value="{{$student->id}}" name="student_id[]" id="student_id[]">
                    </td>
                    <td>{{$student->admission_number}}</td>
                    <td><a href="{{route('student.show',$student->id)}}">{{$student->fullName}}</a></td>
                    <td>{{$student->present_class_room->name}}</td>
                    
                </tr>
            @endforeach
        </table>
    </div>
</div>