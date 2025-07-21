@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Examination Detail Filters
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 filter-box-first">
                    <h3>Sections</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select class="form-control" id="grade_id" name="grade_id" required>
                                    <option value=0></option>
                                    @foreach ($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="classroom">Class Room</label>
                                <select class="form-control select2" multiple id="classroom_id" name="classroom_id[]">
                                    <option value=0></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 filter-box-last">
                    <h3>Selections</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exam">Examination</label>
                                <select class="form-control"  id="exam_id" name="exam_id" required>
                                    @foreach ($exams as $exam)
                                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rank_from">Rank From</label>
                                <input type="number" class="form-control" id="rank_from" name="rank_from" placeholder="Rank" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rank_to">Rank To</label>
                                <input type="number" class="form-control" id="rank_to" name="rank_to" placeholder="Rank" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Get Report</button>
                    <button type="reset" class="btn btn-primary" id="btnReset">Clear</button>
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
                            <li><a href="#" onclick="export_table()"><i class="fa fa-download fa-fw"></i></a></li>
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
        url: "{{url('/report/exam')}}",
        type: 'POST',
        data: {
            grade: $("#grade_id").val(),
            class_room: $("#classroom_id").val(),
            exam: $("#exam_id").val(),
            rank_from: $("#rank_from").val(),
            rank_to: $("#rank_to").val()
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
    function export_table(){
        $("#data-table").tableToCSV();
    }     
    $(document).ready(function(){
        $('.select2').select2();
    });
    $("#btnReset").click(function(){
        $(".select2").val(null).trigger("change");
    });

    $('#grade_id').on('change', function(){
        $.get("{{route('report.get_class')}}" + "?grade_id=" + $('#grade_id').val(),function(data){
            $('#classroom_id').html("");
            $('#classroom_id').append('<option value="0"></option>')
            for(var i=0; i<data.length; i++ ){
                $('#classroom_id').append('<option value=' + data[i].id + '>' + data[i].name + '</option>')
            }
        });
    });
</script>
@endsection

