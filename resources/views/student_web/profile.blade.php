@extends('student_web.app')
@section('content')
<div class="container">
    <div class="row" id="result">

    </div>
    <div class="row">
        <div class="col-md-3">
            @foreach ($data as $item)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom:30px;">
                            <img src="{{url('images/profiles/students/') . '/' . $item['photo']}}" style="width: 100%; display:block; margin: 0 auto;">
                            <div class="container" style="margin-top: 10px;">
                                Name in Full. : <b> {{$item['full_name']}}</b><br>
                                Admission No. : <b> {{$item['admission_number']}}</b><br>
                                Present Class : <b> {{$item['class_room']}}</b>
                            </p>
                            </div>
                            <div class="card-footer">
                                <a href="#" onclick="getInfo({{$item['id']}})"><b>GET MY INFO</b></a><br>
                                <a href="#" onclick="getExam({{$item['id']}})"><b>GET MY EXAMS</b></a><br>
                                <a href="#" onclick="getSubject({{$item['grade_id']}})"><b>GET MY SUBJECTS</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h3 id="title"></h3>
            <ul id="subject">

            </ul>
            <table id="info" class="table table-no-border">

            </table>
            <table id="exam" class="table table-no-border">

            </table>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <h3 id="subject-title"></h3>
            <ul id="video">

            </ul>
        </div>
    </div>
</div>
@include('student_web.watch_video')
@endsection
@section('javascript')
    <script>
        function getSubject(grade){
            $('#info').html('');
            $('#exam').html('');
            $('#subject').html('');
            $('#title').html('Grade ' + grade + ' Subjects');
            $('#video').html('');
            $('#subject-title').html('');
            $.get('{{url('t/subject')}}/' + grade, function(result){
                result.forEach(element => {
                    $('#subject').append(`<li><a href="#" onclick="getVideo(${element.id},'${element.name}')">${element.name}</a></li>`)
                });
            });
        }
        function getVideo(subject, name){
            $('#video').html('');
            $('#subject-title').html('Videos for ' + name + ' Subject');
            $.get('{{url('t/video')}}/' + subject, function(result){
                result.forEach(element => {
                    $('#video').append(`<li><a class="video" href="#" onclick="playVideo('${element.url}')"> <i class="glyphicon glyphicon-facetime-video"></i> ${element.number}. ${element.name}</a></li>`)
                });
            });
        }
        function playVideo(url){
            var modal = $('#watch-video');
            $('#iframe').attr('src',url);
            modal.modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
            });
        }
        function getInfo(id){
            $('#info').html('');
            $('#exam').html('');
            $('#subject').html('');
            $('#title').html('Student Information');
            $('#video').html('');
            $('#subject-title').html('');
            $.get('{{url('t/info')}}/' + id, function(result){
                $('#info').append(`<tr><td style="padding: 10px;">Admission Number</td><td>${result.admission_number}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Full Name</td><td style="padding: 10px;">${result.surname} ${result.first_name} ${result.other_name}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Address</td><td style="padding: 10px;">${result.address.address}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Telephone</td><td style="padding: 10px;">${result.telephone}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Date of Birth</td><td style="padding: 10px;">${result.date_of_birth}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Admitted Date</td><td style="padding: 10px;">${result.admitted_date}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Admitted Academic Year</td><td style="padding: 10px;">${result.admitted_academic_year.name}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Admitted Class</td><td style="padding: 10px;">${result.admitted_class_room.name}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">ID Number</td><td style="padding: 10px;">${result.idNum}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Gender</td><td style="padding: 10px;">${result.gender}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Religion</td><td style="padding: 10px;">${result.religion}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Nationality</td><td style="padding: 10px;">${result.nationality}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">House</td><td style="padding: 10px;">${result.house.name}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Cluster</td><td style="padding: 10px;">${result.cluster.name}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Type of Transport</td><td style="padding: 10px;">${result.transport.name}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Distance to School</td><td style="padding: 10px;">${result.distance}Km</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Home Town</td><td style="padding: 10px;">${result.town}</td></tr>`);
                $('#info').append(`<tr><td style="padding: 10px;">Scholarship Marks</td><td style="padding: 10px;">${result.scholarship_mark}</td></tr>`);
            });
        }
        function getExam(id){
            $('#info').html('');
            $('#exam').html('');
            $('#subject').html('');
            $('#title').html('Exam List');
            $('#video').html('');
            $('#subject-title').html('');
            $('#exam').append(`<tr><th style="padding: 10px;">Examination</th><th style="padding: 10px;">Total</th><th style="padding: 10px;">Average</th><th style="padding: 10px;">Class 1st Average</th><th style="padding: 10px;">Rank</th><th style="padding: 10px;"></th></tr>`);
            $.get('{{url('t/exam/student')}}/' + id, function(result){
                result.forEach(element => {
                    $('#exam').append(`<tr><td style="padding: 10px;">${element.exam.name}</td><td style="padding: 10px;">${element.total}</td><td style="padding: 10px;">${element.average}</td><td style="padding: 10px;">${element.rank_one_average}</td><td style="padding: 10px;">${element.rank}</td><td style="padding: 10px;"><a href="#" onclick="getResult(${element.student_id},'${element.exam_id}')">Progress Report</a></td></tr>`);
                });
            });
        }
        function getResult(id, exam){
            $.post('{{ url('examMark/getReport') }}', 
                {
                    student_id: id,
                    exam_id: exam
                }, 
                function(result) {
                    // Clear previous content
                    $('#result').html('');
                    $('#result').append(result); 
                    // Show the modal
                    $('#report-modal').modal('show');
                }
            );
        }

    </script>
@endsection


