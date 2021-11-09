<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 60%;
    }

    #sortable li {
        margin: 0 3px 3px 3px;
        padding: 0.4em;
        padding-left: 1.5em;
        height: 30px;
    }

    #sortable li span {
        position: absolute;
        margin-left: -1.3em;
    }
</style>
<?php $mysqli = new mysqli('localhost', 'root', '', 'pkl');
$id = $_SESSION['id'];
$_SESSION['ujian'] = true; ?>
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-table"></i>Data Ujian
        </h1>
    </div>
</div>

<?php
//set session awal dengan nama $_SESSION['mulai']
if (isset($_SESSION['mulai'])) {
    //jika session sudah ada
    $telah_berlalu = time() - $_SESSION['mulai'];
} else {
    //jika session belum ada
    $_SESSION['mulai'] = time();
    $telah_berlalu = 0;
}

//mengambil data waktu dari tabel setujian
$tampil = mysqli_query($mysqli, 'select * from setujian where idujian =' . $_SESSION['idujian']);
$hasil = mysqli_fetch_array($tampil);

//jadikaan detik dan dikurangi waktu yang telah berlalu
$temp_waktu = ($hasil['waktu'] * 60) - $telah_berlalu;
//dijadikan menit
$temp_menit = (int)($temp_waktu / 60);

//sisa bagi untuk detik
$temp_detik = $temp_waktu % 60;

