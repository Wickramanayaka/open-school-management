@extends('layouts.app')
@section('content')
<form method="POST" action="#" id="main-form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Student Info
        </div>
        <div class="panel-body">
            <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="admission_number">Admission No.</label>
                            <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="Admission No.">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                    
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="other_name">Oher Name</label>
                        <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Other Name">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select class="form-control" id="grade_id" name="grade_id">
                            <option value=0></option>
                            @foreach ($grades as $grade)
                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                        <div class="form-group">
                            <label for="division_id">Division</label>
                            <select class="form-control" id="division_id" name="division_id">
                                <option value=0></option>
                                @foreach ($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-3">
                            <div class="form-group">
                                <label for="town">Town</label>
                                <input type="text" class="form-control" id="town" name="town" placeholder="Town/Post Office">
                            </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="range">Range (Km)</label>
                                <input type="text" class="form-control" id="range" name="range" placeholder="Range (Km)">
                            </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="house_id">House</label>
                                <select class="form-control" id="house_id" name="house_id">
                                    <option value=0></option>
                                    @foreach ($houses as $house)
                                        <option value="{{$house->id}}">{{$house->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="cluster_id">Cluster</label>
                                <select class="form-control" id="cluster_id" name="cluster_id">
                                    <option value=0></option>
                                    @foreach ($clusters as $cluster)
                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-3">
                            <div class="form-group">
                                <label for="admitted_academic_year_id">Admitted Year</label>
                                <select class="form-control" id="admitted_academic_year_id" name="admitted_academic_year_id">
                                    <option value=0></option>
                                    @foreach ($academic_years as $academic_year)
                                        <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="student_left" id="student_left" value="1"> Include students who left the school.
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Find</button>
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
                    Student List
                </div>
                {{-- These features have been moved to report module --}}
                {{--<div class="col-lg-6">
                    <ul class="nav navbar-nav navbar-right tool-bar">
                        <li><a href="{{route('student.download')}}"><i class="fa fa-download"></i></a></li>
                        <li><a href="#" onclick="print_table()"><i class="fa fa-print"></i></a></li>
                    </ul>
                </div>--}}
            </div>
        </div>
        <div class="panel-body" >
            <div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>
            <div id="ajax-data"></div>
        </div>
    </div>
<a href="{{route('student.create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>
@endsection

@section('javascript')
<script>
    $("#main-form").submit(function(e){
        e.preventDefault();
        $("#loader").show();
        var admission_number = $("#admission_number").val();
        var surname = $("#surname").val();
        var first_name = $("#first_name").val();
        var other_name = $("#other_name").val();
        var house_id = $("#house_id").val();
        var cluster_id = $("#cluster_id").val();
        var grade_id = $("#grade_id").val();
        var division_id = $("#division_id").val();
        var admitted_academic_year_id = $("#admitted_academic_year_id").val();
        var town = $("#town").val();
        var range = $("#range").val();
        var student_left = $('#student_left').is(':checked')?1:0;
        $.ajax({
        url: "{{route('student.getstudent')}}",
        type: 'POST',
        data: {
            'admission_number': admission_number,
            'surname': surname,
            'first_name': first_name,
            'other_name': other_name,
            house_id: house_id,
            cluster_id: cluster_id,
            grade_id: grade_id,
            division_id: division_id,
            admitted_academic_year_id: admitted_academic_year_id,
            'town': town,
            'range': range,
            'student_left': student_left
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

    function print_table(){
        var tableToPrint = document.getElementById("data-table");
        newWin = window.open();
        newWin.document.write('<link href="{{ asset("css/app.css") }}" rel="stylesheet">');
        newWin.document.write(tableToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }    
</script>
@endsection

