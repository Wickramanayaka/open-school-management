@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Create Permission
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{ route('permission.store') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="role_id" class="control-label">Role</label>
                                <select id="role_id[]" class="form-control select2" multiple name="role_id[]" required>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="permission_id" class="control-label">Permission</label>
                                <select id="permission_id[]" class="form-control select2" multiple name="permission_id[]" required>
                                    @foreach ($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Permission List
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr class="warning">
                            <td>Role</td><td>Permission</td>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                <div class="row">
                                @foreach ($role->permissions()->get() as $item)
                                    <div class="col-lg-2">
                                        <form action="{{route('permission.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        <input type="hidden" name="role_id" value="{{$role->id}}">
                                            <button type="submit" class="btn btn-info btn-sm">{{$item->name}} <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                @endforeach
                                </div>
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
        $(document).ready(function(){
            $(".select2").select2({
                theme: 'bootstrap'
            });
        })
    </script>
@endsection