@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Student Detail Filters
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 filter-box-first">
                    <h3>Name</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="other_name">Other Name</label>
                                <input type="text" name="other_name" id="other_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control"  id="gender" name="gender">
                                    <option value=0></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 filter-box-next">
                    <h3>ID Numbers</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="admission_number">Admission Number</label>
                                <input type="text" name="admission_number" id="admission_number" class="form-control">
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_of_birth_from">DOB From</label>
                                <input type="text" name="date_of_birth_from" id="date_of_birth_from" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_of_birth_to">DOB To</label>
                                <input type="text" name="date_of_birth_to" id="date_of_birth_to" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_number">ID Number</label>
                                <input type="text" name="id_number" id="id_number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 filter-box-next">
                    <h3>Sections</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="house">House</label>
                                <select class="form-control" id="house_id" name="house_id">
                                    <option value=0></option>
                                    @foreach ($houses as $house)
                                        <option value="{{$house->id}}">{{$house->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cluster">Cluster</label>
                                <select class="form-control" id="cluster_id" name="cluster_id">
                                    <option value=0></option>
                                    @foreach ($clusters as $cluster)
                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                    </div>
                    <div class="row">
                        
                    </div>
                </div>
                <div class="col-md-2 filter-box-next">
                    <h3>Time</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="marks_from">Scholarship Marks From</label>
                                <input type="text" name="marks_from" id="marks_from" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="marks_to">Scholarship Marks To</label>
                                <input type="text" name="marks_to" id="marks_to" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 filter-box-last">
                    <h3>Residents</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="transport">Type of Transport</label>
                                <select class="form-control"  id="transport_id" name="transport_id">
                                    <option value=0></option>
                                    @foreach ($transports as $transport)
                                        <option value="{{$transport->id}}">{{$transport->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="distance">Distance to School</label>
                                <input type="text" class="form-control" id="distance" name="distance">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="town">Home Town</label>
                                <input type="text" class="form-control" id="town" name="town">
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
        url: "{{url('/report/student')}}",
        type: 'POST',
        data: {
            first_name: $("#first_name").val(),
            surname: $("#surname").val(),
            other_name: $("#other_name").val(),
            admission_number: $("#admission_number").val(),
            house_id: $("#house_id").val(),
            cluster_id: $("#cluster_id").val(),
            marks_from: $("#marks_from").val(),
            marks_to: $("#marks_to").val(),
            id_number: $("#id_number").val(),
            gender: $("#gender").val(),
            address: $("#address").val(),
            date_of_birth_from: $("#date_of_birth_from").val(),
            date_of_birth_to: $("#date_of_birth_to").val(),
            transport_id: $("#transport_id").val(),
            distance: $("#distance").val(),
            town: $("#town").val()
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
    $(document).ready(function(){
        $('.select2').select2();
        $('#date_of_birth_to').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#date_of_birth_from').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
@endsection

