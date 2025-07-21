@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">New Student Disobedience</div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{ url('discipline/student/'. $disobey->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="admission_number" class="control-label">Student Admission Number</label>
                                    <input id="admission_number" type="text" class="form-control" name="admission_number" required value="{{ $student->admission_number}}">
                                    <p class="help-block"><a href="#"  onclick="getStudent()">Find the student</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="disobedience_id" class="control-label">Disobedience</label>
                                    <select name="disobedience_id" id="disobedience_id" class="form-control">
                                        @foreach ($disobediences as $item)
                                            <option {{$item->id==$disobey->disobedience_id?"selected":""}} value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date" class="control-label">Date</label>
                                    <input id="date" type="text" class="form-control" name="date" value="{{$disobey->date}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="charge_sheet_number" class="control-label">Charge Sheet Number</label>
                                    <input id="charge_sheet_number" type="text" class="form-control" name="charge_sheet_number" value="{{$disobey->charge_sheet_number}}">
                                    <p class="help-block">Charge sheet number is not mandatory.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea id="remark" type="text" class="form-control" name="remark">{{$disobey->remark}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6" id="student_info">
           
        </div>
    </div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    
});
$(function(){
    $("#date").datepicker({
            dateFormat: 'yy-mm-dd',
    });
});
function getStudent(){
    var id = $("#admission_number").val();
    $.get('{{url('discipline/student/getinfo?id=')}}' + id, function(result){
        $("#student_info").html(result);
    });
}
</script>
@endsection
