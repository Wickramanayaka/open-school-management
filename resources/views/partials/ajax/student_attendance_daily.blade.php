<div class="row">
    <div class="col-lg-12">
        <table class="table table-compact">
            <tr>
                <th>Admission Number</th>
                <th>Name</th>
                <th>Class Room</th>
                <th>
                    <input type="checkbox" name="master" id="master" onclick="check()"> Present
                </th>
            </tr>
            @foreach ($students as $student)
                <tr>
                    <td>{{$student->admission_number}}</td>
                    <td><a href="{{route('student.show',$student->id)}}">{{$student->fullName}}</a></td>
                    <td>{{$student->present_class_room->name}}</td>
                    <td>
                    <input type="checkbox" class="slave" value="{{$student->id}}" name="present[]" id="present[]">
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>