@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Subject Basic Data
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                <form method="POST" action="{{route('subject.index')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" required placeholder="Code">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="grade_id">Grade</label>
                                <select class="form-control" id="grade_id" name="grade_id">
                                    @foreach ($grades as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="language_id">Medium</label>
                                <select class="form-control" id="ganguage_id" name="language_id">
                                    @foreach ($languages as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="duration">Number of minutes for a week</label>
                                <input type="number" class="form-control" name="duration" id="duration">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="compulsory" value="1"> Compulsory
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="reset" class="btn btn-primary">Clear</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table class="table table-compact datatable">
                        <thead>
                                <tr class="warning">
                                    <th>Code</th><th>Name</th><th>Grade</th><th>Medium</th><th>Minutes</th><th></th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $item)
                                <tr>
                                    <td>{{$item->code}}</td>
                                    @if($item->compulsory)
                                        <td><a href="javascript:void(0)" data-toggle="popover" data-trigger="focus" title="Description" data-placement="left" data-content="{{$item->description}}"><b>{{$item->name}}</b></a></td>
                                    @else
                                        <td><a href="javascript:void(0)" data-toggle="popover" data-trigger="focus" title="Description" data-placement="left" data-content="{{$item->description}}">{{$item->name}}</a></td>
                                    @endif
                                    <td>{{$item->grade->name}}</td>
                                    <td>{{$item->language->name}}</td>
                                    <td>{{$item->duration}}</td>
                                    <td>
                                        <form action="{{route('subject.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a class="btn btn-primary" href="{{route('subject.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- $subjects->links() --}}
                </div>
            </div>
        </div>
    </div>    
@endsection