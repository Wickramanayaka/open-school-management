@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Student Disobedience
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Admission Number</th><th>Full Name</th><th>Class Room</th><th>Date</th><th>Disobedience</th><th class="text-right">Point Deduct</th><th>Teacher</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $item)
                                <tr>
                                    <td>{{$item->student->admission_number}}</td>
                                    <td><a href="{{route('student.show',$item->student->id)}}">{{$item->student->fullName}}</a></td>
                                    <td>{{$item->student->present_class_room->name}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->disobedience->name}}</td>
                                    <td class="text-danger text-right"><b>-{{$item->point_deduct}}</b></td>
                                    <td><a href="{{$item->teacher==null?"#":route('teacher.show',$item->teacher->id)}}">{{$item->teacher==null?"":$item->teacher->fullName}}</a></td>
                                    <td>
                                        <form action="{{url('/discipline/student',$item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a class="btn btn-primary" href="{{url('/discipline/student',$item->id)}}/edit"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a style="margin-bottom:60px;" href="{{url('discipline/student/create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>    
@endsection
