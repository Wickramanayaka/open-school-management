@php
    $points = ProactiveAnts\Discipline\PointBalance::where('student_id',$student->id)->orderBy('created_at')->get(); 
    $points_academic_year = ProactiveAnts\Discipline\PointBalance::where('student_id',$student->id)
    ->where('created_at','>=', getCurrentAcademicYear()->start)
    ->where('created_at','<=', getCurrentAcademicYear()->end)
    ->orderBy('created_at')
    ->get();   
@endphp
<div class="row">
    <div class="col-lg-12 text-right">
        <h2><div  class="label label-success">Current Balance is : {{$points_academic_year->sum('point') - $points_academic_year->sum('deduct')}}</div></h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <table class="table table-borderless">
                @foreach ($points as $item)
                    <tr>
                        @switch($item->type)
                            @case("ALLOCATED")
                                <td  style="padding: 16px;">
                                    {{$item->created_at->format('Y-m-d')}} Annual point allocation by college
                                </td>
                                <td style="padding: 16px; font-size:16px" class="text-right text-primary">
                                    <b><i class="fa fa-gift fa-fw"></i>{{$item->point}}</b>
                                </td>
                                @break
                            @case("EARN")
                                <td style="padding: 16px;">
                                    {{$item->created_at->format('Y-m-d')}} Monthly point earn by student
                                </td>
                                <td style="padding: 16px; font-size:16px" class="text-right text-success">
                                    <b><i class="fa fa-arrow-up fa-fw"></i>+{{$item->point}}</b>
                                </td>
                                @break
                            @default
                            <td style="padding: 16px;">
                                {{$item->created_at->format('Y-m-d')}} Point deduct by {{ $item->teacher->fullName}} becuase of {{$item->disobedience->name}}
                            </td>
                            <td style="padding: 16px; font-size:16px" class="text-right text-danger">
                                <b><i class="fa fa-arrow-down fa-fw"></i>-{{$item->deduct}}</b>
                            </td>    
                        @endswitch
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
