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
        <h3>Student Personal Data</h3>
        <h5>පෝරමය පිරවීමට පෙර <a href="https://youtu.be/PluZOGVndVc">මෙහි ඇති උපදෙස්</a> හොඳින් කියවන්න/බලන්න.</h5>
        <p>අප පාසල නව ලොවට ගැලපෙන Smart School එකක් බවට පරිවර්තනය කිරීම අරමුණු කරගත් වැඩසටහනක් ආරම්භ කර ඇති බව සතුටින් දන්වා සිටිමු.
            එහි පලමු පියවර ලෙස සියලුම දරුවන් ගේ තොරතුරු නවතම තොරතුරු පද්ධතියකට (School management system) එක් කිරීම ආරමිභ කර ඇත. ඒ සදහා දෙමාපියන්ගේ උපරිම සහාය බලාපොරොත්තුවේ.</p>
        <ol>
            <li>පහත සඳහන් තොරතුරු  නිවැරදිව ලබා දෙන්න. </li>
            <li>සියලුම තොරතුරු ඉංග්‍රීසි භාෂාවෙන් පිරවිය යුතු අතර Capital Letter භාවිතා කරන්න.</li>
            <li>එක පංතියක එකම පවුලේ දරුවන් සිටි නම් දරුවන් සදහා වෙන වෙනම තොරතුරු ලබා දිය යුතුයි.</li>
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
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>1. Student Admission Number - ඇතුලත්වීමේ අංකය - නාම ලේඛණය පරිදි නිවැරදි ලබා දෙන්න<span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="" autocomplete="off" required>
            </div>
            <pre>
දරුවගේ නම පහත සඳහන් ආකාරයට කොටස් 3 කට වෙන් කර ලබා දිය යුතුයි.
How to add Student Name in this form.  Pls Distribute as follows


වාසගම
පලමු නම
අනෙකුත් නම්



Ex 
Full name : HEWA AMARASEKAGE VIHAS MINDIV AMARASEKARA

Surname : 
HEWA AMARASEKAGE


First Name  :  VIHAS

Other Names : 
MINDIV AMARASEKARA
            </pre>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>2. Student Surname ( Only Surname ) වාසගම<span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" id="admission_number" placeholder="" autocomplete="off" name="surname" required value="{{old('admission_number')}}">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label"><strong>3. Student First Name ( Only First ) පලමු නම<span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" id="first_name" placeholder="" autocomplete="off" name="first_name" required value="{{old('first_name')}}">
            </div>
            <div class="mb-3">
                <label for="other_name" class="form-label"><strong>4. Student Other Name ( Only Other Names ) අනෙකුත් නම්</strong></label>
                <input type="text" class="form-control" id="other_name" placeholder="" autocomplete="off" name="other_name" value="{{old('other_name')}}">
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>5. Date of Birth ( Date Format : YYYY-MM-DD ( 2006-02-15) ) උපන් දිනය<span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" id="dob" placeholder="" autocomplete="off" name="date_of_birth" required>
            </div>
            <div class="mb-3">
                <label for="id_number" class="form-label"><strong>6. Student NIC Number ( If your have) ජාතික හැදුනුම්පත් අංකය</strong></label>
                <input type="text" class="form-control" id="id_number" placeholder="" autocomplete="off" name="id_number" value="{{old('id_number')}}">
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>7. Gender (Choice from Drop down menu)<span class="text-danger">*</span></strong></label>
                <select class="form-select" aria-label="Default select example" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label"><strong>8. Address : සම්පූර්ණ ලිපිනය<span class="text-danger">*</span></strong></label>
                <textarea type="text" class="form-control" id="address" placeholder="" autocomplete="off" name="address" required>{{old('address')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>9. Admitted Year පාසලට ඇතුලත් වු වර්ෂය<span class="text-danger">*</span></strong></strong></label>
                <select class="form-select" aria-label="Default select example" id="admitted_academic_year_id" name="admitted_academic_year_id" required>
                    @foreach ($academic_years as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>9.1 Admitted Date ( Date Format : YYYY-MM-DD ( 2006-02-15) ) පාසලට ඇතුලත් වු දිනය(ආසන්න වශයෙන්)<span class="text-danger">*</span></strong></strong></label>
                <input type="text" id="admitted" class="form-control" id="admitted_date" placeholder="" autocomplete="off" name="admitted_date" required>
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>10. Admitted Class Room ( Ex : 1A ) පාසලට ඇතුලත් වු පංතිය. උදාහරණ 1A හෝ වෙනත් පංතියකට ද යන වග<span class="text-danger">*</span></strong></label>
                <select class="form-select" aria-label="Default select example" id="admitted_class_room_id" name="admitted_class_room_id" required>
                    @foreach ($admitted_class_rooms as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>10.1 House (Choice from Drop down menu) නිවාසය<span class="text-danger">*</span></strong></label>
                <select class="form-select" aria-label="Default select example" id="house_id" name="house_id" required>
                    @foreach ($houses as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>11. Present Class ({{date('Y')}}) ( Ex : 1B ) ({{date('Y')}}) වර්ෂයේ ඉගැනුම් ලබන පංතිය<span class="text-danger">*</span></strong></label>
                <select class="form-select" aria-label="Default select example" id="present_class_room_id" name="present_class_room_id" required>
                    @foreach ($class_rooms as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="admission_number" class="form-label"><strong>12. Transport (Choice from Drop down menu) පාසලට පැමිණෙන ආකාරය<span class="text-danger">*</span></strong></label>
                <select class="form-select" aria-label="Default select example" name="transport_id" required>
                    <option value="1">Bus</option>
                    <option value="2">School Van</option>
                    <option value="3">Private Vehicle</option>
                    <option value="4">Walking</option>
                    <option value="5">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="distance" class="form-label"><strong>13. Distance - Home to School ( Ex : 5 Km ) නිවසේ සිට පාසල්ට ඇති දුර<span class="text-danger">*</span></strong></label>
                <input type="number" class="form-control" id="distance" placeholder="" autocomplete="off" name="distance" required value="{{old('distance')}}">
            </div>
            <div class="mb-3">
                <label for="town" class="form-label"><strong>14. Home Town (පදිංචි ආසන්න නගරය)<span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" id="town" placeholder="" autocomplete="off" name="town" required value="{{old('town')}}">
            </div>
            <div class="mb-3">
                <label for="scholarship_mark" class="form-label"><strong>15. Scholarship Mark ( If your have) ශිෂ්‍යත්ව ලකුණු ( ආදල නම් පමණයි)</strong></label>
                <input type="number" class="form-control" id="scholarship_mark" placeholder="" autocomplete="off" name="scholarship_mark" value="{{old('scholarship_mark')}}">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>
            <br><br>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $("#admitted").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                todayBtn : "linked",
                format: 'yyyy-mm-dd',
                title : "Admitted Date"
            }).datepicker('update', new Date());
            $("#dob").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                todayBtn : "linked",
                format: 'yyyy-mm-dd',
                title : "Date of Birth"
            }).datepicker('update', new Date());
        });
    </script>
        <script src=
        "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
                integrity=
        "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
                crossorigin="anonymous">
            </script>
            <script src=
        "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
                integrity=
        "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
                crossorigin="anonymous">
            </script>
            <script src=
        "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
            </script>
</body>
</html>