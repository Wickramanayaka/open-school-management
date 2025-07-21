<form method="POST" action="{{route('student.leave',$student->id)}}">
    {{ csrf_field() }}
    <div class="modal fade" tabindex="-1" role="dialog" id="leave-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Leaving of School</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">Reason To Leave</label>
                    <input type="text" name="reason_left" id="reason_left" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Date</label>
                    <input type="text" name="date_left" autocomplete="off" id="date_left" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="teacher_id" value="{{$student->id}}" />
    <input type="hidden" name="is_left" value="1" />
</form>
