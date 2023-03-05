<div class="modal fade" id="modal-add">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-create-artikel" method="post" action="javascript:void(0)">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="judul" class="col-form-label">Judul:</label>
              <input type="text" class="form-control" name="judul" id="judul">
            </div>
            <div class="form-group">
                <label for="kategori" class="col-form-label">Kategori:</label>
                <input type="text" class="form-control" name="kategori" id="kategori">
              </div>
            <div class="form-group">
              <label for="deskripsi" class="col-form-label">Deskripsi:</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi" rows="15"></textarea>
            </div>
   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="submit-add" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>