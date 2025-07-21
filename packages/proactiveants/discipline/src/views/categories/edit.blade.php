@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit Disobedience Category</div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{ url('discipline/category/' . $category->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea id="description" type="text" class="form-control" name="description">{{ $category->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="point_deduct" class="control-label">Point Deduct</label>
                                <input id="point_deduct" type="text" class="form-control" name="point_deduct" required value="{{$category->point_deduct}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="point_deduct" class="control-label">Authorized Persons</label>
                                    <select name="role_id[]" id="role_id" multiple class="form-control select2">
                                        @foreach ($roles as $role)
                                            <option {{$category->roles->contains('id',$role->id)?"selected":""}} value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_critical" {{$category->is_critical==1?"checked":""}} value="1"> Critical
                                    </label>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $('.select2').select2();
});
</script>
@endsection
