<h1> <?= $title ?></h1>

<div class="row">
    <div class="col-sm-6 col-lg-12">
        <div class="info-box">

            <div class="info-box-content">
                <span class="info-box-text">Hai <?php echo session()->get('namauser') ?></span>
                <span class="info-box-number">Selamat Datang</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>

<?php if (session()->get('status') == 'admin') { ?>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $tot_group; ?></h3>
                    <p>Group Soal</p>
                </div>
                <div class="icon">
                    <i class="far fa-file-alt"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $tot_guru; ?><sup style="font-size: 20px"></sup></h3>

                    <p>Guru</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $tot_cpns; ?><sup style="font-size: 20px"></sup></h3>
                    <p>CPNS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?= $tot_pppk; ?><sup style="font-size: 20px"></sup></h3>
                    <p>PPPK</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $tot_ujian; ?><sup style="font-size: 20px"></sup></h3>

                    <p>Ujian Aktif</p>
                </div>
                <div class="icon">
                    <i class="far fa-file-alt"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
<?php } ?>