@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <a href="{{route('student.show',$student->id)}}"><i class="fa fa-arrow-left fa-lg fa-fw" style="color:#fff;"></i></a> Choose subjects for {{$student->fullName}}
            </div>
            <div class="panel-body">
                @include('partials.alert')
                <form action="{{route('student.postLearn',$student->id)}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id[]" id="" multiple class="form-control select2">
                        @foreach ($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->code}} - {{$subject->name}} ({{$subject->language->name}})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="panel-footer">
                <table class="table table-compact">
                    <tr>
                        <th>Subject</th>
                        <th></th>
                        @foreach ($student_subjects as $item)
                            <tr>
                                <td>{{$item->subject->code}} - {{$item->subject->name}} ({{$item->subject->language->name}})</td>
                                <td>
                                    <form action="{{route('student.deleteLearn',[$student->id,$item->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(function(){
        $(".select2").select2({
            theme: 'bootstrap'
        });
    })
</script>
@endsection