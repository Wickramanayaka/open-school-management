<div class="modal fade" tabindex="-1" role="dialog" id="report-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Progress Report</h3>
        </div>
        <div class="modal-body">
            <p class="text-right">
                Admission Number : {{$student->admission_number}}<br>
                Student Name : {{$student->fullName}}<br>
                @if(!$exam_rank==null)
                    Class : {{$exam_rank->class_room->name}}
                @endif
            </p>
            <p class="text-center"><b>{{$exam->name}}</b></p>
            <table class="table table-bordered">
                <tr><th class="text-left">Subject</th><th class="text-center">Mark</th></tr>
                @foreach ($exam_marks as $item)
                    <tr>
                        <td class="text-left">{{$item->subject->code}} - {{$item->subject->name}} ({{$item->subject->language->name}})</td>
                        @if($item->is_absent==0)
                            <td class="text-center">{{$item->mark}}</td>
                        @else
                            <td class="text-center">ab</td>
                        @endif
                    </tr>
                @endforeach
            </table>
            @if(!$exam_rank==null)
            <p class="text-center">
                Total Marks : {{$exam_rank->total}} |
                Average : {{number_format($exam_rank->average,2)}} |
                Rank : <b>{{$exam_rank->rank}}</b>
            </p>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
