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
                    <form method="POST" action="{{route('section.update',$section->uid)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}
                        <div class="row">
                            <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="code">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="{{$section->name}}">
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
                                        @if ($section->grades->contains('id',$grade->id))
                                            <option selected value="{{$grade->id}}">{{$grade->name}}</option>
                                        @else
                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                        @endif
                                            
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
                                        @if ($teacher->id==$section->current_section_head)
                                            <option selected value="{{$teacher->id}}">{{$teacher->fullname}}</option>
                                        @else
                                            <option value="{{$teacher->id}}">{{$teacher->fullname}}</option>
                                        @endif
                                            
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