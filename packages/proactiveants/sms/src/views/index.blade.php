@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Short Message Editor
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{url('sms/store')}}" id="sms_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea type="text" class="form-control" id="message" name="message" required></textarea>
                            <p class="help-block" id="text_length">0/{{config('sms.max_sms_length')}} characters</p>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Mobile Numbers</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Phone numbers divided by commas. Eg: 077123123, 075123123">
                            <p class="help-block">Send message only these numbers.</p>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="none" checked>
                                None
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="entire_students">
                                Entire School (Students' Parents)
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="entire_teachers">
                                Entire School (Teachers)
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="house">
                                House
                            </label>
                        </div>
                        <select class="form-control select2" multiple id="house[]" name="house[]">
                            <option value="0"></option>
                            @foreach ($houses as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="cluster">
                                Cluster
                            </label>
                        </div>
                        <select class="form-control select2" multiple id="cluster[]" name="cluster[]">
                            <option value="0"></option>
                            @foreach ($clusters as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="section">
                                Section
                            </label>
                        </div>
                        <select class="form-control select2" multiple id="section[]" name="section[]">
                            <option value="0"></option>
                            @foreach ($sections as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="grade">
                                Grade
                            </label>
                        </div>
                        <select class="form-control select2" multiple id="grade[]" name="grade[]">
                            <option value="0"></option>
                            @foreach ($grades as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="class_room">
                                Class Room
                            </label>
                        </div>
                        <select class="form-control select2" multiple id="class_room[]" name="class_room[]">
                            <option value="0"></option>
                            @foreach ($class_rooms as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="type" value="teacher">
                                Teacher
                            </label>
                        </div>
                        <select class="form-control select2" multiple id="teacher[]" name="teacher[]">
                            <option value="0"></option>
                            @foreach ($teachers as $item)
                                <option value="{{$item->id}}">{{$item->fullName}}</option>
                            @endforeach
                        </select>
                        <div class="checkbox">
                            <label class="checkbox-inline">
                            <input type="checkbox" id="chk_father" name="chk_father" value="1" checked> Father Mobile</label>
                            <label class="checkbox-inline">
                            <input type="checkbox" id="chk_mother" name="chk_mother" value="1"> Mother Mobile</label>
                            <label class="checkbox-inline">
                            <input type="checkbox" id="chk_guardian" name="chk_guardian" value="1"> Guardian Mobile</label>
                        </div>
                        <button type="submit" class="btn btn-success" id="submit_btn">Send Message</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Short Message Counter
                </div>
                <div class="panel-body">
                    <table class="table table-border">
                        <thead>
                            <tr><th>Month</th><th>Count</th></tr>    
                        </thead>   
                        <tbody>
                            @foreach ($sms_count as $item)
                                <tr>
                                    <td>{{$item->sms_year}} / {{$item->sms_month}}</td>
                                    <td>{{$item->sms_count}}</td>
                                </tr>
                            @endforeach    
                        </tbody> 
                    </table>                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function(){
            $('.select2').select2();
            $("#sms_form").submit(function(e){
                $("#submit_btn").attr("disabled", true);
                $("#submit_btn").text('Proccessing...');
                return true;
            });
            $("#message").keyup(function(){
                $("#text_length").html($("#message").val().length + '/{{config('sms.max_sms_length')}} characters')
            })
        });
        
    </script>
@endsection