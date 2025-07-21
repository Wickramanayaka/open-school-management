<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <title>Student Data Filling Form</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{url('images/profiles/school/') . '/' . $school->logo}}" class="rounded mx-auto d-block" alt="school-logo">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-center">
                    <span style="font-size: 1.5rem">{{$school->name}}</span><br>
                    {{$school->address}}<br>
                    {{$school->telephone}}<br>
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Parents Personal Data</h3>
        <h5>පෝරමය පිරවීමට පෙර <a href="https://youtu.be/PluZOGVndVc">මෙහි ඇති උපදෙස්</a> හොඳින් කියවන්න/බලන්න.</h5>
        <p>අප පාසල නව ලොවට ගැලපෙන Smart School එකක් බවට පරිවර්තනය කිරීම අරමුණු කරගත් වැඩසටහනක් ආරම්භ කර ඇති බව සතුටින් දන්වා සිටිමු.
            එහි පලමු පියවර ලෙස සියලුම දෙමාපියන්ගේ තොරතුරු නවතම තොරතුරු පද්ධතියකට (School management system) එක් කිරීම ආරමිභ කර ඇත. ඒ සදහා දෙමාපියන්ගේ උපරිම සහාය බලාපොරොත්තුවේ.</p>
        <ol>
            <li>පහත සඳහන් තොරතුරු  නිවැරදිව ලබා දෙන්න. </li>
            <li>සියලුම තොරතුරු ඉංග්‍රීසි භාෂාවෙන් පිරවිය යුතු අතර Capital Letter භාවිතා කරන්න.</li>
        </ol>
        @if (Session::has('message'))
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('message')}}
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger" role="alert">   
                        <h5>Please contact school admin for any help (ඕනෑම උදව්වක් සඳහා කරුණාකර පාසල් පරිපාලක අමතන්න).</h5>     
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <form action="#" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Student Admission Number</h5>
                            <div class="mb-3">
                                <label for="admission_number" class="form-label"><strong>1. Student Admission Number - ඇතුලත්වීමේ අංකය - නාම ලේඛණය පරිදි නිවැරදි ලබා දෙන්න<span class="text-danger">*</span></strong></label>
                                <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="" autocomplete="off" required>
                            </div>
                            <button onclick="verify()" class="btn btn-primary" type="button">Verify</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Student Information</h5>
                         <p id="student_name"></p>
                         <p id="class_room"></p>
                         <p id="note" class="text-danger"></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="parents-info" style="display: none;">
                <h3 style="color:teal">Father Info</h3>
                <div class="mb-3">
                    <label for="father_name">Name</label>
                    <input class="form-control" type="text" id="father_name" name="father_name">
                </div>
                <div class="mb-3">
                    <label for="father_name">Mobile</label>
                    <input class="form-control" type="text" id="father_telephone" name="father_telephone" placeholder="+94123456789">
                </div>
                <div class="mb-3">
                    <label for="father_name">E-Mail</label>
                    <input class="form-control" type="text" id="father_email" name="father_email">
                </div>
                <div class="mb-3">
                    <label for="father_id_number">ID Number</label>
                    <input class="form-control" type="text" id="father_id_number" name="father_id_number">
                </div>
                <div class="mb-3">
                    <label for="father_name">Occupation</label>
                    <select class="form-select" id="father_occupation" name="father_occupation">
                        @foreach ($occupations as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="father_name">Name of Employment</label>
                    <input class="form-control" type="text" id="father_name_of_employment" name="father_name_of_employment">
                </div>
                <div class="mb-3">
                    <label for="father_name">Office Telephone</label>
                    <input class="form-control" type="text" id="father_office_telephone" name="father_office_telephone">
                </div>
                <div class="mb-3">
                    <label for="father_name">Office Address</label>
                    <input class="form-control" type="text" id="father_address_of_employment" name="father_address_of_employment">
                </div>
                <div class="mb-3">
                    <label for="father_designation_type">Designation Type</label>
                    <select class="form-select" id="father_designation_type" name="father_designation_type">
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="Own Business">Own Business</option>
                        <option value="Unemployeed">Unemployeed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="father_income_level">Level of Income </label>
                    <select class="form-select" id="father_income_level" name="father_income_level">
                        <option value="0-25,000">0-25,000</option>
                        <option value="26,000-50,000">26,000-50,000</option>
                        <option value="51,000-75,000">51,000-75,000</option>
                        <option value="76,000-100,000">76,000-100,000</option>
                        <option value="above 100,000">above 100,000</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="father_education_level">Level of Education</label>
                    <select class="form-select" id="father_education_level" name="father_education_level">
                        <option value="O/L">O/L</option>
                        <option value="A/L">A/L</option>
                        <option value="Bachelor Degree">Bachelor Degree</option>
                        <option value="Master Degree">Master Degree</option>
                    </select>
                </div>
                <hr>
                <h3 style="color:teal">Mother Info</h3>
                <div class="mb-3">
                    <label for="mother_name">Name</label>
                    <input class="form-control" type="text" id="mother_name" name="mother_name">
                </div>
                <div class="mb-3">
                    <label for="mother_name">Mobile</label>
                    <input class="form-control" type="text" id="mother_telephone" name="mother_telephone" placeholder="+94123456789">
                </div>
                <div class="mb-3">
                    <label for="mother_name">E-Mail</label>
                    <input class="form-control" type="text" id="mother_email" name="mother_email">
                </div>
                <div class="mb-3">
                    <label for="mother_id_number">ID Number</label>
                    <input class="form-control" type="text" id="mother_id_number" name="mother_id_number">
                </div>
                <div class="mb-3">
                    <label for="mother_name">Occupation</label>
                    <select class="form-select" id="mother_occupation" name="mother_occupation">
                        @foreach ($occupations as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mother_name">Name of Employment</label>
                    <input class="form-control" type="text" id="mother_name_of_employment" name="mother_name_of_employment">
                </div>
                <div class="mb-3">
                    <label for="mother_name">Office Telephone</label>
                    <input class="form-control" type="text" id="mother_office_telephone" name="mother_office_telephone">
                </div>
                <div class="mb-3">
                    <label for="mother_name">Office Address</label>
                    <input class="form-control" type="text" id="mother_address_of_employment" name="mother_address_of_employment">
                </div>
                <div class="mb-3">
                    <label for="mother_designation_type">Designation Type</label>
                    <select class="form-select" id="mother_designation_type" name="mother_designation_type">
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="Own Business">Own Business</option>
                        <option value="Unemployeed">Unemployeed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mother_income_level">Level of Income </label>
                    <select class="form-select" id="mother_income_level" name="mother_income_level">
                        <option value="0-25,000">0-25,000</option>
                        <option value="26,000-50,000">26,000-50,000</option>
                        <option value="51,000-75,000">51,000-75,000</option>
                        <option value="76,000-100,000">76,000-100,000</option>
                        <option value="above 100,000">above 100,000</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mother_education_level">Level of Education</label>
                    <select class="form-select" id="mother_education_level" name="mother_education_level">
                        <option value="O/L">O/L</option>
                        <option value="A/L">A/L</option>
                        <option value="Bachelor Degree">Bachelor Degree</option>
                        <option value="Master Degree">Master Degree</option>
                    </select>
                </div>
                <hr>
                <h3 style="color:teal">Guardian Info</h3>
                <div class="mb-3">
                    <label for="guardian_name">Name</label>
                    <input class="form-control" type="text" id="guardian_name" name="guardian_name">
                </div>
                <div class="mb-3">
                    <label for="guardian_name">Mobile</label>
                    <input class="form-control" type="text" id="guardian_telephone" name="guardian_telephone" placeholder="+94123456789">
                </div>
                <div class="mb-3">
                    <label for="guardian_name">E-Mail</label>
                    <input class="form-control" type="text" id="guardian_email" name="guardian_email" >
                </div>
                <div class="mb-3">
                    <label for="guardian_id_number">ID Number</label>
                    <input class="form-control" type="text" id="guardian_id_number" name="guardian_id_number" >
                </div>
                <div class="mb-3">
                    <label for="guardian_relation_to_student">Relation to Student</label>
                    <input class="form-control" type="text" id="guardian_relation_to_student" name="guardian_relation_to_student">
                </div>
                <div class="mb-3">
                    <label for="guardian_name">Occupation</label>
                    <select class="form-select" type="text" id="guardian_occupation" name="guardian_occupation">
                        @foreach ($occupations as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="guardian_name">Name of Employment</label>
                    <input class="form-control" type="text" id="guardian_name_of_employment" name="guardian_name_of_employment">
                </div>
                <div class="mb-3">
                    <label for="guardian_name">Office Telephone</label>
                    <input class="form-control" type="text" id="guardian_office_telephone" name="guardian_office_telephone">
                </div>
                <div class="mb-3">
                    <label for="guardian_name">Office Address</label>
                    <input class="form-control" type="text" id="guardian_address_of_employment" name="guardian_address_of_employment">
                </div>
                <div class="mb-3">
                    <label for="guardian_designation_type">Designation Type</label>
                    <select class="form-select" id="guardian_designation_type" name="guardian_designation_type">
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="Own Business">Own Business</option>
                        <option value="Unemployeed">Unemployeed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="guardian_income_level">Level of Income </label>
                    <select class="form-select" id="guardian_income_level" name="guardian_income_level">
                        <option value="0-25,000">0-25,000</option>
                        <option value="26,000-50,000">26,000-50,000</option>
                        <option value="51,000-75,000">51,000-75,000</option>
                        <option value="76,000-100,000">76,000-100,000</option>
                        <option value="above 100,000">above 100,000</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="guardian_education_level">Level of Education</label>
                    <select class="form-select" id="guardian_education_level" name="guardian_education_level">
                        <option value="O/L">O/L</option>
                        <option value="A/L">A/L</option>
                        <option value="Bachelor Degree">Bachelor Degree</option>
                        <option value="Master Degree">Master Degree</option>
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <input type="hidden" name="student_id" id="student_id" value="0">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            <br><br>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        function verify(){
            var admission_number = $('#admission_number').val();
            if(!$('#admission_number').val()){
                alert('Admission number can not be empty.');
            }
            else{
                $.get("./student/get/" + admission_number, function(data, status){
                    if(data.error!="404"){
                        $("#student_name").html('Student Name: <b>' + data.surname + " " + data.first_name + " " + data.other_name +  '</b>');
                        $("#class_room").html('Class: <b>' + data.present_class_room.name +  '</b>');
                        $("#note").html("ඔබේ නම සහ පන්ති කාමරය මෙහි නිවැරදිව ප්‍රදර්ශනය වන බවට වග බලා ගන්න");
                        $('#student_id').val(data.id);
                        $('#parents-info').css('display','')

                    }
                    else{
                        $("#student_name").html('');
                        $("#class_room").html('');
                        $("#note").html("ඔබ වලංගු නොවන ඇතුලත්වීමේ අංකයක් ඇතුළත් කර ඇත. කරුණාකර පාසල් පරිපාලක අමතන්න");
                        $('#student_id').val(0);
                        $('#parents-info').css('display','none')
                    }
                });
            }
        }
    </script>
</body>
</html>