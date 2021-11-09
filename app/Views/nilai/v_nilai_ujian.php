<?php $mysqli = new mysqli('localhost', 'root', '', 'pkl'); ?>

<h1> <?= $title ?></h1>

<?php $idujian = $_POST['idujian'];
$groupsoal = $_POST['groupsoal'];
$mapel = $_POST['mapel']; ?>

<div class="card">
    <div class="card-header">

        <button class="btn btn-sm btn-success">Export Ke Excel</button>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Tgl Ujian</th>
                        <th class="text-center">Jenis Soal</th>
                        <th class="text-center">TWK</th>
                        <th class="text-center">TIU</th>
                        <th class="text-center">TKP</th>
                        <th class="text-center">Nilai</th>
                        <th class="text-center">Actions</th>
                        <?php
                        $tampil = mysqli_query(
                            $mysqli,
                            "select u.*, n.*, s.*, gs.namagroup, gs.idgroup, m.*
                    from nilai as n
                    inner join user as u
                    on u.iduser = n.iduser 
                    inner join setujian as s
                    on s.idujian = n.idujian
                    inner join groupsoal as gs
                    on gs.idgroup = s.idgroup
                    inner join gurumapel as gm
                    on gm.idgurumapel = gs.idgurumapel
                    inner join mapel as m
                    on m.idmapel = gm.idmapel
                    where n.idujian = '$idujian'
                    "
                        );
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($hasil = mysqli_fetch_array($tampil)) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $hasil['namauser']; ?></td>
                            <td class="text-center"><?php echo $hasil['tgl']; ?></td>
                            <td class="text-center"><?php echo $hasil['namagroup']; ?></td>
                            <td class="text-center"><?php echo $hasil['nilai_twk']; ?></td>
                            <td class="text-center"><?php echo $hasil['nilai_tiu']; ?></td>
                            <td class="text-center"><?php echo $hasil['nilai_tkp']; ?></td>
                            <td class="text-center"><?php echo $hasil['nilai']; ?></td>
                            <td class="text-center"><?php
                                                    if ($hasil['nilai'] >= '300') {
                                                        echo "<p style='background-color:green; color:white; border-radius: 5px'>" . "Lulus" . "</p>";
                                                    } else {
                                                        echo "<p style='background-color:red; color:white; border-radius: 5px'>" . "Tidak Lulus" . "</p>";
                                                    } ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $hasil['idnilai'] ?>"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal delete -->
<?php foreach ($nilai_peserta as $key => $hasil) { ?>
    <div class="modal fade" id="modal-hapus<?= $hasil['idnilai']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Nilai Peserta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus Nilai Peserta <?= $hasil['namauser']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('nilai/hapus_nilai/' . $hasil['idnilai']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>