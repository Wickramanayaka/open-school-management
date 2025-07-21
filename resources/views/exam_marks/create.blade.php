@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Examination Mark</div>
            </div>
            <div class="panel-body" style="white-space: nowrap;">
                @include('partials.alert')
            <form id="localStorage" method="POST" action="{{route('examMark.store')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="surname">Class Room</label>
                                <select class="form-control" id="class_room_id" name="class_room_id">
                                    @foreach ($class_rooms as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="first_name">Examination</label>
                                <select class="form-control" id="exam_id" name="exam_id" required>
                                    @foreach ($exams as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <div>
                                <select class="form-control select2" multiple id="subject_id" name="subject_id[]">
                                    {{--@foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->code}}-{{$subject->name}}({{$subject->language->name}})</option>
                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary" id="get-data">Get Data</a>
                {{--<button type="submit" class="btn btn-primary">Save Data</button>--}}
                <a href="#" class="btn btn-danger" onclick="recalculate()">Rank Calculation</a>
                <label class="checkbox-inline pull-right">
                    <input id="enable-editing" type="checkbox" data-toggle="toggle"> Enable Editing
                </label>
		<hr>
                <h5>Valid inputs for the marks are 0 to 100, AB/ab for absent. After the modifications have been done, run the rank calculation.</h5>
		<h5><b>Important: </b>Use this form to add or update exam marks only for current academic year's exams.</h5>
                <hr>
                <div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>
                <div id="ajax-data"></div>
            </form>
            </div>
        </div>
    </div>
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

            $(".stored").keyup(function(){
                localStorage[$(this).attr('name')] = $(this).val();
            });

            $("#get-data").click(function(){
                $("#enable-editing").prop("checked", false).change();
                $("#loader").show();
                $.ajax({
                    url: "{{route('examMark.getStudent')}}",
                    type: 'POST',
                    data: {
                        'class_room_id': $('#class_room_id').val(),
                        'exam_id': $('#exam_id').val(),
                        'subject_id': $('#subject_id').val(),
                    },
                    success: function(get_data){
                        $("#ajax-data").html(get_data);
                        editable();
                    },
                    error: function(error){
                        alert("Error occured, please try again...");
                    },
                    complete: function(){
                        $("#loader").hide();
                        editable();
                    }
                });
            });
            // Capture enter key press and move down
            $('#localStorage').on('keypress',function(event){
                if(event.keyCode === 10 || event.keyCode === 13){
                    event.preventDefault();
                    event_id =event.target.id.split('-');
                    console.log(event_id);
                    row = parseInt(event_id[1]) + 1;
                    col = event_id[0];
                    new_cell = "#" + col + "-" + row;
                    // Move down
                    $(new_cell).focus();
                }
            })
        });
        $(document).ready(function(){
            $('.select2').select2();
        });

        $(function(){
            $("#class_room_id").change(function(){
                var url = "{{url('subject/get/ajax')}}?id=" + $("#class_room_id").val();
                $.get(url,function(data){
                    var data_array = [];
                    for(key in data.subjects){
                        data_array.push("<option value=" + data.subjects[key].id + ">" + data.subjects[key].code + " - "  + data.subjects[key].name + "(" + data.subjects[key].language +  ")</option>");
                    }
                    $("#subject_id").html(data_array);
                });
            });
        });
        function update(obj){
            if(document.getElementById("enable-editing").checked==true) {
                // mark should be less than 100, can not be negaive, D,d,AB,ab are allowed
                if($(obj).val()=='AB' || $(obj).val()=='ab' || $(obj).val()=='D' || $(obj).val()=='d' || $(obj).val()<=100)
                {
                    console.log(obj);
                    console.log("change id: " + obj.id + " data-id: " + obj.attributes[7].nodeValue + "val : " + $(obj).val() );
                    url = "{{url('examMark/update/ajax')}}?id=" + obj.attributes[7].nodeValue + "&value=" +  $(obj).val() ;
                    $.get(url,function(data){
                        // nothing
                        console.log(data.message);
                    });
                }
                else{
                    alert("Provided value is not correct.");
                    i = document.getElementById(obj.id);
                    console.log(i);
                }
                
            }
            else{
                alert("Enable editing to modify the mark.");
            }
            
        }
        $(window).bind("beforeunload", function(event){
             // Run rank calculation
             //return event.originalEvent.returnValue = "Run this";
             recalculate();
             
        });
        function recalculate(){
            url = "{{url('examMark/rank/ajax')}}?class_room_id=" + $("#class_room_id").val() + "&exam_id=" +  $("#exam_id").val() ;
            $.get(url,function(data){
                alert(data.message);
            });
        }
        function editable(){
            $("#enable-editing").on('change',function(){
                if(this.checked == true){
                    $("#localStorage :input").prop('readonly',false);
                }
                else{
                    $("#localStorage :input").prop('readonly',true);
                }
            });
        }

    </script>
@endsection
