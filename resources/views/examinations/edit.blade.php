@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Examination Basic Data
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                <form method="POST" action="{{route('examination.update',$exam->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Code" required value="{{$exam->code}}">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="{{$exam->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="exam_category_id" name="exam_category_id" required>
                                    @foreach ($categories as $item)
                                <option value="{{$item->id}}" {{$item->id==$exam->exam_category_id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="academic_year_id">Academic Year</label>
                                <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                    @foreach ($academic_years as $item)
                                        <option value="{{$item->id}}" {{$item->id==$exam->academic_year_id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="term_id">Term</label>
                                <select class="form-control" id="term_id" name="term_id">
                                    @foreach ($terms as $term)
                                        <option value="{{$term->id}}" {{$term->id==$exam->term_id?'selected':''}}>{{$term->name}} ({{$term->code}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="start">Start Date</label>
                            <input type="text" class="form-control" id="start" name="start" placeholder="Sart" required value="{{$exam->start}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="end">End Date</label>
                                <input type="text" class="form-control" id="end" name="end" placeholder="End" required value="{{$exam->end}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Pending" {{$exam->status=='Pending'?'selected':''}}>Pending</option>
                                    <option value="Completed" {{$exam->status=='Completed'?'selected':''}}>Completed</option>
                                    <option value="Ongoing" {{$exam->status=='Ongoing'?'selected':''}}>Ongoing</option>
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="checkbox">
                                <label>
                                <input type="hidden" name="has_rank" value="0">
                                <input type="checkbox" name="has_rank" value="1" {{$exam->has_rank==1?'checked':''}}> Rank
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="has_grade_average" value="0">
                                    <input type="checkbox" name="has_grade_average" value="1" {{$exam->has_grade_average==1?'checked':''}}> Subject Grade Average
                                </label>
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
        'dateFormat': 'yy-mm-dd'
    });
    $("#end").datepicker({
        'dateFormat': 'yy-mm-dd'
    });
    
</script>
@endsection