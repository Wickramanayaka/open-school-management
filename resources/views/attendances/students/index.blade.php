@extends('layouts.app')
@section('content')
<form id="main-form" method="POST" action="{{route('studentAttendance.find')}}" enctype="multipart/form-data">
    {{ csrf_field() }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Student Attendance View
        </div>
        <div class="panel-body">
        
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="class_id" >Class Room</label>
                        <select class="form-control" id="class_room_id" name="class_room_id" placeholder="Class Room Name">
                            @foreach ($class_rooms as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>
            <div id="ajax-data">

            </div>
        </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Find</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
            </div>
        </div>
    </div>
</form>
<a style="margin-bottom:60px;" href="{{route('studentAttendance.create')}}" class="float"><i class="fa fa-calendar btn-float"></i></a>    
{{-- This function has not been QA, therefore temparary desabled --}}
{{--<a href="{{route('studentAttendance.bulk')}}" class="float"><i class="fa fa-upload btn-float"></i></a>--}}
@endsection
@section('javascript')
<script>
$("#main-form").submit(function(e){
    e.preventDefault();
    $("#loader").show();

    var class_room_id = $("#class_room_id").val();

    $.ajax({
    url: "{{route('studentAttendance.find')}}",
    type: 'POST',
    data: {
        'class_room_id': class_room_id,
    },
    success: function(get_data){
        $("#ajax-data").html(get_data);
        console.log(get_data);
    },
    error: function(error){
        alert("Error occured, please try again...");
    },
    complete: function(){
        $("#loader").hide();
    }
    });
});
</script>    
@endsection