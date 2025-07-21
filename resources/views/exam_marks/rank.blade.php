@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Rank Incomplete</div>
                <div class="panel-body">
                    <ul class="nav nav-stack">
                        @foreach ($ranks as $rank)
                            <li><a href="{{route('examMark.rank',['class_room' => $rank->class_room_id, 'exam' => $rank->exam_id])}}" class="btn btn-warning">Class Room {{$rank->class_room->name}} for exam {{$rank->exam->name}} needs to be re-ranked. Click here. </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection