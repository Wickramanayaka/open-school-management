@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    User Pin Code
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Admission Number</th><th>Name</th><th>Email</th><th>PIN</th>{{--<th>Token</th>--}}
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->teacher->admission_number}}</td>
                                <td>{{$user->teacher->fullName}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->teacher_id > 0)
                                        {{$user->pin_code}} <a href="{{url("/pincode/$user->id/edit")}}"><i class="fa fa-edit fa-fw"></i></a>
                                    @endif
                                </td>
                                {{--<td>{{$user->api_token}}</td>--}}
                            </tr>    
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection