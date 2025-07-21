@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary" id="content-panel">
        <div class="panel-heading">
            Teacher Detail Filters
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 filter-box-first">
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
                                <label for="admission_number">Given Name</label>
                                <input type="text" name="admission_number" id="admission_number" class="form-control">
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
                    <h3>Time</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select class="form-control" id="civil_status" name="civil_status">
                                    <option value="0"></option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 filter-box-next">
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
                                <label for="address">Temporary Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="town">Telephone</label>
                                <input type="text" class="form-control" id="town" name="town">
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
                <div class="col-md-2 filter-box-last">
                    <h3>Job</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="appointment_category">Category of Appointment</label>
                                <select class="form-control" id="appointment_category" name="appointment_category">
                                    <option value="0"></option>
                                    <option value="Permanent">Permanent</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Temporary">Temporary</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="appointment_date">Date of Appointment</label>
                                <input type="text" class="form-control" id="appointment_date" name="appointment_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="appointment_date_this_school">Date of Appointment (This School)</label>
                                <input type="text" class="form-control" id="appointment_date_this_school" name="appointment_date_this_school">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="appointment_subject">Subject of Appointment</label>
                                <input type="text" class="form-control" id="appointment_subject" name="appointment_subject">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 filter-box-last">
                    <h3>Edu. Qualification</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="highest_education_qualification">Highest Education Qualification</label>
                                <input type="text" class="form-control" id="highest_education_qualification" name="highest_education_qualification">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="highest_professional_qualification">Highest Professional Qualification</label>
                                <input type="text" class="form-control" id="highest_professional_qualification" name="highest_professional_qualification">
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
        url: "{{url('/report/teacher')}}",
        type: 'POST',
        data: {
            first_name: $("#first_name").val(),
            surname: $("#surname").val(),
            other_name: $("#other_name").val(),
            admission_number: $("#admission_number").val(),
            given_name: $("#house_id").val(),
            date_of_birth_from: $("#date_of_birth_from").val(),
            date_of_birth_to: $("#date_of_birth_to").val(),
            id_number: $("#id_number").val(),
            gender: $("#gender").val(),
            address: $("#address").val(),
            temporary_address: $("#temporary_address").val(),
            town: $("#town").val(),
            civil_status: $("#civil_status").val(),
            distance: $("#distance").val(),
            transport_id: $("#transport_id").val(),
            appointment_category: $("#appointment_category").val(),
            appointment_date: $("#appointment_date").val(),
            appointment_date_this_school: $("#appointment_date_this_school").val(),
            appointment_subject: $("#appointment_subject").val(),
            highest_education_qualification: $("#highest_education_qualification").val(),
            highest_professional_qualification: $("#highest_professional_qualification").val()
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
        $('#appointment_date_this_school').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#appointment_date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
@endsection

