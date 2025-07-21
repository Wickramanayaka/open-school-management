@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    App user information
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>{{$user->full_name}}  <small>{{$user->relation}}</small></h3>
                            <h3>{{$user->telephone}}</h3>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Admission</th><th>Name</th><th>Class Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td><a href="{{url('/student')."/".$student->id}}">{{$student->admission_number}}</a></td>
                                            <td>{{$student->fullname}}</td>
                                            <td>{{$student->present_class_room->name}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{route('parents.index')}}" class="btn btn-primary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
@endsection