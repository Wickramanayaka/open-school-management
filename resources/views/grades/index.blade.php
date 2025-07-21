@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <p><b>Instructions:</b><br/></p>
                <ul>
                    <li>Create grade by entering grade name in grade input box and click on Add button.</li>
                    <li>The same way division can be created by entering division name in division name input box and click on Add button.</li>
                    <li>Select grade check box then divsion check box and click on Create Calss in order to combine grade with division and create class room.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-12">
                @include('partials.alert')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Grade
                </div>
                <div class="panel-body">
                <form class="form-inline" method="POST" action="{{route('grade.store')}}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Grade" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <hr/>
                    <table class="table table-striped">
                        @foreach ($grades as $grade)
                            <tr>
                                <td><input type="checkbox" value="{{$grade->id}}" name="grade_list[]" id="grade_list[]"></td>
                                <td>{{$grade->name}}</td>
                                <td class="text-right">
                                    <form action="{{route('grade.destroy',$grade->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a class="btn btn-primary" href="{{route('grade.edit',$grade->id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Division
                </div>
                <div class="panel-body">
                <form class="form-inline" method="POST" action="{{route('division.store')}}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Division" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <hr/>
                    <table class="table table-striped">
                        @foreach ($divisions as $division)
                            <tr>
                            <td><input type="checkbox" value="{{$division->id}}" name="division_list[]" id="division_list[]"></td>
                                <td>{{$division->name}}</td>
                                <td class="text-right">
                                    <form action="{{route('division.destroy',$division->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a class="btn btn-primary" href="{{route('division.edit',$division->id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <a class="btn btn-warning" href="#" onclick="create_class()">Create Class >></a><span class="pull-right">Class Room</span>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr><th>Class</th><th>Grade</th><th>Division</th><th></th></tr>
                        @foreach ($class_rooms as $class_room)
                            <tr>
                                <td>{{$class_room->name}}</td>
                                <td>{{$class_room->grade->name}}</td>
                                <td>{{$class_room->division->name}}</td>
                                <td class="text-right">
                                    <form action="{{route('classRoom.destroy',$class_room->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a class="btn btn-primary" href="{{route('classRoom.edit',$class_room->id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                        {{-- Pagination goes here --}}
                        {{ $class_rooms->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
function create_class(){
    var grade_list = $('input[name="grade_list[]"]:checked').map(function(){
        return this.value;
    }).get();
    var division_list = $('input[name="division_list[]"]:checked').map(function(){
        return this.value;
    }).get();
    $.ajax({
        type: "POST",
        url:'{{route('classRoom.store')}}',
        data: {
            'grade_list[]': grade_list,
            'division_list[]': division_list
        },
        success: function(result){
            $("#ajax-error").html('<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The class room creation has been successfull.</div>');
            alert('The class room creation has been successfull.\nClick Ok to reload the page.')
            location.reload();
        },
        error: function(error){
            $("#ajax-error").html('<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select at least one grade and one division.</div>');
        }
    });
}    
</script>    
@endsection