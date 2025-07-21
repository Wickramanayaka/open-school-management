@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Subject Basic Data
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                <form method="POST" action="{{route('subject.update',$subject->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required placeholder="Code" value="{{$subject->code}}">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Name" value="{{$subject->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description" required>{{$subject->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="grade_id">Grade</label>
                                <select class="form-control" id="grade_id" name="grade_id">
                                    @foreach ($grades as $item)
                                    <option value="{{$item->id}}" {{$item->id==$subject->grade->id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="language_id">Medium</label>
                                <select class="form-control" id="ganguage_id" name="language_id">
                                    @foreach ($languages as $item)
                                        <option value="{{$item->id}}" {{$item->id==$subject->language_id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="compulsory" value="1" {{$subject->compulsory==1?'checked':''}}> Compulsory
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="duration">Number of minutes for a week</label>
                                <input type="number" class="form-control" name="duration" id="duration" value="{{$subject->duration}}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-primary">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection