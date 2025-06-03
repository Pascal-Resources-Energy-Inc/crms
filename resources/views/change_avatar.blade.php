<div id="uploadAvatarModal" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="myModalLabel">
          Change Avatar
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form method='POST' action='{{url('change-avatar')}}' onsubmit='show()' enctype="multipart/form-data" class="validation-wizard wizard-circle mt-5">
      @csrf
      <div class="modal-body">
       </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-danger-subtle text-danger  waves-effect"
          data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn bg-info-subtle text-info  waves-effect">
          Submit
        </button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
<!-- /.modal-dialog -->
</div>