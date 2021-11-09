<?php $mysqli = new mysqli('localhost', 'root', '', 'pkl');

$tampil = mysqli_query($mysqli, "select * from nilai 
where iduser = '$_SESSION[iduser]' and idujian = '$_SESSION[idujian]' ");
$nilai = mysqli_fetch_array($tampil);
?>

<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-table"></i>Data Ujian
        </h1>
    </div>
</div>
<div class="block full">
    <div class="block-title">
        <div>
        </div>
    </div>
    <div class="alert alert-success alert-dismissable">
        <center>
            <font size="6">Hasil Ujian Online Anda</font>
            <h1 style="font-size:175px;"><b><?php echo $nilai['nilai']; ?></b></h1>
        </center>
    </div>
</div>