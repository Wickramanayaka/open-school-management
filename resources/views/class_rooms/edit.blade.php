@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Class Room
            </div>
            <div class="panel-body">
                    @include('partials.alert')
            <form method="POST" action="{{route('classRoom.update',$class_room->id)}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">Class Room Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Class Room" required value="{{$class_room->name}}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="grade_id">Grade</label>
                                <select disabled class="form-control" id="grade_id" name="grade_id" required>
                                    @foreach ($grades as $item)
                                <option value="{{$item->id}}" {{$item->id==$class_room->grade->id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="division_id">Division</label>
                                <select disabled class="form-control" id="division_id" name="division_id" required>
                                    @foreach ($divisions as $item)
                                        <option value="{{$item->id}}" {{$item->id==$class_room->division->id?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
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