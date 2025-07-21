<div id="loader" class="text-center text-primary" style="display:none;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:18px;"></i> <span style="font-size:18px;"> Loading...</span></div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <table class="table">
                <tr class="warning">
                    <th>Assignment</th><th>Year</th><th>Exam Date</th><th>&nbsp;</th>
                </tr>
                @foreach ($exam_marks as $exam_mark)
                @if($exam_mark->exam->has_rank)
                @else
                <tr>
                <td>{{$exam_mark->exam->name}}</td><td>{{$exam_mark->exam->academic_year->name}}</td><td>{{$exam_mark->exam->start}}</td><td class="text-right"><a class="btn btn-primary" href="#" onclick="getReport({{$student->id}},{{$exam_mark->exam->id}})">View Marks</a></a></td>
                </tr>
                @endif
                @endforeach

            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <table class="table">
                <tr class="warning">
                    <th>Examination</th><th>Total</th><th>Average</th><th>Class 1st Average</th><th>Rank</th><th>&nbsp;</th>
                </tr>
                @foreach ($exam_ranks as $rank)
                <tr>
                <td>{{$rank->exam->name}}</td><td>{{$rank->total}}</td><td>{{number_format($rank->average,2)}}</td><td>{{number_format($rank->rank_one_average,2)}}</td><td>{{$rank->rank}}</td><td class="text-right"><a class="btn btn-info" href="#" onclick="getReport({{$student->id}},{{$rank->exam->id}})">Progress Report</a></td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
<div id="ajax-data"></div>