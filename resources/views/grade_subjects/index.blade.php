@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-3">
        <form method="GET" action="{{route('gradeSubject.index')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">Academic Year</label>
                <select class="form-control" id="academic_year_id" name="academic_year_id">
                    @foreach ($academic_years as $academic_year)
                    @if(isset($academic_year_id) && $academic_year->id==$academic_year_id)
                        <option selected value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                        @else
                        <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">Get Data</button>
        </form>
    </div>
</div>
<hr>
@include('partials.alert')
<div class="row" style="margin-bottom:20px;">
    <div class="col-lg-2">
        <ul class="nav nav-pills nav-stacked">
            @foreach ($grades as $grade)
                <li class="{{$grade->id==1?'active':''}}"><a href="#tab{{$grade->id}}" data-toggle="pill">Grade {{$grade->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="col-lg-10">
        <div class="tab-content">
            @foreach ($grades as $grade)

                <div class="tab-pane {{$grade->id==1?'active':''}}" fade id="tab{{$grade->id}}">
                        <form method="POST" action="{{route('gradeSubject.store')}}">
                            {{ csrf_field() }}
                    <div class="row">
                        @foreach ($subjects as $subject)
                        <?php $i=0; ?>
                        @foreach ($grade->subjects as $item)
                            @if($item->pivot->academic_year_id==$academic_year_id && $item->id==$subject->id)
                            <?php $i=1; break; ?>
                            @endif
                        @endforeach

                        <div class="col-lg-3">
                            <div class="checkbox">
                                <label>
                                    <input {{$i==1?'checked':''}} type="checkbox" name="subject_id[]" id="subject_id[]" value="{{$subject->id}}"><span data-toggle="tooltip" data-placement="top" title="{{$subject->description}}">{{$subject->code}} - {{$subject->name}} ({{$subject->language->name}})</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    <input type="hidden" name="grade_id" value="{{$grade->id}}">
                    
                </div>
                <hr>
                @if($academic_year_id==getCurrentAcademicYear()->id)
                    <button type="submit" class="btn btn-primary">Update</button>
                @endif
                </form>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>
   
@endsection