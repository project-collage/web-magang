<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Ujian</th>
                    <th>Jenis Soal</th>
                    <th>TWK</th>
                    <th>TIU</th>
                    <th>TKP</th>
                    <th>Nilai</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($nilai_siswa as $key => $value) { ?>
                    <tr class="text-center ">
                        <td><?= $no++; ?></td>
                        <td><?= $value['tgl']; ?></td>
                        <td><?= $value['namagroup']; ?></td>
                        <td><?= $value['nilai_twk']; ?></td>
                        <td><?= $value['nilai_tiu']; ?></td>
                        <td><?= $value['nilai_tkp']; ?></td>
                        <td><?= $value['nilai']; ?></td>
                        <td><?php if ($value['nilai'] > 300) {
                                echo "<p style='background-color:green; color:white; border-radius: 5px'>" . "Lulus" . "</p>";
                            } else {
                                echo "<p style='background-color:red; color:white; border-radius: 5px'>" . "Tidak Lulus" . "</p>";
                            } ?></td>
                        <td>
                            <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download Nilai</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->