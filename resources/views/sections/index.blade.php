@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Section
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                    @include('partials.alert')
                    <form method="POST" action="{{route('section.store')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="code">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                        <p class="text-danger"></p>
                                    </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Grades</label>
                                    <select  class="form-control select2" multiple id="grade_id[]" name="grade_id[]" required>
                                        @foreach ($grades as $grade)
                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="name">Section Head</label>
                                    <select  class="form-control" id="teacher_id" name="teacher_id">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-6">

                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="alert-warning"><th>Name</th><th>Grades</th><th>Section Head</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sections as $section)
                                        <tr>
                                            <td>{{$section->name}}</td>
                                            <td>
                                                {{$section->grades->implode('name',',')}}
                                            </td>
                                            <td>
                                            <a href="{{route('teacher.show',$section->teacher->id)}}">{{$section->teacher->fullname}}</a>
                                            </td>
                                            <td>
                                                <form action="{{route('section.destroy',$section->uid)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <a class="btn btn-primary" href="{{route('section.edit',$section->uid)}}"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function(){
        $('.select2').select2({
            
        });
    })
</script>
@endsection