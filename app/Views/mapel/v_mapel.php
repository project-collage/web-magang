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
                    <th>Kode Mapel</th>
                    <th>Mapel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($mapel as $key => $value) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $value['kdmapel']; ?></td>
                        <td><?= $value['mapel']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['idmapel'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $value['idmapel'] ?>"><i class="fas fa-trash-alt"></i></button>
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
                <h4 class="modal-title">Tambah Mapel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('mapel/tambah_mapel') ?>
                <div class="form-group">
                    <label>Kode Mapel</label>
                    <input class="form-control" name="kode_mapel" placeholder="Masukan Kode Mapel" required>
                </div>
                <div class="form-group">
                    <label>Mapel</label>
                    <input class="form-control" name="nama_mapel" placeholder="Masukan Mapel" required>
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
<?php foreach ($mapel as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['idmapel']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Mapel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('mapel/edit_mapel/' . $value['idmapel']) ?>
                    <div class="form-group">
                        <label>Kode Mapel</label>
                        <input class="form-control" value="<?= $value['kdmapel']; ?>" name="kdmapel" placeholder="Masukan Kode Mapel" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Mapel</label>
                        <input class="form-control" value="<?= $value['mapel']; ?>" name="nama_mapel" placeholder="Masukan Nama Mapel" required>
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
<?php foreach ($mapel as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['idmapel']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Mapel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus <?= $value['mapel']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('mapel/hapus_mapel/' . $value['idmapel']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>