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
            <img src="{{url('images/profiles/students/') . '/' . $student->photo}}" style="width: 100%; display:block; margin: 0 auto;">
            <div class="container">
            <h3>{{$student->first_name}} {{$student->other_name}}<br><small>{{$student->address->address}}</small></h3>
            <p>Date of Birth : <b> {{$student->date_of_birth}}</b><br>
            Admission No. : <b> {{$student->admission_number}}</b><br>
            Present Class : <b> {{$student->present_class_room_id==null? 'Not found': $student->present_class_room->name}}</b>
            @if($student->is_left==0)
                <div class="label label-success">
                    Active
                </div>
            @else
                <div class="label label-danger">
                    Inactive
                </div>
            @endif
            </p>
            </div>
            <div class="card-footer">
            <a href="{{route('student.edit',$student->id)}}"><b>EDIT BASIC INFO</b></a>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab"><i class="fa fa-info fa-fw"></i> Basic Info</a></li>
            <li role="presentation"><a href="#family" onclick="get_student_parents()" aria-controls="family" role="tab" data-toggle="tab"><i class="fa fa-users fa-fw"></i> Family</a></li>
            <li role="presentation"><a href="#emergency" aria-controls="emergency" role="tab" data-toggle="tab"><i class="fa fa-phone fa-fw"></i> Emergency Contact</a></li>
            <li role="presentation"><a href="#educational" aria-controls="educational" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap fa-fw"></i> Educational</a></li>
            <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab"><i class="fa fa-money fa-fw"></i> Payment</a></li>
            <li role="presentation"><a href="#log" aria-controls="log" role="tab" data-toggle="tab"><i class="fa fa-sticky-note fa-fw"></i> Sports and Society</a></li>
            <li role="presentation"><a href="#duty" aria-controls="duty" role="tab" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> Duty</a></li>
            @if (view()->exists("discipline::students.discipline"))<li role="presentation"><a href="#discipline" aria-controls="discipline" role="tab" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> Discipline</a></li>@endif
        </ul>
                            
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="basic">
                @include('partials.students.basic_info')
            </div>
            <div role="tabpanel" class="tab-pane" id="family">
                @include('partials.students.family')

            </div>
            <div role="tabpanel" class="tab-pane" id="emergency">
                @include('partials.students.emergency_contact')
            </div>
            <div role="tabpanel" class="tab-pane" id="educational">
                @include('partials.students.educational')
            </div>
            <div role="tabpanel" class="tab-pane" id="payment">
                @include('partials.students.payment')
            </div>
            <div role="tabpanel" class="tab-pane" id="log">
                <studentlog student-id="{{$student->id}}"></studentlog>
            </div>
            <div role="tabpanel" class="tab-pane" id="duty">
                <studentduty student-id="{{$student->id}}"></studentduty>
            </div>
            @if (view()->exists("discipline::students.discipline"))
                <div role="tabpanel" class="tab-pane" id="discipline">
                    @include('discipline::students.discipline')
                </div>
            @endif
        </div>
    </div>
</div>
@include('partials.students.photo_upload')     
@include('partials.students.leave')           
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $("#date_left").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });   
});
function get_student_parents(){
    // // Get parents info once the family tab click
    // $.get("{{route('student.parents',$student->id)}}", function(data){
    //     $('#family').html(data);
    // });
}
$(function(){
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');
});

function getReport(student_id,exam_id){
    //alert(student_id + exam_id)
    $("#loader").show();
    $.ajax({
        url: "{{route('examMark.getReport')}}",
        type: 'POST',
        data: {
            'student_id': student_id,
            'exam_id' : exam_id
        },
        success: function(get_data){
            $("#ajax-data").html(get_data);
        },
        error: function(error){
            alert("Error occured, please try again...");
        },
        complete: function(){
            $("#loader").hide();
            $("#report-modal").modal('show');
        }
    });
}
</script>    
@endsection
    
