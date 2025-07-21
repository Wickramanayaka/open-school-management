@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Examination Basic Data
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                <form method="POST" action="{{route('examination.store')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="exam_category_id" name="exam_category_id" required>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="academic_year_id">Academic Year</label>
                                <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                    @foreach ($academic_years as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="term_id">Term</label>
                                <select class="form-control" id="term_id" name="term_id">
                                    @foreach ($terms as $term)
                                        <option value="{{$term->id}}">{{$term->name}} ({{$term->code}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="start">Start Date</label>
                            <input type="text" class="form-control" id="start" name="start" placeholder="Sart" required value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
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
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Ongoing">Ongoing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="has_rank" value="1" checked> Rank
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="has_grade_average" value="1"> Subject Grade Average
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
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
                <table class="table table-compact">
                    <tr class="bg-warning">
                        <th>Code</th><th colspan="5">Name</th><th>Year</th><th>Term</th><th>Start</th><th>End</th><th>Status</th><th>Rank</th><th>SGA</th><th></th>
                    </tr>
                    @foreach ($exams as $exam)
                        <tr class="{{getExamStatusColor($exam)}}">
                            <td>{{$exam->code}}</td>
                            <td colspan="5">{{$exam->name}}</td>
                            <td>{{$exam->academic_year->name}}</td>
                            <td>{{$exam->term->name}}</td>
                            <td>{{$exam->start}}</td>
                            <td>{{$exam->end}}</td>
                            <td>{{$exam->status}}</td>
                            <td>
                                <input type="checkbox" name="" id="" class="form-control" {{$exam->has_rank?'checked':''}}>
                            </td>
                            <td>
                                <input type="checkbox" name="" id="" class="form-control" {{$exam->has_grade_average?'checked':''}}>
                            </td>
                            <td>
                                <form action="{{route('examination.destroy',$exam->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-primary" href="{{route('examination.edit',$exam->id)}}"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
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
    $(document).ready(function(){
        $('select[name="exam_category_id"]').on('change',function(){
            if(this.value==1){
                $('input[name="has_rank"').prop('checked',true);
            }
            else{
                $('input[name="has_rank"').prop('checked',false);
            }
        });
    });
</script>
@endsection