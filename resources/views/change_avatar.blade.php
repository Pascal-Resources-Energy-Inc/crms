<div class="modal fade" id="uploadAvatarModal" tabindex="-1" role="dialog" aria-labelledby="avatarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ url('avatar') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload or Take Photo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="avatar">Camera / File</label>
            <input 
              type="file"
              name="avatar"
              id="avatar"
              class="form-control-file"
              accept="image/*"
              capture="environment"  <!-- 'environment' = back camera, 'user' = front camera -->
              required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Upload</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>