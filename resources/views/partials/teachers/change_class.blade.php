<form method="POST" action="{{route('teacher.changeClass')}}">
    {{ csrf_field() }}
    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Change Class</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">Class Room</label>
                    <select class="form-control" name="class_room_id" id="class_room_id" required>
                        @foreach ($class_rooms as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Date</label>
                    <input type="text" name="date" id="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Change</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <input type="hidden" name="teacher_id" value="{{$teacher->id}}" />
</form>