@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Filter
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="admission_number">Admission Number</label>
                        <input type="text" class="form-control" autocomplete="off" id="admission_number" name="admission_number" placeholder="Student admission number">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="class_room_id">Class Room</label>
                        <select class="form-control select2" multiple id="class_room_id" name="class_room_id[]">
                            @foreach ($class_rooms as $class_room)
                                <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="grade_id">Grade</label>
                        <select class="form-control select2" multiple id="grade_id" name="grade_id[]">
                            @foreach ($grades as $grade)
                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" autocomplete="off" id="phone" name="phone" placeholder="Phone number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="date_from">From Date</label>
                        <input type="text" class="form-control" autocomplete="off" id="date_from" name="date_from" placeholder="Date">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="date_to">To Date</label>
                        <input type="text" class="form-control" autocomplete="off" id="date_to" name="date_to" placeholder="Date" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <input type="text" class="form-control" autocomplete="off" id="message" name="message" placeholder="Message">
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
        url: "{{url('./sms/report/message')}}",
        type: 'POST',
        data: {
            class_room_id: $("#class_room_id").val(),
            grade_id: $("#grade_id").val(),
            admission_number: $("#admission_number").val(),
            date_from: $("#date_from").val(),
            date_to: $("#date_to").val(),
            phone: $("#phone").val(),
            message: $("#message").val()
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

