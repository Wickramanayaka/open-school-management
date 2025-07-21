@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('partials.alert')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Available template words.</h3>
            <ul>
                <li>&lt;student&gt; - Student full name</li>
                <li>&lt;date&gt; - Today</li>
                <li>&lt;school&gt; - School name</li>
                <li>&lt;class&gt; - Class room name</li>
                <li>&lt;admission&gt; - Admission number</li>
            </ul>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Template for Absent
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{url('sms/template/store/')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea rows="10" type="text" class="form-control" id="message" name="message">{{$templates->take(1)->last()->message}}</textarea>
                            <p class="help-block">{{$templates->take(1)->last()->length}}/{{config('sms.max_sms_length')}} characters</p>
                        </div>
                        <input type="hidden" name="id" id="id" value="{{$templates->take(1)->last()->id}}">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        {{--<div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Template for Discipline
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{url('sms/template/store/')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea rows="10" type="text" class="form-control" id="message" name="message">{{$templates->take(2)->last()->message}}</textarea>
                            <p class="help-block">{{$templates->take(2)->last()->length}}/{{config('sms.max_sms_length')}} characters</p>
                        </div>
                        <input type="hidden" name="id" id="id" value="{{$templates->take(2)->last()->id}}">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection