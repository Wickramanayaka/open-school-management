@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Filter
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="class_room_id">Class Room</label>
                        <select class="form-control select2" multiple id="class_room_id" name="class_room_id[]">
                            @foreach ($class_rooms as $class_room)
                                <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="subject_id">Subject</label>
                        <select class="form-control select2" multiple id="subject_id" name="subject_id[]">
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->code}} - {{$subject->name}}({{$subject->language->name}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="teacher_id">Teacher</label>
                        <select class="form-control select2" multiple id="teacher_id" name="teacher_id[]">
                            @foreach ($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->fullName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="date_from">Week Begin</label>
                        <input type="text" class="form-control" autocomplete="off" id="date_from" name="date_from" placeholder="Date" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="date_to">Week End</label>
                        <input type="text" class="form-control" autocomplete="off" id="date_to" name="date_to" placeholder="Date" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Get Report</button>
                    <button type="reset" class="btn btn-primary">Clear</button>
                </div>
            </div>
        </div>
    </div>
</form>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    Report Data
                </div>
                <div class="col-lg-6">
                        <ul class="nav navbar-nav navbar-right tool-bar">
                            <li><a href="#" onclick="print_table()"><i class="fa fa-print"></i></a></li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="panel-body" >
            <div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>
            <div id="ajax-data"></div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
    $("#main-form").submit(function(e){
        e.preventDefault();
        $("#loader").show();
        $.ajax({
        url: "{{url('./coverage/report/teach')}}",
        type: 'POST',
        data: {
            class_room_id: $("#class_room_id").val(),
            teacher_id: $("#teacher_id").val(),
            subject_id: $("#subject_id").val(),
            date_from: $("#date_from").val(),
            date_to: $("#date_to").val()
        },
        success: function(get_data){
            $("#ajax-data").html(get_data);
            $('.datatable').DataTable({
                'destroy': true,
                'bPaginate': false,
                'searching': false,
                'bInfo': false,
            });
        },
        error: function(error){
            alert("Error occured, please try again...");
        },
        complete: function(){
            $("#loader").hide();
        }
        });
    });

    function print_table(){
        var tableToPrint = document.getElementById("report-content");
        newWin = window.open();
        newWin.document.write('<link href="{{ asset("css/app.css") }}" rel="stylesheet">');
        newWin.document.write(tableToPrint.outerHTML);
    }    
    $(document).ready(function(){
        $('.select2').select2();
    });
    $(function(){
        $("#date_from").datepicker({
                dateFormat: 'yy-mm-dd',
        });
        $("#date_to").datepicker({
                dateFormat: 'yy-mm-dd',
        });
    });
</script>
@endsection

