@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Term Data
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                <form method="POST" action="{{route('term.update',$term->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" required value="{{$term->code}}">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="{{$term->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="academic_year_id">Academic Year</label>
                                        <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                            @foreach ($years as $item)
                                        <option value="{{$item->id}}" {{$item->id==$term->academic_year_id?'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="start">Start Date</label>
                                        <input type="text" class="form-control" id="start" name="start" placeholder="Start" required value="{{$term->start}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="end">End Date</label>
                                        <input type="text" class="form-control" id="end" name="end" placeholder="End" required value="{{$term->end}}">
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="number_of_days">Number of Days</label>
                                        <input type="number" class="form-control" id="number_of_days" name="number_of_days" placeholder="Days" required value="{{$term->number_of_days}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sequence">Sequence</label>
                                        <input type="number" class="form-control" id="sequence" name="sequence" placeholder="Sequence" required value="{{$term->sequence}}">
                                    </div>   
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </form>
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