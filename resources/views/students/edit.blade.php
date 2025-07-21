@extends('layouts.app')
@section('content')

<form method="POST" action="{{route('student.update',$student->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                Student Basic Information
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                        <label for="admission_number">Admission No.</label>
                        <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="Admission Number" value="{{$student->admission_number}}" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                                <label for="admitted_date">Admitted Date</label>
                                <input type="text" autocomplete="off" class="form-control" id="admitted_date" name="admitted_date" placeholder="Admitted Date" value="{{$student->admitted_date}}" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="admitted_academic_year_id">Academic Year</label>
                                    <select class="form-control" id="admitted_academic_year_id" name="admitted_academic_year_id">
                                        @foreach ($academic_years as $academic_year)
                                                <option value="{{$academic_year->id}}" {{$academic_year->id==$student->admitted_academic_year_id?'selected':''}}>{{$academic_year->name}}</option>
                                        @endforeach
                                </select>
                                </div>
                        </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                                <label for="admitted_class_room_id">Admitted Class</label>
                                <select class="form-control" id="admitted_class_room_id" name="admitted_class_room_id">
                                        @foreach ($class_rooms as $class_room)
                                <option value="{{$class_room->id}}" {{$class_room->id==$student->admitted_class_room_id?'selected':''}}>{{$class_room->name}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="house_id">House</label>
                                <select class="form-control" id="house_id" name="house_id">
                                        @foreach ($houses as $house)
                                                <option value="{{$house->id}}" {{$house->id==$student->house_id?'selected':''}}>{{$house->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="cluster_id">Cluster</label>
                                <select class="form-control" id="cluster_id" name="cluster_id">
                                        @foreach ($clusters as $cluster)
                                        <option value="{{$cluster->id}}" {{$cluster->id==$student->cluster_id?'selected':''}}>{{$cluster->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" required placeholder="Surname" value="{{$student->surname}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required value="{{$student->first_name}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="other_name">Other Name</label>
                                <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Other Name" value="{{$student->other_name}}">
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                <input type="text" class="form-control" autocomplete="off" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" required value="{{$student->date_of_birth}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                        <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID Nummber" value="{{$student->id_number}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                            @if($student->gender=="Male")
                                                <option selected value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            @else
                                                <option value="Male">Male</option>
                                                <option selected value="Female">Female</option>
                                            @endif
                                    </select>
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="transport_id">Type of Transport</label>
                                    <select class="form-control" id="transport_id" name="transport_id">
                                        @foreach ($transports as $transport)
                                        <option value="{{$transport->id}}" {{$transport->id==$student->transport_id?'selected':''}}>{{$transport->name}}</option>
                                        @endforeach
                                </select>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Religion</label>
                                <select class="form-control" id="religion" name="religion">
                                        <option value="Budhism" {{$student->religion=="Budhism"?'selected':''}}>Budhism</option>
                                        <option value="Roman Chatholic" {{$student->religion=="Roman Chatholic"?'selected':''}}>Roman Chatholic</option>
                                        <option value="Christhian" {{$student->religion=="Christhian"?'selected':''}}>Christhian</option>
                                        <option value="Hindu" {{$student->religion=="Hindu"?'selected':''}}>Hindu</option>
                                        <option value="Other" {{$student->religion=="Other"?'selected':''}}>Other</option>
                                </select>
                                </div>
                        </div>
                        <div class="col-lg-2">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nationality</label>
                                <select class="form-control" id="nationality" name="nationality">
                                       <option value="Sri Lankan" {{$student->nationality=="Sri Lankan"?'selected':''}}>Sri Lankan</option>
                                       <option value="Other" {{$student->nationality=="Other"?'selected':''}}>Other</option>
                                </select>
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="scholarship_mark">Scholarship Mark (if any)</label>
                                    <input type="text" class="form-control" id="scholarship_mark" name="scholarship_mark" placeholder="Scholarship Marks" value="{{$student->scholarship_mark}}">
                                </div>
                        </div>
                        <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="distance">Distance to School</label>
                                    <input type="text" class="form-control" id="distance" name="distance" placeholder="Distance in Km" value="{{$student->distance}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="town">Home Town</label>
                                    <input type="text" class="form-control" id="town" name="town" placeholder="Home Town" value="{{$student->town}}">
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Address" required>{{$student->address->address}}</textarea>
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" value="{{$student->telephone}}">
                                </div>
                        </div>
                </div>
                <hr>
                <div class="row">
                        <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                        </div>
                </div>


            </div>
            <div class="panel-footer">
                <div class="row">
                        <div class="col-lg-12">
                                <div id="floating-panel">
                                        <input id="submit" type="button" value="Get Location...">
                                </div>
                                <div id="map"></div>
                                                        
                        </div>
                </div>    
                
            </div>
        </div>
       
            

</form>
@endsection

@section('javascript')
    <script>
            $(function(){
                    $("#admitted_date").datepicker({
                            dateFormat: 'yy-mm-dd',
                    });
                    $("#date_of_birth").datepicker({
                            dateFormat: 'yy-mm-dd',
                    });
                    $("#admitted_grade_id").select2();
            });
    </script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
</script>

<script>
function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 6.901311, lng: 79.873521}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
        });

        google.maps.event.addListener(map,'click',function(event){
                geocoder.geocode({
                        'latLng': event.latLng
                }, function(results, status){
                        if(status == google.maps.GeocoderStatus.OK){
                                if(results[0]){
                                        $("#address").html(results[0].formatted_address);
                                }
                        }
                });
        });
}

function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
        });
        } else {
        alert('Geocode was not successful for the following reason: ' + status);
        }
        });
}
</script>
@endsection

    
