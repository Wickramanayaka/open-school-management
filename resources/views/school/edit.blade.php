@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('school.update',$school->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Edit School Basic Data
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="{{$school->name}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" required value="{{$school->telephone}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail Address" required value="{{$school->email}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Address" required>{{$school->address}}</textarea>
                        </div>
                </div>
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="anthem">Anthem</label>
                            <textarea class="form-control" id="date_of_birth" name="anthem" placeholder="Anthem">{{$school->anthem}}</textarea>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                        <div class="form-group">
                            <label for="logo_file">Logo</label>
                            <input type="file" id="logo_file" name="logo_file" accept="image/*">
                            <p class="help-block">Allowed file extensions png, jpg, gif, tiff. Maximum upload size 1MB.</p>
                        </div>
                </div>
                <div class="col-lg-4">
                        <div class="form-group">
                            <label for="flag_file">Flag</label>
                            <input type="file" id="flag_file" name="flag_file" accept="image/*">
                            <p class="help-block">Allowed file extensions png, jpg, gif, tiff. Maximum upload size 1MB.</p>
                        </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="anthem_file">Anthem</label>
                        <input type="file" id="anthem_file" name="anthem_file" accept="audio/*">
                        <p class="help-block">Allowed file extensions mp3, mp4. Maximum upload size 5MB.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-default">Clear</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection