<div class="row">   
    <div class="col-lg-6">
        <div class="card" style="margin-bottom:30px;">
                <div class="top-right">
                    <a href="#" data-toggle="modal" data-target="#photo-modal"><i class="fa fa-camera fa-lg"></i></a>
                </div>
        <img src="{{url('images/profiles/students/') . '/' . $student->photo}}" style="width: 100%; display:block; margin: 0 auto;">
        <div class="container">
        <h3>{{$student->nameWithInitials}}<br><small>{{$student->address->address}}</small></h3>
        <p>Date of Birth : <b> {{$student->date_of_birth}}</b><br>
        Admission No. : <b> {{$student->admission_number}}</b><br>
        Present Class : <b> {{$student->present_class_room_id==null? 'Not found': $student->present_class_room->name}}</b>
        @if($student->is_left==0)
            <div class="label label-success">
                Active
            </div>
        @else
            <div class="label label-danger">
                Inactive
            </div>
        @endif
        </p>
        </div>
        <div class="card-footer">
        <a href="{{route('student.show',$student->id)}}"><b>GO TO PROFILE</b></a>
        </div>
    </div>
</div>
    
