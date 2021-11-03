<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-header">
        <div class="row" style="padding: 10px;">
            <button type="button" class="btn btn-primary btn-sm" style="margin-right: 10px;" data-toggle="modal" data-target="#modal-default">Tambah Group Soal</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Guru Mapel</th>
                    <th>Tahun Soal</th>
                    <th>Group Soal</th>
                    <th>Mapel</th>
                    <th>Jumlah Soal</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($soal as $key => $value) { ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?php if (session()->get('status') == 'guru') {
                                echo $value['namauser'];
                            } else {
                                echo '';
                            } ?></td>
                        <td><?= $value['tahun']; ?></td>
                        <td><?= $value['namagroup']; ?></td>
                        <td><?= $value['mapel']; ?></td>
                        <td><?php
                            $mysqli = new mysqli('localhost', 'root', '', 'pkl');
                            $j = mysqli_query($mysqli, "select * from soal where idgroup = '$value[idgroup]'");
                            $jumlah = mysqli_num_rows($j);
                            echo $jumlah;
                            ?> Soal </td>

                        <td style="font-size :11px"><?php if ($value['statusgrup'] == 'Y') {
                                                        echo "<p style='background-color:green; color:white; border-radius: 5px'>" . "Verified" . "</p>";
                                                    } else {
                                                        echo "<p style='background-color:red; color:white; border-radius: 5px'>" . "Not Verified" . "</p>";
                                                    } ?></td>
                        <td>
                            <a href="" title="Download Soal" class="btn btn-sm btn-info">
                                <i class="fas fa-download"></i></a>
                            <a href="<?= base_url('detailsoal/detail_soal/' . $value['idgroup']) ?>" title="Detail" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <button class="btn btn-sm btn-primary" title="Edit Soal" data-toggle="modal" data-target="#modal-edit<?= $value['idgroup'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" title="Hapus Soal" data-target="#modal-hapus<?= $value['idgroup'] ?>"><i class="fas fa-trash-alt"></i></button>
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
                <h4 class="modal-title">Tambah Group Soal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('gurusoal/tambah_group_soal') ?>
                <div class="form-group">
                    <label>Nama Guru</label>
                    <select class="form-control" name="nama_guru" id="">
                        <?php foreach ($guru_pelajaran as $key => $value) { ?>
                            <option value="<?= $value['idgurumapel'] ?>"><?= $value['namauser']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Group Soal</label>
                    <input class="form-control" name="group_soal" placeholder="Masukan Group Soal" required>
                </div>
                <div class="form-group">
                    <label>Mapel</label>
                    <select class="form-control" name="mapel" required>

                        <?php foreach ($dropdown_mapel as $key => $value) { ?>
                            <option value="<?= $value['idmapel']; ?>"><?= $value['mapel']; ?></option>
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
<?php foreach ($soal as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['idgroup']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Group Soal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('gurusoal/edit_group_soal/' . $value['idgroup']) ?>
                    <div class="form-group">
                        <label>Group Soal</label>
                        <input class="form-control" value="<?= $value['namagroup'] ?>" type="text" name="groupsoal" id="">
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
<?php foreach ($soal as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['idgroup']; ?>">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Group Soal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus Group Soal <?= $value['namagroup']; ?>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('gurusoal/hapus_group_soal/' . $value['idgroup']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>