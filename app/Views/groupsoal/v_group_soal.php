<h1> <?= $title ?></h1>

<div class="card">

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
                        <td><?= $value['namauser']; ?></td>
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
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit<?= $value['idgurumapel'] ?>"><i class="fas fa-download"></i></button>
                            <a href="<?= base_url('detailsoal/detail_soal/' . $value['idgroup']) ?>"><i class="fas fa-eye btn btn-sm btn-success"></i></a>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['idgroup'] ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" disabled><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- modal edit -->
<?php foreach ($soal as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['idgroup']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Verifikasi Group Soal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('groupsoal/verifikasi_group_soal/' . $value['idgroup']) ?>
                    <div class="form-group">
                        <label>Verifikasi Soal</label>
                        <select class="form-control" name="status" required>
                            <option value="<?= $value['statusgrup'] ?>"><?php if ($value['statusgrup'] == "Y") {
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