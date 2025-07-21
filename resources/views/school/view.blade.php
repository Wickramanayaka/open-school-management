@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                School Basic Information
            </div>
            <div class="panel-body">
                <table class="table table-no-border">
                    <tr>
                    <td>Name: </td><td>{{$school->name}}</td>
                    </tr>
                    <tr>
                        <td>Address: </td><td><textarea class="form-control" style="height:150px;">{{$school->address}}</textarea></td>
                    </tr>
                    <tr>
                        <td>Telephone: </td><td>{{$school->telephone}}</td>
                    </tr>
                    <tr>
                        <td>Email: </td><td>{{$school->email}}</td>
                    </tr>
                    <tr>
                        <td>Logo: </td><td><a href="{{url('images/profiles/school') . '/' . $school->logo}}"><i class="fa fa-download"></i> Download</a></td>
                    </tr>
                    <tr>
                        <td>Anthem Audio: </td><td><a href="{{url('images/profiles/school') . '/' . $school->anthem_audio}}"><i class="fa fa-download"></i> Download</a></td>
                    </tr>
                    <tr>
                    <td>Anthem: </td><td><textarea class="form-control" style="height:195px;">{{$school->anthem}}</textarea></td>
                    </tr>
                    <tr>
                        <td>Flag: </td><td><a href="{{url('images/profiles/school') . '/' . $school->flag}}"><i class="fa fa-download"></i> Download</a></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
            <a href="{{route('school.edit',$school->id)}}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    Logo
                </div>
                <div class="panel-body">
                        @if($school->logo!=null)
                            <img class="img-responsive" src="{{url('images/profiles/school/') . '/' . $school->logo}}" />
                        @endif
                </div>
            </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Flag
            </div>
            <div class="panel-body">
                    @if($school->flag!=null)
                        <img class="img-responsive" src="{{url('images/profiles/school/') . '/' . $school->flag}}" />
                    @endif
            </div>
        </div>
        <h3>Anthem</h3>
        <audio controls>
            <source src="{{url('images/profiles/school/') . '/' . $school->anthem_audio}}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio> 
    </div>
</div>
@endsection