if ($temp_menit < 60) {
    /* Apabila $temp_menit yang kurang dari 60 menit */
    $jam    = 0;
    $menit  = $temp_menit;
    $detik  = $temp_detik;
} else {
    /* Apabila $temp_menit lebih dari 60 menit */
    $jam    = (int)($temp_menit / 60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer 
    $menit  = $temp_menit % 60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
    $detik  = $temp_detik;
}
?>
<!-- Kita membutuhkan jquery, disini saya menggunakan langsung dari jquery.com, jquery ini bisa didownload dan ditaruh dilocal -->

<!-- Script Timer -->



<?php

$tes = 1; //maksimal data yang ditampilkan perhalaman

//jika page sudah pernah diset maka sesuaikan dengan page saat ini
//atau jika belum diseet maka nilainya menjadi 1
$page = isset($_GET['tes']) ? $_GET['tes'] : 1;

$mulai = ($page > 1) ? ($page * $tes) - $tes : 0;

//jjika page berisi kurang dari satu atau kosong maka akan bernilai 1
if (($page < 1) && (empty($page))) {
    $page = 1;
}

//menampilkan data dari database
$tampil = mysqli_query($mysqli, "
select j.*, s.*
from jawaban as j
inner join soal as s
on j.idsoal = s.idsoal 
where 
    j.iduser = '$_SESSION[iduser]' and
    j.idujian = '$_SESSION[idujian]'
");


//menghitung jumlah data yang ada di dalam tabel
$jumlah_data = mysqli_num_rows($tampil);


//jumalh halaman yang akan dihasilkan
//didapat dari jumlah data dibagi item per page
$jumlah_halaman = ceil($jumlah_data / $tes);

$no = $mulai + 1;
$hasil = mysqli_query(
    $mysqli,
    "
select j.*, s.*
from jawaban as j
join soal as s
on j.idsoal = s.idsoal 
where 
    j.iduser = '$_SESSION[iduser]' and
    j.idujian = '$_SESSION[idujian]'
    limit " . $mulai . " , " . $tes
);
while ($data = mysqli_fetch_array($hasil)) {
?>
    <div class="block full">
        <!-- Updates Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                Siswa Waktu <a href="javascript:void(0)" class="btn btn-sm btn-alt btn-default">
                    <div id='timer'></div>
                    <form action="<?= base_url('nilai/proses_nilai') ?>" id="frmSoal" method='POST'>

                    </form>
                </a>
            </div>
            <h2><strong>Soal ke <?php echo $no++; ?> dari <?php echo $jumlah_halaman ?> </strong></h2>
        </div>
        <!-- Update Status Form -->
        <form action="<?= base_url('ujian/proseseditjawaban') ?>" method="post">
            <input type="hidden" name="idjawab" value="<?php echo $data['idjawab']; ?>">
            <input type="hidden" name="soal" value="<?php echo $no; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <input type="hidden" name="halaman" value="<?php echo $jumlah_halaman; ?>">
            <?php
            if ($data['jenissoal'] == 'singlechoice') { ?>
                <table>
                    <tr>
                        <td colspan="2">
                            <p><?php echo $data['soal']; ?></p>
                        </td>
                    </tr>
                    <td valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                <input name="pilihan[]" <?php if ($data['jawaban'] == "a") {
                                                            echo "checked";
                                                        } ?> value="a" type="radio"></span></p>
                    </td>

                    <td valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihana']; ?></span></p>
                    </td>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input name="pilihan[]" <?php if ($data['jawaban'] == "b") {
                                                                echo "checked";
                                                            } ?> value="b" type="radio"></span></p>
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihanb']; ?></span></p>
                        </td>
                    </tr>
                    <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                <input name="pilihan[]" <?php if ($data['jawaban'] == "c") {
                                                            echo "checked";
                                                        } ?> value="c" type="radio"></span></p>
                    </td>
                    <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihanc']; ?></span></p>
                    </td>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input name="pilihan[]" <?php if ($data['jawaban'] == "d") {
                                                                echo "checked";
                                                            } ?> value="d" type="radio"></span></p>
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihand']; ?></span></p>
                        </td>
                    </tr>
                    <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                <input name="pilihan[]" <?php if ($data['jawaban'] == "e") {
                                                            echo "checked";
                                                        } ?> value="e" type="radio"></span></p>
                    </td>
                    <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihane']; ?></span></p>
                    </td>
                    <tr>
                    </tr>
                </table>
                <br>
                <br>
            <?php } elseif ($data['jenissoal'] == 'truefalse') { ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2">
                            <p><?php echo $data['soal']; ?></p>
                        </td>
                    </tr>
                    <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                <input name="pilihan[]" <?php if ($data['jawaban'] == "true") {
                                                            echo "checked";
                                                        } ?> value="true" type="radio"></span></p>
                    </td>
                    <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                        <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span>True</span></p>
                    </td>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input name="pilihan[]" <?php if ($data['jawaban'] == "false") {
                                                                echo "checked";
                                                            } ?> value="false" type="radio"></span></p>
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span>False</span></p>
                        </td>
                    </tr>
                </table>
                <br>
                <br>
            <?php } elseif ($data['jenissoal'] == 'shortanswer') { ?>
                <table>
                    <tr>
                        <td>
                            <p><?php echo $data['soal']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td><input width="100" class="form-control" type="text" name="pilihan[]" value="<?php echo $data['jawaban']; ?>"></td>
                    </tr>
                </table>
                <br>
                <br>
            <?php } elseif ($data['jenissoal'] == 'multipleanswer') { ?>
                <?php $checked = explode(', ', $data['jawaban']); ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2">
                            <p><?php echo $data['soal']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input type="checkbox" <?php in_array('a', $checked) ? print "checked" : ""; ?> name="pilihan[]" value="a"></span></p>
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihana']; ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input type="checkbox" <?php in_array('b', $checked) ? print "checked" : ""; ?> name="pilihan[]" value="b"></span></p>
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihanb']; ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input type="checkbox" <?php in_array('c', $checked) ? print "checked" : ""; ?> name="pilihan[]" value="c">
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihanc']; ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input type="checkbox" <?php in_array('d', $checked) ? print "checked" : ""; ?> name="pilihan[]" value="d">
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihand']; ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"MS Mincho"'>
                                    <input type="checkbox" <?php in_array('e', $checked) ? print "checked" : ""; ?> name="pilihan[]" value="e">
                        </td>
                        <td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
                            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            150%'><span style='font-family:"Times New Roman","serif"'><?php echo $data['pilihane']; ?></span></p>
                        </td>
                    </tr>
                </table>
                <br>
                <br>
            <?php } elseif ($data['jenissoal'] == 'sorting') { ?>
                <p><?php echo $data['soal']; ?></p>
                <?php $jawaban = explode(',', $data['jawaban']); ?>
                <ul id="sortable" class="sort">
                    <li data-val="a" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <?php
                        if ($data['jawaban'] == '') {
                            echo $data['pilihana'];
                        } elseif ($jawaban[0] == 'a') {
                            echo $data['pilihana'];
                        } elseif ($jawaban[0] == 'b') {
                            echo $data['pilihanb'];
                        } elseif ($jawaban[0] == 'c') {
                            echo $data['pilihanc'];
                        } elseif ($jawaban[0] == 'd') {
                            echo $data['pilihand'];
                        } elseif ($jawaban[0] == 'e') {
                            echo $data['pilihane'];
                        }
                        ?></li>
                    <li data-val="b" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <?php
                        if ($data['jawaban'] == '') {
                            echo $data['pilihanb'];
                        } elseif ($jawaban[1] == 'a') {
                            echo $data['pilihana'];
                        } elseif ($jawaban[1] == 'b') {
                            echo $data['pilihanb'];
                        } elseif ($jawaban[1] == 'c') {
                            echo $data['pilihanc'];
                        } elseif ($jawaban[1] == 'd') {
                            echo $data['pilihand'];
                        } elseif ($jawaban[1] == 'e') {
                            echo $data['pilihane'];
                        }
                        ?>
                    </li>
                    <li data-val="c" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <?php
                        if ($data['jawaban'] == '') {
                            echo $data['pilihanc'];
                        } elseif ($jawaban[2] == 'a') {
                            echo $data['pilihana'];
                        } elseif ($jawaban[2] == 'b') {
                            echo $data['pilihanb'];
                        } elseif ($jawaban[2] == 'c') {
                            echo $data['pilihanc'];
                        } elseif ($jawaban[2] == 'd') {
                            echo $data['pilihand'];
                        } elseif ($jawaban[2] == 'e') {
                            echo $data['pilihane'];
                        }
                        ?>
                    </li>
                    <li data-val="d" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <?php
                        if ($data['jawaban'] == '') {
                            echo $data['pilihand'];
                        } elseif ($jawaban[3] == 'a') {
                            echo $data['pilihana'];
                        } elseif ($jawaban[3] == 'b') {
                            echo $data['pilihanb'];
                        } elseif ($jawaban[3] == 'c') {
                            echo $data['pilihanc'];
                        } elseif ($jawaban[3] == 'd') {
                            echo $data['pilihand'];
                        } elseif ($jawaban[3] == 'e') {
                            echo $data['pilihane'];
                        }
                        ?>
                    </li>
                    <li data-val="e" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <?php
                        if ($data['jawaban'] == '') {
                            echo $data['pilihane'];
                        } elseif ($jawaban[4] == 'a') {
                            echo $data['pilihana'];
                        } elseif ($jawaban[4] == 'b') {
                            echo $data['pilihanb'];
                        } elseif ($jawaban[4] == 'c') {
                            echo $data['pilihanc'];
                        } elseif ($jawaban[4] == 'd') {
                            echo $data['pilihand'];
                        } elseif ($jawaban[4] == 'e') {
                            echo $data['pilihane'];
                        }
                        ?>
                    </li>
                </ul>
                <br>
                <br>
                <input type="hidden" id="pilihan" name="pilihan[]">
            <?php } ?>
            <button type="submit" name="submit" class="btn btn-info" id="btn-test">Jawab</button>
        </form>
    <?php
}
if ($jumlah_halaman == $page) {
    ?>
        <a onclick="$('#modal-user-settingsx').modal('show');" title="Delete" class="btn btn-success">Selesai</a>
        </form>
        <div class="modal fade" id="modal-user-settingsx" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h3 class="modal-title"></i>Rekap Soal Ujian Online</h3>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="<?= base_url('nilai/proses_nilai') ?>" method="post">
                            <input type="hidden" name="iduser" value="<?php echo $_SESSION['iduser']; ?>">
                            <input type="hidden" name="idgroup" value="<?php echo $_SESSION['id']; ?>">
                            <input type="hidden" name="idujian" value="<?php echo $_SESSION['idujian']; ?>">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>No</td>
                                    <td>Jawaban</td>
                                    <td>Edit</td>
                                </tr>
                                <?php
                                $no = 1;
                                $x = 1;
                                $j = mysqli_query($mysqli, " select j.*, s.soal
                                        from jawaban as j
                                        inner join soal as s
                                        on j.idsoal = s.idsoal
                                        where j.idujian = '$_SESSION[idujian]' and j.iduser = '$_SESSION[iduser]'");


                                while ($jawaban = mysqli_fetch_array($j)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $jawaban['jawaban']; ?></td>
                                        <td><a href="<?php echo base_url('ujian/') . $no - $x; ?>">Edit Jawaban<a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                </tr>
                            </table>
                            <div class="form-group form-actions">
                                <div>
                                    <button type="submit" name="selesai" class="btn btn-sm btn-primary">Selesai</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END Modal Body -->
                </div>
            </div>
        </div>
    <?php
}

    ?>

    <br>

    <div class="text-center">
        <ul class="pagination">
            <?php if ($page == 1) { ?>
                <li class="disabled"><a href="#">FIRST</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
            <?php } elseif ($page > 1) {
                $link_prev = ($page > 1) ? $page - 1 : 1;
            ?>
                <li><a href="<?= base_url('ujian1') ?>">FIRST</a></li>
                <li><a href="<?php echo base_url('ujian/') . $link_prev; ?>"><i class="fa fa-angle-left"></i></a></li>
            <?php } ?>

            <?php
            //buat query untuk menghiung jumlah data
            $sql2 = mysqli_query($mysqli, "SELECT COUNT(*) AS jumlah FROM soal where idgroup='$id'");
            $get_jumlah = mysqli_fetch_array($sql2);
            //$jumlah_page = ceil($get_jumlah['jumlah']/$tes);
            $jumlah_number = 2;
            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
            $end_number = ($page < ($jumlah_halaman - $jumlah_number)) ? $page + $jumlah_number : $jumlah_halaman;
            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? ' class="active"' : '';
            ?>
                <li<?php echo $link_active; ?>><a href="<?php echo base_url('ujian/' .  $i); ?>"><?php echo $i; ?></a></li>
                <?php
            }
                ?>

                <?php
                // Jika page sama dengan jumlah page, maka disable link NEXT nya
                // Artinya page tersebut adalah page terakhir 
                if ($page == $jumlah_halaman) { // Jika page terakhir
                ?>
                    <li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    <li class="disabled"><a href="#">LAST</a></li>
                <?php
                } else { // Jika Bukan page terakhir
                    $link_next = ($page < $jumlah_halaman) ? $page + 1 : $jumlah_halaman;
                ?>
                    <li><a href="ujian/<?php echo $link_next; ?>"><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo  base_url('ujian/' . $jumlah_halaman); ?>">LAST</a></li>
                <?php
                }
                ?>

                <!-- <li><a href="javascript:void(0)">FIRST</a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li> 
                    <li class="active"><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)">4</a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">LAST</a></li> -->
                <?php //} 
                ?>
        </ul>
    </div>
    <!-- END Update Status Form -->
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            /** Membuat Waktu Mulai Hitung Mundur Dengan 
             * var detik;
             * var menit;
             * var jam;
             */
            var detik = <?= $detik; ?>;
            var menit = <?= $menit; ?>;
            var jam = <?= $jam; ?>;

            /**
             * Membuat function hitung() sebagai Penghitungan Waktu
             */
            function hitung() {
                /** setTimout(hitung, 1000) digunakan untuk 
                 * mengulang atau merefresh halaman selama 1000 (1 detik) 
                 */
                setTimeout(hitung, 1000);

                /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
                if (menit < 10 && jam == 0) {
                    var peringatan = 'style="color:red"';
                };

                /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                $('#timer').html(
                    jam + ':' + menit + ':' + detik
                );

                /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                detik--;

                /** Jika var detik < 0
                 * var detik akan dikembalikan ke 59
                 * Menit akan Berkurang 1
                 */
                if (detik < 0) {
                    detik = 59;
                    menit--;

                    /** Jika menit < 0
                     * Maka menit akan dikembali ke 59
                     * Jam akan Berkurang 1
                     */
                    if (menit < 0) {
                        menit = 59;
                        jam--;

                        /** Jika var jam < 0
                         * clearInterval() Memberhentikan Interval dan submit secara otomatis
                         */

                        if (jam < 0) {
                            clearInterval(hitung);
                            /** Variable yang digunakan untuk submit secara otomatis di Form */
                            var frmSoal = document.getElementById("frmSoal");
                            alert('Waktu Anda telah habis');
                            frmSoal.submit();
                        }
                    }
                }
            }
            /** Menjalankan Function Hitung Waktu Mundur */
            hitung();
        });
    </script>