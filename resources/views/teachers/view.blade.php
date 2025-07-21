@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
            @include('partials.alert')
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card" style="margin-bottom:30px;">
            <div class="top-right">
                <a href="#" data-toggle="modal" data-target="#photo-modal"><i class="fa fa-camera fa-lg"></i></a>
            </div>
        <img src="{{url('images/profiles/teachers/') . "/" . $teacher->photo}}" style="width: 100%; display:block; margin: 0 auto;">
            <div class="container">
            <h3>{{$teacher->nameWithInitials}}</h3>
                <p>
                    Teacher No.: <b>{{$teacher->admission_number}}</b><br>
                Date of Birth : <b> {{$teacher->date_of_birth}}</b><br>
                ID Card : <b> {{$teacher->id_number}}</b><br>
                Class in Charge : <b> {{$teacher->present_class_room->name}}</b> <a href="#" data-toggle="modal" data-target="#data-modal"> <i class="fa fa-edit fa-fw"></i></a>
                @if($teacher->is_left==0)
                    <div class="label label-success">
                        Active
                    </div>
                @else
                    <div class="label label-danger">Inactive</div>
                @endif
            </p>
            </div>
            <div class="card-footer">
            <a href="{{route('teacher.edit',$teacher->id)}}"><b>EDIT BASIC INFO</b></a>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab"><i class="fa fa-info fa-fw"></i> Basic Info</a></li>
            <li role="presentation"><a href="#qualification" aria-controls="qualification" role="tab" data-toggle="tab"><i class="fa fa-certificate fa-fw"></i> Qualification</a></li>
            <li role="presentation"><a href="#experience" aria-controls="experience" role="tab" data-toggle="tab"><i class="fa fa-book fa-fw"></i> Experience</a></li>
            <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><i class="fa fa-calendar fa-fw"></i> Job History</a></li>
            <li role="presentation"><a href="#skill" aria-controls="skill" role="tab" data-toggle="tab"><i class="fa fa-check-circle fa-fw"></i> Talents &amp; Skills</a></li>
            <li role="presentation"><a href="#log" aria-controls="log" role="tab" data-toggle="tab"><i class="fa fa-sticky-note fa-fw"></i> Log</a></li>
            <li role="presentation"><a href="#duty" aria-controls="duty" role="tab" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> Duty</a></li>
        </ul>
                            
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="basic">
                @include('partials.teachers.basic_info')
            </div>
            <div role="tabpanel" class="tab-pane" id="qualification">
                <qualification teacher-id="{{$teacher->id}}"></qualification>
            </div>
            <div role="tabpanel" class="tab-pane" id="experience">
                <experience teacher-id="{{$teacher->id}}"></experience>
            </div>
            <div role="tabpanel" class="tab-pane" id="history">
                <jobhistory teacher-id="{{$teacher->id}}"></jobhistory>
            </div>
            <div role="tabpanel" class="tab-pane" id="skill">
                <skill teacher-id="{{$teacher->id}}"></skill>
            </div>
            <div role="tabpanel" class="tab-pane" id="log">
                <teacherlog teacher-id="{{$teacher->id}}"></teacherlog>
            </div>
            <div role="tabpanel" class="tab-pane" id="duty">
                <teacherduty teacher-id="{{$teacher->id}}"></teacherduty>
            </div>
        </div>
    </div>
</div>
@include('partials.teachers.photo_upload')    
@include('partials.teachers.change_class') 
@include('partials.teachers.resign')        
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#affective_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
</script>    
@endsection