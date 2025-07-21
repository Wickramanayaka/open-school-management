@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <a href="{{route('teacher.show',$teacher->id)}}"><i class="fa fa-arrow-left fa-lg fa-fw" style="color:#fff;"></i></a> Choose subjects for {{$teacher->fullName}}
            </div>
            <div class="panel-body">
                @include('partials.alert')
                <table class="table table-compact">
                    <tr>
                        <th>Academic Year</th>
                        <th>Class Room</th>
                        <th>Subject</th>
                        <th></th>
                        @foreach ($subject_teachers as $item)
                            <tr>
                                <td>{{$item->academic_year->name}}</td>
                                <td>{{$item->class_room->name}}</td>
                                <td>{{$item->subject->code}} - {{$item->subject->name}} ({{$item->subject->language->name}})</td>
                                <td>
                                    <form action="{{route('subjectTeacher.destroy',$item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
            <form method="POST" action="{{route('teacher.postTeach',$teacher->id)}}">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="sr-only" for="academic_year_id">Academic Year</label>
                                <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                    @foreach ($academic_years as $academic_year)
                                        @if ($academic_year->id==getCurrentAcademicYear()->id)
                                            <option selected value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                                        @else
                                            <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="sr-only" for="class_room_id">Class Room</label>
                                <select class="form-control select2" multiple="multiple" id="class_room_id[]" name="class_room_id[]" required>
                                    @foreach ($class_rooms as $class_room)
                                        <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
			<div class="col-lg-3">
                            <div class="form-group">
                                <label class="sr-only" for="subject_id">Subject</label>
                                <select class="form-control" id="subject_id" name="subject_id" required>
                                    @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->code}} - {{$subject->name}} ({{$subject->language->name}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(function(){
        $(".select2").select2();
    })
</script>
@endsection
