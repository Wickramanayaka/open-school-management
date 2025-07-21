<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-no-border">
                    <tr><td>Admission Number</td><td>{{$student->admission_number}}</td></tr>
                    <tr><td>Full Name</td><td>{{$student->fullName}} <a href="https://www.linkedin.com/search/results/people/?keywords={{$student->hTTPFormatName}}&origin=GLOBAL_SEARCH_HEADER" target="_blank"><i class="fa fa-linkedin-square"></i></a></td></tr>
                    <tr><td>Address</td><td><a href="https://www.google.com/maps/search/?api=1&query={{$student->address->mapFormat}}" target="_blank"><i class="fa fa-map-marker"></i> {{$student->address->address}}</a></td></tr>
                    <tr><td>Telephone</td><td>{{$student->telephone}}</td></tr>
                    <tr><td>Date of Birth</td><td>{{$student->date_of_birth}}</td></tr>
                    <tr><td>Admitted Date</td><td>{{$student->admitted_date}}</td></tr>
                    <tr><td>Admitted Academic Year</td><td>{{$student->admitted_academic_year->name}}</td></tr>
                    <tr><td>Admitted Class</td><td>{{$student->admitted_class_room->name}}</td></tr>
                    <tr><td>ID Number</td><td>{{$student->idNum}}</td></tr>
                    <tr><td>Gender</td><td>{{$student->gender}}</td></tr>
                    <tr><td>Religion</td><td>{{$student->religion}}</td></tr>
                    <tr><td>Nationality</td><td>{{$student->nationality}}</td></tr>
                    <tr><td>House</td><td>{{$student->house->name}}</td></tr>
                    <tr><td>Cluster</td><td>{{$student->cluster->name}}</td></tr>
                    <tr><td>Type of Transport</td><td>{{$student->transport->name}}</td></tr>
                    <tr><td>Distance to School</td><td>{{$student->distance}}Km</td></tr>
                    <tr><td>Home Town</td><td>{{$student->town}}</td></tr>
                    <tr><td>Scholarship Marks</td><td>{{$student->scholarship_mark}}</td></tr>
                </table>
            </div>
        </div>
            
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                @foreach ($subjects as $item)
                    <div class="label label-success">{{$item->subject->name}} ({{$item->subject->language->name}})</div> 
                @endforeach
                <hr>
                <a href="{{route('student.learn',$student->id)}}" class="btn btn-primary">Choose subjects to learn</a>
            </div>
        </div>
    </div>
</div>   
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                    @if($student->is_left==0)
                        <button class="btn btn-danger" data-toggle="modal" data-target="#leave-modal">Leaving School</button>
                    @else
                        <div class="alert alert-danger">
                            Resigned for {{$student->reason_left}}  on {{$student->date_left}}
                            <a href="#" class="pull-right"><i class="fa fa-print"></i> Print the Leaving Certificate</a>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>   
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="text-danger"><b>DANGER</b></h3>
            </div>
            <div class="panel-body">
                <b>Please read this carefully.</b><br/>
                <h3 class="text-danger">DELETED STUDENT CAN NOT BE RECOVERED. THEREFORE TAKE RESPONSIBILITY FOR YOUR ACTION.</h3>
                <hr>
                <form method="POST" action="{{url('/student/delete/' . $student->id)}}" onsubmit="return confirm('Are you sure you want to delete?');">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div> 
