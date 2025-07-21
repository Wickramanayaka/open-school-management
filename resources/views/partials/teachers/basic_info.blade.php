<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-no-border">
                    <tr>
                        <td>
                            Teacher Number
                        </td>
                        <td>
                            {{$teacher->admission_number}}
                        </td>
                    </tr>
                    <tr>
                    <td>Full Name</td><td>{{$teacher->fullName}} <a href="https://www.linkedin.com/search/results/people/?keywords={{$teacher->hTTPFormatName}}&origin=GLOBAL_SEARCH_HEADER" target="_blank"><i class="fa fa-linkedin-square"></i></a></td>
                    </tr>
                    <tr>
                        <td>Given Name</td><td>{{$teacher->given_name}}</td>
                    </tr>
                    <tr>
                    <td>Address</td><td><a href="https://www.google.com/maps/search/?api=1&query={{$teacher->address->mapFormat}}" target="_blank"><i class="fa fa-map-marker"></i> {{$teacher->address->address}} </a></td>
                    </tr>
                    <tr>
                    <td>Temporary Address</td><td><a href="https://www.google.com/maps/search/?api=1&query={{$teacher->temporaryAddress->mapFormat}}" target="_blank"><i class="fa fa-map-marker"></i> {{$teacher->temporaryAddress->address}} </a></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td><td>{{$teacher->date_of_birth}}</td>
                    </tr>
                    <tr>
                        <td>ID Number</td><td>{{$teacher->id_number}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td><td>{{$teacher->gender}}</td>
                    </tr>
                    <tr>
                        <td>Civil Status</td><td>{{$teacher->civil_status}}</td>
                    </tr>
                    <tr>
                        <td>Telephone</td><td><a href="callto:{{$teacher->telephone}}" target="_top">{{$teacher->telephone}}</a></td>
                    </tr>
                    <tr>
                        <td>E-Mail Address</td><td><a href="mailto:{{$teacher->email}}" target="_top">{{$teacher->email}}</a></td>
                    </tr>
                    <tr>
                        <td>Home Town</td><td>{{$teacher->town}}</td>
                    </tr>
                    <tr>
                        <td>Distance to School</td><td>{{$teacher->distance}}</td>
                    </tr>
                    <tr>
                        <td>Type of Trasport</td><td>{{$teacher->transport->name}}</td>
                    </tr>
                    <tr>
                        <td>Category of Appointment</td><td>{{$teacher->appointment_category}}</td>
                    </tr>
                    <tr>
                        <td>Date of Appointment</td><td>{{$teacher->appointment_date}}</td>
                    </tr>
                    <tr>
                        <td>Date of Appointment (This School)</td><td>{{$teacher->appointment_date_this_school}}</td>
                    </tr>
                    <tr>
                        <td>Subject of Appointment</td><td>{{$teacher->appointment_subject}}</td>
                    </tr>
                    <tr>
                        <td>Highest Education Qualification</td><td>{{$teacher->highest_education_qualification}}</td>
                    </tr>
                    <tr>
                        <td>Highest Professional Qualification</td><td>{{$teacher->highest_professional_qualification}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    @foreach ($subject_teach as $item)
                    {{$item->subject->name}} ({{$item->subject->language->name}}) <span class="badge">{{$item->class_room->name}}</span> |
                    @endforeach

                    <hr>
                <a href="{{route('teacher.teach',$teacher->id)}}" class="btn btn-primary">
                    Choose subjects to teach
                </a>
                </div>
            </div>
        </div>
    </div>   
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                    @if($teacher->is_left==0)
                        <button class="btn btn-danger" data-toggle="modal" data-target="#resign-modal">Leaving School</button>
                    @else
                        <div class="alert alert-danger">Resigned for {{$teacher->reason_left}}  on {{$teacher->date_left}}</div>
                    @endif
            </div>
        </div>
    </div>
</div>   
    