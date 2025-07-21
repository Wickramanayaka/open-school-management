@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('teacher.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            New Teacher
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required value="{{old('surname')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required value="{{old('first_name')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="other_name">Other Name</label>
                        <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Other Name" value="{{old('other_name')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="given_name">Given Name</label>
                        <input type="text" class="form-control" id="given_name" name="given_name" placeholder="Given Name" value="{{old('given_name')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="surname">Teacher Number</label>
                    <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="Teacher Number" required value="{{old('admission_number')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="text" class="form-control" autocomplete="off" id="date_of_birth" name="date_of_birth" required placeholder="Date of Birth" value="{{old('date_of_birth')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="id_number">ID Number</label>
                        <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID Number" required value="{{old('id_number')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status" required value="{{old('civil_status')}}">
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="distance">Distance to School</label>
                    <input type="text" class="form-control" id="distance" name="distance" placeholder="Distance to School in Km" required value="{{old('distance')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="town">Home Town</label>
                        <input type="text" class="form-control" id="town" name="town" placeholder="Home Town" value="{{old('town')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="transport_id">Type of Transport</label>
                        <select class="form-control" id="transport_id" name="transport_id">
                            @foreach ($transports as $transport)
                                <option value="{{$transport->id}}">{{$transport->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                        <p class="help-block">Allowed file extensions png, jpg, gif, tiff. Maximum upload size 1MB.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="first_name">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" required value="{{old('telephone')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail Address" value="{{old('email')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="address">Permanent Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Permament Address" required>{{old('address')}}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="temporary_address">Temporary Address</label>
                        <textarea class="form-control" id="temporary_address" name="temporary_address" placeholder="Temporary Address" required>{{old('temporary_address')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_category">Category of Appointment</label>
                        <select class="form-control" id="appointment_category" name="appointment_category">
                            <option value="Permanent">Permanent</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Temporary">Temporary</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_date">Date of Appointment</label>
                        <input type="text" autocomplete="off" class="form-control" id="appointment_date" name="appointment_date" placeholder="Date of Appointment" value="{{old('appointment_date')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_date_this_school">Date of Appointment (This School)</label>
                        <input type="text" autocomplete="off" class="form-control" id="appointment_date_this_school" name="appointment_date_this_school" placeholder="Date of Appointment (This School)" value="{{old('appointment_date_this_school')}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="appointment_subject">Subject of Appointment</label>
                        <input type="text" class="form-control" id="appointment_subject" name="appointment_subject" placeholder="Subject of Appointment" value="{{old('appointment_subject')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="highest_education_qualification">Highest Education Qualification</label>
                        <input type="text" class="form-control" id="highest_education_qualification" name="highest_education_qualification" placeholder="Highest Education Qualification" required value="{{old('highest_education_qualification')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="highest_professional_qualification">Highest Professional Qualification</label>
                        <input type="text" class="form-control" id="highest_professional_qualification" name="highest_professional_qualification" placeholder="Highest Professional Qualification" value="{{old('highest_professional_qualification')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Create</button>
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
            $('#appointment_date').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('#appointment_date_this_school').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
@endsection
