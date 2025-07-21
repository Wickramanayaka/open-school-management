<form method="POST" action="{{route('teacher.resign',$teacher->id)}}">
    {{ csrf_field() }}
    <div class="modal fade" tabindex="-1" role="dialog" id="resign-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Resignation</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">Reason To Leave</label>
                    <input type="text" name="reason_left" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Date</label>
                    <input type="text" name="date_left" id="affective_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="teacher_id" value="{{$teacher->id}}" />
    <input type="hidden" name="is_left" value="1" />
</form>