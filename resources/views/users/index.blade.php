@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                        User
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <table class="table" id="data-table">
                <tr class="warning">
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Teacher</th>
                    <th>Roles</th>
                    <th></th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="{{route('teacher.show',$user->teacher->id)}}">{{$user->teacher->fullName}}</a></td>
                    <td>
                        @foreach ($user->roles as $item)
                            <div class="label label-success">{{$item->name}}</div>   
                        @endforeach
                    </td>
                    <td>
                        @if($user->id<>1)
                        <form action="{{route('user.destroy',$user->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a class="btn btn-primary" href="{{route('user.edit',$user->id)}}"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
<a href="{{route('user.create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>
@endsection