@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Syllabus
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Code</th><th>Name</th><th>Language</th><th>Grade</th><th>Chapters</th>
                        </tr>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{$subject->code}}</td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->language->name}}</td>
                                <td>{{$subject->grade==null?'':$subject->grade->name}}</td>
                            <td><a href="{{url("/chapter/$subject->id/create")}}">Get Chapters</a></td>
                            </tr>    
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection