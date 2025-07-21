@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Parents Detail Filters
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 filter-box-first">
                    <h3>Name</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="parents_name" id="parents_name" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 filter-box-next">
                    <h3>ID Numbers</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_number">ID Number</label>
                                <input type="text" name="id_number" id="id_number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 filter-box-next">
                    <h3>Job</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select name="designation" id="designation" class="form-control">
                                    <option value="">Please Select</option>
                                    @foreach ($occupations as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="designation_type">Designation Type</label>
                                <select class="form-control" id="designation_type" name="designation_type">
                                    <option value="0"></option>
                                    <option value="Government">Government</option>
                                        <option value="Private">Private</option>
                                        <option value="Own Business">Own Business</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 filter-box-last">
                    <h3>Other</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="income_level">Level of Income</label>
                                <select class="form-control"  id="income_level" name="income_level">
                                    <option value=0></option>
                                    <option value="First Level">First Level</option>
                                    <option value="Second Level">Second Level</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="education_level">Level of Education</label>
                                <select class="form-control" id="education_level" name="education_level">
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="protection_level">Level of Protection</label>
                                <select class="form-control"  id="protection_level" name="protection_level">
                                    <option value=0></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="old_student">Old Boy/Girl</label>
                                <select class="form-control" id="old_student" name="old_student">
                                    <option value="0"></option>
                                    <option value="None">None</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Guardian">Guardian</option>
                                </select>
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
            url: "{{url('/report/parents')}}",
            type: 'POST',
            data: {
                name: $("#parents_name").val(),
                id_number: $("#id_number").val(),
                designation: $("#designation").val(),
                designation_type: $("#designation_type").val(),
                income_level: $("#income_level").val(),
                education_level: $("#education_level").val(),
                protection_level: $("#protection_level").val(),
                old_student: $("#old_student").val()
            },
            success: function(get_data){
                $("#ajax-data").html(get_data);
                $('.datatable').DataTable({
                    'destroy': true,
                    'bPaginate': false,
                    'searching': false,
                    'bInfo': false
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
</script>
@endsection

