@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Term Data
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{route('term.store')}}">
                    {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="academic_year_id">Academic Year</label>
                                        <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                            @foreach ($years as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="start">Start Date</label>
                                        <input type="text" class="form-control" id="start" name="start" placeholder="Start" required value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="end">End Date</label>
                                        <input type="text" class="form-control" id="end" name="end" placeholder="End" required value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="number_of_days">Number of Days</label>
                                        <input type="number" class="form-control" id="number_of_days" name="number_of_days" placeholder="Days" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="sequence">Sequence</label>
                                        <input type="number" class="form-control" id="sequence" name="sequence" placeholder="Sequence" required>
                                    </div>   
                                </div>
                            </div>    
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table class="table table-compact">
                        <tr class="alert-warning">
                            <th>Code</th><th>Name</th><th>Year</th><th>Start</th><th>End</th><th>Days</th><th>Sequence</th><th></th>
                        </tr>
                        @foreach ($terms as $term)
                        <tr>
                            <td>{{$term->code}}</td>
                            <td>{{$term->name}}</td>
                            <td>{{$term->academic_year->name}}</td>
                            <td>{{$term->start}}</td>
                            <td>{{$term->end}}</td>
                            <td>{{$term->number_of_days}}</td>
                            <td>{{$term->sequence}}</td>
                            <td>
                                <form action="{{route('term.destroy',$term->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-primary" href="{{route('term.edit',$term->id)}}"><i class="fa fa-edit"></i></a>
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
@endsection
@section('javascript')
<script>
    $("#start").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end").datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>
@endsection