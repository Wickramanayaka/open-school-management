@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('classRoom.transfer')}}">
    {{ csrf_field() }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Student Class Transfer
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="class_room_id">Class</label>
                        <select class="form-control" id="existing_class_room_id" name="existing_class_room_id" placeholder="Class Room Name" required>
                            @foreach ($class_rooms as $class_room)
                        <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <a href="#" class="btn btn-primary" onclick="getStudent()">Get Student</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" autocomplete="off" id="date" name="date" placeholder="Date" required>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="date">Transfer To</label>
                        <select class="form-control" id="class_room_id" name="class_room_id" required>
                            @foreach ($class_rooms as $class_room)
                                <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>      
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="date">Academic Year</label>
                        <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                            @foreach ($academic_years as $academic_year)
                                <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input type="text" class="form-control" id="comment" name="comment" placeholder="Comment" required>
                    </div>
                </div>                     
            </div>

            <div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>
            <div id="ajax-data"></div>
    
        </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Transfer</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('javascript')
<script>
    $(document).ready(function(){
        $("#date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

    function getStudent(){
        $("#loader").show();
        $.ajax({
            url: "{{route('classRoom.getStudent')}}",
            type: 'POST',
            data: {
                'class_room_id': $('#existing_class_room_id').val()
            },
            success: function(get_data){
                $("#ajax-data").html(get_data);
            },
            error: function(error){
                alert("Error occured, please try again...");
            },
            complete: function(){
                $("#loader").hide();
            }
        });
    }
    // Select all toggle
    function check(){
        $("input").prop('checked',$("#master").prop('checked'));
    }
</script>
@endsection