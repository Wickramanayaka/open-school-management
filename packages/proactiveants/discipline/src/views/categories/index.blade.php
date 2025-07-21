@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Disobedience Category
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th><th>Description</th><th>Point Deduct</th><th>Authorized Person</th><th>Critical</th><th></th>
                        </tr>
                        @foreach ($disobeys as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->point_deduct}}</td>
                                <td>
                                    @foreach ($item->roles as $role)
                                        <div class="label label-success">{{$role->name}}</div>   
                                    @endforeach
                                </td>
                                <td>{{$item->is_critical==1?"YES":"NO"}}</td>
                                <td>
                                    <form action="{{url('/discipline/category',$item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a class="btn btn-primary" href="{{url('/discipline/category',$item->id)}}/edit"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>    
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a style="margin-bottom:60px;" href="{{url('discipline/category/create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>    

@endsection