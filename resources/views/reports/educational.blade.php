@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Educational Detail Filters
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
                                    <option value="0"></option>
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
                                <label for="language">Language</label>
                                <select class="form-control"  id="language_id" name="language_id">
                                    @foreach ($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select class="form-control select2" multiple id="subject_id" name="subject_id[]" required>
                                    @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->code}} - {{$subject->name}} ({{$subject->language->name}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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
                                <label for="mark_from">Mark From</label>
                                <input type="number" class="form-control" id="mark_from" name="mark_from" placeholder="Mark" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mark_to">Mark To</label>
                                <input type="number" class="form-control" id="mark_to" name="mark_to" placeholder="Mark" required>
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
        url: "{{url('/report/educational')}}",
        type: 'POST',
        data: {
            subject: $("#subject_id").val(),
            grade: $("#grade_id").val(),
            class_room: $("#classroom_id").val(),
            exam: $("#exam_id").val(),
            mark_from: $("#mark_from").val(),
            mark_to: $("#mark_to").val()
        },
        success: function(get_data){
            $("#ajax-data").html(get_data);
            $('.datatable').DataTable({
                'destroy': true,
                'bPaginate': false,
                'searching': false,
                'bInfo': false,
                'columnDefs':[
                    {'visible': false, 'targets': 0},
                ],
                'order': [[0, 'asc']],
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
        
                    api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                        if ( last !== group ) {
                            var rowData = api.row(i).data();
                            $(rows).eq( i ).before(
                                '<tr class="group"><td colspan="2"><h3>'+group+'</h3></td></tr>'
                            );
        
                            last = group;
                        }
                    } );
                }
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
        $.get("{{route('report.get_subject_medium')}}" + "?grade_id=" + $('#grade_id').val() + "&language_id=" + $('#language_id').val() ,function(data){
            $('#subject_id').html("");
            $('#subject_id').append('<option value="0"></option>')
            for(var i=0; i<data.length; i++ ){
                $('#subject_id').append('<option value=' + data[i].id + '>' + data[i].code + '-' + data[i].name + ' (' + data[i].language.name + ')</option>')
            }
        });
    });
    $('#language_id').on('change', function(){
        $.get("{{route('report.get_subject_medium')}}" + "?grade_id=" + $('#grade_id').val() + "&language_id=" + $('#language_id').val() ,function(data){
            $('#subject_id').html("");
            $('#subject_id').append('<option value="0"></option>')
            for(var i=0; i<data.length; i++ ){
                $('#subject_id').append('<option value=' + data[i].id + '>' + data[i].code + '-' + data[i].name + ' (' + data[i].language.name + ')</option>')
            }
        });
    });
</script>
@endsection

