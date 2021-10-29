<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-header">
        <div class="row" style="padding: 10px;">
            <button type="button" class="btn btn-primary btn-sm" style="margin-right: 10px;" data-toggle="modal" data-target="#modal-default">Tambah</button>
            <button type="button" class="btn btn-success btn-sm" style="margin-right: 10px;">Import dari Excel</button>
            <button type="button" class="btn btn-success btn-sm" style="margin-right: 10px;">Export ke Excel</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tahun as $key => $value) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $value['tahun']; ?></td>
                        <td><?php if ($value['status'] == "Y") {
                                echo 'Aktif';
                            } else {
                                echo 'Tidak Aktif';
                            } ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['idtahun'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $value['idtahun'] ?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- modal add -->
<div class=" modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('tahunajaran/tambah_tahun_ajaran') ?>
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <input class="form-control" name="tahun_ajaran" placeholder="Masukan Tahun Ajaran" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="Y">Aktif</option>
                        <option value="N">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal edit -->
<?php foreach ($tahun as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['idtahun']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Tahun Ajaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('tahunajaran/edit_tahun_ajaran/' . $value['idtahun']) ?>
                    <div class="form-group">
                        <label>Tahun ajaran</label>
                        <input class="form-control" value="<?= $value['tahun']; ?>" name="tahun" placeholder="Masukan Tahun Ajaran" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="<?= $value['status'] ?>"><?php if ($value['status'] == "Y") {
                                                                        echo 'Aktif';
                                                                    } else {
                                                                        echo 'Tidak Aktif';
                                                                    } ?></option>
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<!-- modal delete -->
<?php foreach ($tahun as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['idtahun']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Tahun Ajaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus tahun ajaran <?= $value['tahun']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('tahunajaran/hapus_tahun_ajaran/' . $value['idtahun']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>