@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('partials.alert')
            <form action="{{route('parents.index')}}">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Filters
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-md-6 filter-box-first">
                            <h3>Name</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 filter-box-last">
                            <h3>Telephone</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="telephone">Telephone</label>
                                        <input type="text" name="telephone" id="telephone" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Locate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Parent mobile app users &nbsp; &nbsp; <a class="btn btn-warning" href="{{ route('parents.create') }}">Create new user</a>
                </div>
                <div class="panel-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>#</th><th>Telephone</th><th>Name</th><th>Role</th><th>Suspended</th><th>Date</th><th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-{{$user->suspended==0?"":"warning"}}">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->telephone}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->relation}}</td>
                                    <td>{{$user->suspended==0?"NO":"YES"}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{route('parents.view', $user->id)}}" class="btn btn-primary"><i class="fa fa-info fa-fw"></i></a>
                                        <a href="{{route('parents.destroy', $user->id)}}" class="btn btn-{{$user->suspended==0?"danger":"success"}}"><i class="fa fa-ban fa-fw"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    {{ $users->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('parents::parents.payment_create_partial')
@endsection
@section('javascript')
    <script>
        $(".payment").on('click', function(){
           var id = $(this).prop('value');
           var url = "{{url('/parents')}}/" + id + "{{'/createPayment'}}";
           $.get(url, function(data){
               console.log(data);
               $('#modal_name').html(data.data.name);
               $('#modal_telephone').html(data.data.telephone);
               $('#modal_p_date').html(data.data.date);
               $('#modal_e_date').html(data.data.expiry);
               $('#modal_amount').html(data.data.amount);
               $('#modal_user_id').val(data.data.id);
           });
        });
    </script>
@endsection