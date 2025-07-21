@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                        Teachers
                </div>
                {{-- These features have been moved to report module --}}
                {{--<div class="col-lg-6">
                        <ul class="nav navbar-nav navbar-right tool-bar">
                            <li><a href="{{route('teacher.download')}}"><i class="fa fa-download"></i></a></li>
                            <li><a href="#" onclick="print_table()"><i class="fa fa-print"></i></a></li>
                        </ul>
                </div>--}}
            </div>
        </div>
        <div class="panel-body">
            <div>
                <form method="GET" action="{{route('teacher.index')}}">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name, Id Number, telephone, email..." value="{{isset($parameter)?$parameter:''}}">
                                <div class="input-group-addon"><a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-search"></i></a></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <table class="table" id="data-table">
                <tr class="warning">
                    <th>&nbsp;</th>
                    <th>Teacher Number</th>
                    <th>ID Number</th>
                    <th>Full Name</th>
                    <th>Class</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>E-Mail</th>
                </tr>
                @foreach ($teachers as $teacher)
            <tr class="{{getActiveColor($teacher->is_left)}}">
                    <td>
                        <a href="{{route('teacher.show',$teacher->id)}}"><img class="img-circle" style="width:35px;" src="{{url('images/profiles/teachers/') ."/" . $teacher->photo}}" /></a>
                    </td>
                    <td>{{$teacher->admission_number}}</td>
                    <td>{{$teacher->id_number}}</td>
                    <td><a href="{{route('teacher.show',$teacher->id)}}">{{$teacher->fullName}}</a></td>
                    <td>{{$teacher->present_class_room->name}}</td>
                    <td>{{$teacher->address->address}}</td>
                    <td>{{$teacher->telephone}}</td>
                    <td>{{$teacher->email}}</td>
                    </tr>
                @endforeach
                
            </table>
            {{ $teachers->appends(['name' => $parameter])->links()}}
        </div>
    </div>
<a href="{{route('teacher.create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>
@endsection
@section('javascript')
<script>
function print_table(){
    var tableToPrint = document.getElementById("data-table");
    newWin = window.open();
    newWin.document.write('<link href="{{ asset("css/app.css") }}" rel="stylesheet">');
    newWin.document.write(tableToPrint.outerHTML);
    newWin.print();
    newWin.close();
}    
</script>
@endsection