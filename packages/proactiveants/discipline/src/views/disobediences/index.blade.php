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
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Name</th><th>Description</th><th>Category</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disobeys as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <td>
                                        <form action="{{url('/discipline/disobedience',$item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a class="btn btn-primary" href="{{url('/discipline/disobedience',$item->id)}}/edit"><i class="fa fa-edit"></i></a>
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
    <a style="margin-bottom:60px;" href="{{url('discipline/disobedience/create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>    

@endsection