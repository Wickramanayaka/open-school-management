@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Term Test Progress Report
                </div>
                <div class="panel-body">
                <form method="GET" action="{{route('reports.term')}}" target="_blank">
                    <div class="row">
                        <div class="col-md-6 filter-box-first">
                            <h3>Sections</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Class Room</label>
                                        <select class="form-control" id="class_room" name="class_room">
                                            @foreach ($class_rooms as $class_room)
                                            <option value="{{$class_room->id}}">{{$class_room->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 filter-box-first">
                            <h3>Selections</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Examination</label>
                                        <select class="form-control" id="exam" name="exam">
                                            @foreach ($exams as $exam)
                                            <option value="{{$exam->id}}">{{$exam->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-default">Download</button>
                    </form>
                </div>
                <div class="panel-footer">
                    <p><strong>Follow the below instructions for A/L section progress reports.</strong></p>
                    <p>Each year second term final exam is equal to A/L section first term final exam.<br>
                    Each year third term final exam is equal to A/L section second term final exam.<br>
                    Each year first term final exam is equal to A/L section last year third term final exam.<br>
                    <i>Eg: 2017 Second Term Final Exam = 2017 A/L First Term Final Exam.</i><br>
                    <i>Eg: 2017 Third Term Final Exam = 2017 A/L Second Term Final Exam.</i><br>
                    <i>Eg: 2018 First Term Final Exam = 2017 A/L Third Term Final Exam.</i><br>
                </p>
                </div>
            </div>
        </div>
    </div>
@endsection