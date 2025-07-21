@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Subject Teacher <span class="pull-right">Academic Year: {{getCurrentAcademicYear()->name}}</span>
            </div>
            <div class="panel-body">
                <table class="table table-compact">
                    @foreach ($subjects as $item)
                        <tr>
                            <td>{{$item->code}} - {{$item->name}} ({{$item->language->name}})</td>
                            <td>
                                @foreach ($item->teachers->unique() as $teacher)

                                @if($teacher->pivot->academic_year_id==getCurrentAcademicYear()->id && $teacher->is_left==0)
                                    <a href="{{route('teacher.show',$teacher->id)}}"><img class="img-circle" src="{{url('images/profiles/teachers/') . '/' . $teacher->photo}}" style="width: 50px; display:in-line; margin: 0 auto;"></a>
                                @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection