<form action="{{route('examMark.delete')}}" method="POST">
{{ csrf_field() }}
<table class="table table-compact">
    <tr>
        <th>
            <input type="checkbox" name="master" id="master" onclick="check()"> Delete
        </th>
        <th>Name</th><th>Subject</th><th>Mark</th><th>Absent</th>
    </tr>
    @foreach ($marks as $mark)
        <tr>
            <td><input type="checkbox" class="slave" value="{{$mark->id}}" name="mark_id[]" id="mark_id[]"></td>
            <td>{{$mark->student->admission_number}} - {{$mark->student->fullName}}</td>
            <td>{{$mark->subject->code}} - {{$mark->subject->name}} ({{$mark->subject->language->name}})</td>
            <td class="text-right">{{$mark->mark}}</td>
            <td>{{$mark->is_absent==1?'YES':''}}</td>
        </tr>
    @endforeach
</table>
<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
</form>