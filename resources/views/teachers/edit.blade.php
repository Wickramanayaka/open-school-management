@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('teacher.update',$teacher->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

    <div class="panel panel-primary">
        <div class="panel-heading">
            Edit Teacher Basic Information
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required value="{{$teacher->surname}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required value="{{$teacher->first_name}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="other_name">Other Name</label>
                        <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Other Name" value="{{$teacher->other_name}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="given_name">Given Name</label>
                        <input type="text" class="form-control" id="given_name" name="given_name" placeholder="Given Name" value="{{$teacher->given_name}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="surname">Teacher Number</label>
                    <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="Teacher Number" required value="{{$teacher->admission_number}}">
                    </div>
                </div>
                <div class="col-lg-3">
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="text" autocomplete="off" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" value="{{$teacher->date_of_birth}}">
                        </div>
                </div>
                <div class="col-lg-3">
                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID Number" required value="{{$teacher->id_number}}">
                        </div>
                </div>
                <div class="col-lg-3">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                @if($teacher->gender=="Male")
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                @else
                                    <option value="Male">Male</option>
                                    <option selected value="Female">Female</option>
                                @endif
                            </select>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status" required value="{{old('civil_status')}}">
                            <option value="Married" {{$teacher->civil_status=="Married"?'selected':''}}>Married</option>
                            <option value="Single" {{$teacher->civil_status=="Single"?'selected':''}}>Single</option>
                            <option value="Divorced" {{$teacher->civil_status=="Divorced"?'selected':''}}>Divorced</option>
                            <option value="Other" {{$teacher->civil_status=="Other"?'selected':''}}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="distance">Distance to School</label>
                    <input type="text" class="form-control" id="distance" name="distance" placeholder="Distance to School in Km" required value="{{$teacher->distance}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="town">Home Town</label>
                        <input type="text" class="form-control" id="town" name="town" placeholder="Home Town" value="{{$teacher->town}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="transport_id">Type of Transport</label>
                        <select class="form-control" id="transport_id" name="transport_id">
                            @foreach ($transports as $transport)
                                <option value="{{$transport->id}}" {{$teacher->transport_id==$transport->id?'selected':''}}>{{$transport->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="first_name">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" required value="{{$teacher->telephone}}">
                    </div>
                </div>
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail Address" value="{{$teacher->email}}">
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Address" required>{{$teacher->address->address}}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="temporary_address">Temporary Address</label>
                        <textarea class="form-control" id="temporary_address" name="temporary_address" placeholder="Temporary Address" required>{{$teacher->temporaryAddress->address}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_category">Category of Appointment</label>
                        <select class="form-control" id="appointment_category" name="appointment_category">
                            <option value="Permanent" {{$teacher->appointment_category=='Permanent'?'selected':''}}>Permanent</option>
                            <option value="Part-time" {{$teacher->appointment_category=='Part-time'?'selected':''}}>Part-time</option>
                            <option value="Contract" {{$teacher->appointment_category=='Contract'?'selected':''}}>Contract</option>
                            <option value="Temporary" {{$teacher->appointment_category=='Temporary'?'selected':''}}>Temporary</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_date">Date of Appointment</label>
                        <input type="text" autocomplete="off" class="form-control" id="appointment_date" name="appointment_date" placeholder="Date of Appointment" value="{{$teacher->appointment_date}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_date_this_school">Date of Appointment (This School)</label>
                        <input type="text" autocomplete="off" class="form-control" id="appointment_date_this_school" name="appointment_date_this_school" placeholder="Date of Appointment (This School)" value="{{$teacher->appointment_date_this_school}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_subject">Subject of Appointment</label>
                        <input type="text" class="form-control" id="appointment_subject" name="appointment_subject" placeholder="Subject of Appointment" value="{{$teacher->appointment_subject}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="highest_education_qualification">Highest Education Qualification</label>
                        <input type="text" class="form-control" id="highest_education_qualification" name="highest_education_qualification" placeholder="Highest Education Qualification" value="{{$teacher->highest_education_qualification}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="highest_professional_qualification">Highest Professional Qualification</label>
                        <input type="text" class="form-control" id="highest_professional_qualification" name="highest_professional_qualification" placeholder="Highest Professional Qualification" value="{{$teacher->highest_professional_qualification}}">
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
@section('javascript')
    <script>
        $(function(){
            $("#date_of_birth").datepicker({
                    dateFormat : 'yy-mm-dd'        
            });
            $("#appointment_date").datepicker({
                    dateFormat : 'yy-mm-dd'        
            });
            $("#appointment_date_this_school").datepicker({
                    dateFormat : 'yy-mm-dd'        
            });
        });
    </script>
@endsection