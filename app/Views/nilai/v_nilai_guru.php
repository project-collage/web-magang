<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-body">
        <div class="block full">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Group Soal</th>
                            <th class="text-center">Mapel</th>
                            <th class="text-center">Jumlah Peserta</th>
                            <th class="text-center">Status Ujian</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mysqli = new mysqli('localhost', 'root', '', 'pkl');
                        $no = 1;
                        if (session()->get('status') == 'admin') {
                            foreach ($nilai_admin as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $value['namagroup']; ?></td>
                                    <td class="text-center"><?php echo $value['mapel']; ?></td>
                                    <td class="text-center"><?php

                                                            $j = mysqli_query($mysqli, "select * from nilai where idujian = '$value[idujian]'");
                                                            $jumlah = mysqli_num_rows($j);
                                                            echo $jumlah;
                                                            ?></td>
                                    <td class="text-center"><?php if ($value['status'] == 'aktif') {
                                                                echo '<span style="background-color:green; padding:5px; color:white; border-radius: 5px">Aktif</span>';
                                                            } else {
                                                                echo '<span style="background-color:red; color:white; padding:5px; border-radius: 5px">Tidak Aktif</span>';
                                                            } ?></td>
                                    <!--<td class="text-center"></td>-->
                                    <td class="text-center">
                                        <form action="<?= base_url('nilaiujian') ?>" method="post">
                                            <input type="hidden" name="idujian" value="<?php echo $value['idujian']; ?>">
                                            <input type="hidden" name="groupsoal" value="<?php echo $value['namagroup']; ?>">
                                            <input type="hidden" name="mapel" value="<?php echo $value['mapel']; ?>">
                                            <button class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Lihat Nilai</a></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } elseif (session()->get('status') == 'guru') {
                            foreach ($nilai_guru as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $value['namagroup']; ?></td>
                                    <td class="text-center"><?php echo $value['mapel']; ?></td>
                                    <td class="text-center"><?php

                                                            $j = mysqli_query($mysqli, "select * from nilai where idujian = '$value[idujian]'");
                                                            $jumlah = mysqli_num_rows($j);
                                                            echo $jumlah;
                                                            ?></td>
                                    <td class="text-center"><?php if ($value['status'] == 'aktif') {
                                                                echo '<span style="background-color:green; padding:5px; color:white; border-radius: 5px">Aktif</span>';
                                                            } else {
                                                                echo '<span style="background-color:red; color:white; padding:5px; border-radius: 5px">Tidak Aktif</span>';
                                                            } ?></td>
                                    <!--<td class="text-center"></td>-->
                                    <td class="text-center">
                                        <form action="<?= base_url('nilaiujian') ?>" method="post">
                                            <input type="hidden" name="idujian" value="<?php echo $value['idujian']; ?>">
                                            <input type="hidden" name="groupsoal" value="<?php echo $value['namagroup']; ?>">
                                            <input type="hidden" name="mapel" value="<?php echo $value['mapel']; ?>">
                                            <button class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Lihat Nilai</a></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>