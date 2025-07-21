@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span style="font-size:16pt; font-weight:700;">Syllabus for {{$subject->name}} - Grade {{$subject->grade->name}}</span><br>
                    Medium - {{$subject->language->name}}
                </div>
                <div class="panel-body">
                <form class="form-inline" method="POST" action="{{route('chapter.store')}}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" id="number" name="number" placeholder="Number" required>
                        </div>
                        <div class="form-group">
                            <input size="50" type="text" class="form-control" id="name" name="name" placeholder="Chapter Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="number_of_period" name="number_of_period" placeholder="Number of Minutes" required>
                        </div>
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <hr/>
                    <table class="table table-striped">
                        <tr>
                            <th>Number</th><th>Name</th><th>Length (min)</th><th>Covered (min)</th><th></th>
                        </tr>
                        @foreach ($chapters as $chapter)
                            <tr>
                                <td>{{$chapter->number}}</td>
                                <td>{{$chapter->name}}</td>
                                <td>{{$chapter->number_of_period}}</td>
                                <td>
                                    @php
                                    $coverages = ProactiveAnts\Coverage\ChapterCoverage::where('chapter_id', $chapter->id)->get();
                                    $chapter_complete = 0;
                                    foreach($coverages as $coverage){
                                        // Get period and get the time duration
                                        $period = ProactiveAnts\Coverage\Period::find($coverage->period_id);
                                        if($period->time_out==null){

                                        }
                                        else{
                                            $duration = $period->time_out->diffInMinutes($period->time_id);
                                            $chapter_complete = $chapter_complete + $duration;
                                        }
                                        
                                    }
                                    echo $chapter_complete;
                                    @endphp
                                </td>
                                <td class="text-right">
                                    <form action="{{route('chapter.destroy',$chapter->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a class="btn btn-primary" href="{{route('chapter.edit',$chapter->id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>    
                </div>
            </div>
        </div>
    </div>
@endsection