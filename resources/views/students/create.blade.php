@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('student.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                Student Basic Information
            </div>
            <div class="panel-body">
                @include('partials.alert')
                <div class="row">
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="admission_number">Admission No.</label>
                                <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="Admission Number" value="{{getNextAdmissionNumber()}}" required>
                            </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="admitted_date">Admitted Date</label>
                                <input type="text" autocomplete="off" class="form-control" id="admitted_date" name="admitted_date" placeholder="Admitted Date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                            </div>
                    </div>
                    <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="admitted_academic_year_id">Academic Year</label>
                                    <select class="form-control" id="admitted_academic_year_id" name="admitted_academic_year_id">
                                        @foreach ($academic_years as $academic_year)
                                                <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                                        @endforeach
                                </select>
                                </div>
                        </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                                <label for="admitted_class_room_id">Admitted Class</label>
                                <select class="form-control" id="admitted_class_room_id" name="admitted_class_room_id">
                                        @foreach ($class_rooms as $class_room)
                                        <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">House</label>
                                <select class="form-control" id="house_id" name="house_id">
                                        @foreach ($houses as $house)
                                                @if ((getNextAdmissionNumber()%count($houses))+1==$house->id)
                                                    <option selected value="{{$house->id}}">{{$house->name}}</option>
                                                @else
                                                    <option value="{{$house->id}}">{{$house->name}}</option>
                                                @endif
                                        @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cluster</label>
                                <select class="form-control" id="cluster_id" name="cluster_id">                                        
                                        @switch(getNextAdmissionNumber()%count($clusters))
                                                @case(0)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==1)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                        @break
                                                @case(1)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==3)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break
                                                @case(2)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==5)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break
                                                @case(3)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==7)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break
                                                @case(4)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==2)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break
                                                @case(5)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==4)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break
                                                @case(6)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==6)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break
                                                @case(7)
                                                        @foreach ($clusters as $cluster)
                                                                @if($cluster->id==8)
                                                                        <option selected value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @else
                                                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                                                @endif
                                                        @endforeach
                                                @break                        
                                                @default
                                        @endswitch
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="surname">Surname</label>
                                        <input type="text" class="form-control" id="surname" name="surname" required placeholder="Surname" value="{{old('surname')}}">
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
                </div>
                <div class="row">
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="text" autocomplete="off" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" required value="{{old('date_of_birth')}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID Nummber" value="{{old('id_number')}}">
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
                        <div class="col-lg-2">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Religion</label>
                                <select class="form-control" id="religion" name="religion">
                                        <option value="Budhism">Budhism</option>
                                        <option value="Roman Chatholic">Roman Chatholic</option>
                                        <option value="Christhian">Christhian</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Other">Other</option>
                                </select>
                                </div>
                        </div>
                        <div class="col-lg-2">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nationality</label>
                                <select class="form-control" id="nationality" name="nationality">
                                       <option value="Sri Lankan">Sri Lankan</option>
                                       <option value="Other">Other</option>
                                </select>
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="scholarship_mark">Scholarship Mark (if any)</label>
                                    <input type="text" class="form-control" id="scholarship_mark" name="scholarship_mark" placeholder="Scholarship Marks" value="{{old('scholarship_mark')}}">
                                </div>
                        </div>
                        <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="distance">Distance to School</label>
                                    <input type="text" class="form-control" id="distance" name="distance" placeholder="Distance in Km" value="{{old('distance')}}">
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="town">Home Town</label>
                                    <input type="text" class="form-control" id="town" name="town" placeholder="Home Town" value="{{old('town')}}">
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-5">
                                <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Address" required>{{old('address')}}</textarea>
                                </div>
                        </div>
                        <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" value="{{old('telephone')}}">
                                </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" id="photo" name="photo" accept="image/*">
                                        <p class="help-block">Allowed file extensions png, jpg, gif, tiff. Maximum upload size 1MB.</p>
                                </div>
                        </div>
                </div>
                <hr>
                <div class="row">
                        <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Create</button>
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
src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap">
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

    
