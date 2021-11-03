<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-header">
        <div class="row" style="padding: 10px;">
            <button type="button" class="btn btn-primary btn-sm" style="margin-right: 10px;" data-toggle="modal" data-target="#modal-default">Tambah Ujian</button>

        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Token</th>
                    <th>GroupSoal</th>
                    <th>Mapel</th>
                    <th>Waktu</th>
                    <th>Jumlah Soal</th>
                    <th>Status Ujian</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($ujian as $key => $value) { ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= $value['token']; ?></td>
                        <td><?= $value['namagroup']; ?></td>
                        <td><?= $value['mapel']; ?></td>
                        <td><?= $value['waktu']; ?> menit</td>
                        <td><?= $value['rangesoal']; ?></td>
                        <td style="font-size :11px"><?php if ($value['status'] == 'aktif') {
                                                        echo "<p style='background-color:green; color:white; border-radius: 5px'>" . "Aktif" . "</p>";
                                                    } else {
                                                        echo "<p style='background-color:red; color:white; border-radius: 5px'>" . "Tidak Aktif" . "</p>";
                                                    } ?></td>

                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['idujian'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $value['idujian'] ?>"><i class="fas fa-trash-alt"></i></button>
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
                <h4 class="modal-title">Tambah Ujian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('setujian/tambah_ujian') ?>
                <div class="form-group">
                    <label>Group Soal</label>
                    <select class="form-control" name="groupsoal" required>
                        <?php foreach ($dropdown_group as $key => $value) { ?>
                            <option value="<?= $value['idgroup']; ?>"><?= $value['namagroup']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Soal</label>
                    <input class="form-control" name="range_soal" placeholder="Range Soal" required>
                </div>
                <div class="form-group">
                    <label>Waktu</label>
                    <input class="form-control" name="waktu" placeholder="Waktu Ujian" required>
                </div>
                <div class="form-group">
                    <label>Token</label>
                    <input class="form-control" name="token" placeholder="Kode Ujian" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required id="">
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Soal</label>
                    <select name="jenis_soal" class="form-control" required id="">
                        <option value="1">CPNS</option>
                        <option value="2">PPPK</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Set Ujian</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal edit -->
<?php foreach ($ujian as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['idujian']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Group Soal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('setujian/edit_ujian/' . $value['idujian']) ?>
                    <div class="form-group">
                        <label>Group Soal</label>
                        <select class="form-control" name="groupsoal" required>
                            <option value="<?= $value['idgroup'] ?>"><?= $value['namagroup']; ?></option>
                            <?php foreach ($dropdown_group as $key => $values) { ?>
                                <option value="<?= $values['idgroup']; ?>"><?= $values['namagroup']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Soal</label>
                        <input class="form-control" value="<?= $value['rangesoal']; ?>" name="jml_soal" placeholder="Masukan Jumlah Soal" required>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input class="form-control" value="<?= $value['waktu']; ?>" name="waktu" placeholder="Masukan Waktu Ujian" required>
                    </div>
                    <div class="form-group">
                        <label>Token</label>
                        <input class="form-control" value="<?= $value['token']; ?>" name="token" placeholder="Masukan Token Ujian" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="<?= $value['status'] ?>"><?php if ($value['status'] == "aktif") {
                                                                        echo 'Aktif';
                                                                    } else {
                                                                        echo 'Tidak Aktif';
                                                                    } ?></option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Soal</label>
                        <select class="form-control" name="jnssoal" required>
                            <option value="<?= $value['jnssoal'] ?>"><?php if ($value['jnssoal'] == "1") {
                                                                            echo 'CPNS';
                                                                        } else {
                                                                            echo 'PPPK';
                                                                        } ?></option>
                            <option value="1">CPNS</option>
                            <option value="2">PPPK</option>
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
<?php foreach ($ujian as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['idujian']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus Ujian <?= $value['namagroup']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('setujian/hapus_ujian/' . $value['idujian']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>