@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Examination Mark</div>
            </div>
            <div class="panel-body" style="overflow:auto; white-space: nowrap;">
                @include('partials.alert')
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="surname">Class Room</label>
                            <select class="form-control select2" id="class_room_id" name="class_room_id">
                                <option value="0">ALL</option>
                                @foreach ($class_rooms as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="first_name">Examination</label>
                            <select class="form-control select2" id="exam_id" name="exam_id" required>
                                @foreach ($exams as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="subject_id">Subject</label>
                            <select class="form-control select2" id="subject_id" name="subject_id" required>
                                <option value="0">ALL</option>
                                @foreach ($subjects as $item)
                                    <option value="{{$item->id}}">{{$item->code}} - {{$item->name}} ({{$item->language->name}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" id="dataBtn">Get Data</button>
                <hr>
                <div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>
                <div id="ajax-data"></div>
            </div>
        </div>
    </div>
    <a href="{{route('examMark.create')}}" class="float"><i class="fa fa-plus btn-float"></i></a>
@endsection
@section('javascript')
    <script>
        $(document).ready(function(){
            function init(){
                if(localStorage['city']){
                    $("#city").val(localStorage['city']);
                }
            }
            init();

            $(".select2").select2({
                theme: 'bootstrap'
            })

            $(".stored").keyup(function(){
                localStorage[$(this).attr('name')] = $(this).val();
            });
            $("#dataBtn").click(function(){
                $("#loader").show();
                $.ajax({
                    url: "{{route('examMark.getMark')}}",
                    type: 'POST',
                    data: {
                        'class_room_id': $('#class_room_id').val(),
                        'exam_id': $('#exam_id').val(),
                        'subject_id': $('#subject_id').val()
                    },
                    success: function(get_data){
                        $("#ajax-data").html(get_data);
                    },
                    error: function(error){
                        alert("Error occured, please try again...");
                    },
                    complete: function(){
                        $("#loader").hide();
                    }
                });
            });
        })

        function check(){
            $("input").prop('checked',$("#master").prop('checked'));
        }
    </script>
@endsection