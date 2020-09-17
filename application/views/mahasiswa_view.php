<div class="container">
    <div class="row mt-4">
        <div class="col d-flex justify-content-between">
            <button type="button" class="btn btn-primary btnCreate">Create</button>
            <button type="button" class="btn btn-primary btnRead">Read</button>
        </div>
    </div>
    <div class="row mt-4" style="min-height: 400px;">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Npm</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tableLoadMahasiswa">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <nav id='pagination'></nav>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="modalForm">
    <div class="modal-dialog">
        <form class="modal-content" id="formMahasiswa">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="npm">Npm</label>
                    <input type="text" class="form-control" name="npm" placeholder="">
                    <div id="npmError" class="mt-1"></div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="">
                    <div id="namaError" class="mt-1"></div>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select class="form-control" name="id_jurusan">
                        <option value=""></option>
                        <?php foreach ($dataJurusan as $row) : ?>
                            <option value="<?= $row->id; ?>"><?= $row->nama_jurusan; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div id="jurusanError" class="mt-1"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalConfirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>