<form method="POST" enctype="multipart/form-data" action="{{route('teacher.photoUpload')}}">
{{ csrf_field() }}
<div class="modal fade" tabindex="-1" role="dialog" id="photo-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Photo Upload</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="photo" name="photo" required accept="image/*">
                <p class="help-block">Allowed file extensions png, jpg, gif, tiff. Maximum upload size 1MB.</p>
              </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<input type="hidden" name="id" value="{{$teacher->id}}" />
</form>