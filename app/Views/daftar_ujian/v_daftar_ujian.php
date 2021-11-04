<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Group Soal</th>
                    <th>Mapel</th>
                    <th>Waktu</th>
                    <th>Jumlah Soal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($daftar_ujian as $key => $value) { ?>
                    <tr class="text-center ">
                        <td><?= $no++; ?></td>
                        <td><?= $value['namagroup']; ?></td>
                        <td><?= $value['mapel']; ?></td>
                        <td><?= $value['waktu']; ?> Menit</td>
                        <td><?= $value['rangesoal']; ?> Soal</td>
                        <td>
                            <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-token<?= $value['idujian'] ?>"><i class="fas fa-stopwatch"></i> Ambil Ujian</button>
                        </td>
                    </tr>


                    <div class="modal fade" id="modal-token<?php echo $value['idujian']; ?>" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title">Masukan Token Soal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- END Modal Header -->

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form action="<?= base_url('daftarujian/prosesujian/' . $value['idujian']) ?>" method="post">
                                        <input type="hidden" name="idujian" value="<?php echo $value['idujian']; ?>">
                                        <div class="form-group">
                                            <label>Token Soal</label>
                                            <div>
                                                <input placeholder="Token Soal" value="" name="token" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group form-actions">
                                            <div>
                                                <button type="submit" name="submit" class="btn btn-sm btn-primary">Masuk</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END Modal Body -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->