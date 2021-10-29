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
                    <th>Guru Mapel</th>
                    <th>Jenis Kelamin</th>
                    <th>Mapel</th>
                    <th>Tahun</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($guru as $key => $value) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $value['namauser']; ?></td>
                        <td><?= $value['jk']; ?></td>
                        <td><?= $value['mapel']; ?></td>
                        <td><?= $value['tahun']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['idgurumapel'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $value['idgurumapel'] ?>"><i class="fas fa-trash-alt"></i></button>
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
                <h4 class="modal-title">Tambah Guru Mapel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('gurupelajaran/tambah_guru_pelajaran') ?>
                <div class="form-group">
                    <label>Nama Guru</label>
                    <select class="form-control" name="namaguru" required>
                        <option value=""></option>
                        <?php foreach ($dropdown_guru as $key => $value) { ?>
                            <option value="<?= $value['iduser']; ?>"><?= $value['namauser']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mapel</label>
                    <select class="form-control" name="mapel" required>
                        <option value=""></option>
                        <?php foreach ($dropdown_mapel as $key => $value) { ?>
                            <option value="<?= $value['idmapel']; ?>"><?= $value['mapel']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <select class="form-control" name="tahun" required>
                        <option value=""></option>
                        <?php foreach ($dropdown_tahun as $key => $value) { ?>
                            <option value="<?= $value['idtahun']; ?>"><?= $value['tahun']; ?></option>
                        <?php } ?>
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
<?php foreach ($guru as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['idgurumapel']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Guru Mapel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('gurupelajaran/edit_guru_pelajaran/' . $value['idgurumapel']) ?>
                    <div class="form-group">
                        <label>Nama Guru</label>
                        <select class="form-control" name="namaguru" required>
                            <option value="<?= $value['iduser']; ?>"><?= $value['namauser']; ?></option>
                            <?php foreach ($dropdown_guru as $key => $value) { ?>
                                <option value="<?= $value['iduser']; ?>"><?= $value['namauser']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mapel</label>
                        <select class="form-control" name="mapel" required>
                            <option value=""></option>
                            <?php foreach ($dropdown_mapel as $key => $value) { ?>
                                <option value="<?= $value['idmapel']; ?>"><?= $value['mapel']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select class="form-control" name="tahun" required>
                            <option value=""></option>
                            <?php foreach ($dropdown_tahun as $key => $value) { ?>
                                <option value="<?= $value['idtahun']; ?>"><?= $value['tahun']; ?></option>
                            <?php } ?>
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
<?php foreach ($guru as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['idgurumapel']; ?>">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Guru Mapel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus Guru <?= $value['namauser']; ?> dengan mapel <?= $value['mapel'] ?>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('gurupelajaran/hapus_guru_pelajaran/' . $value['idgurumapel']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>