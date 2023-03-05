<div class="modal fade" id="modal-edit">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-edit-artikel" method="post" action="javascript:void(0)">
            @csrf
            @method('PUT')
            <input type="hidden" id="id-artikel">
            <div class="form-group">
              <label for="judul" class="col-form-label">Judul:</label>
              <input type="text" class="form-control" name="judul" id="judul-edit">
            </div>
            <div class="form-group">
                <label for="kategori" class="col-form-label">Kategori:</label>
                <input type="text" class="form-control" name="kategori" id="kategori-edit">
              </div>
            <div class="form-group">
              <label for="deskripsi" class="col-form-label">Deskripsi:</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi-edit" rows="15"></textarea>
            </div>
   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="submit-edit" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>