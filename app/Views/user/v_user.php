<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-header">
        <div class="row" style="padding: 10px;">
            <button type="button" class="btn btn-primary btn-sm" style="margin-right: 10px;" data-toggle="modal" data-target="#modal-default">Tambah</button>
            <button type="button" class="btn btn-success btn-sm" style="margin-right: 10px;">Import dari Excel</button>
            <button type="button" class="btn btn-success btn-sm" style="margin-right: 10px;">Export ke Excel</button>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat/TGL Lahir</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($user as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $value['namauser']; ?></td>
                                    <td><?= $value['jk']; ?></td>
                                    <td><?= $value['tempatlahir'] ?>, <?php if ($value['tgllahir'] == "0000-00-00") {
                                                                            echo "30 November 2001";
                                                                        } else {
                                                                            echo $value['tgllahir'];
                                                                        } ?> </td>
                                    <td><?= $value['status']; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['iduser'] ?>"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $value['iduser'] ?>"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>

<!-- modal add -->
<div class=" modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('user/tambah_user') ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input class="form-control" name="nama_user" placeholder="Masukan Nama User" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jk" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tempat/TGL Lahir</label>
                    <div class="form-inline">
                        <input style="width: 50%;" class="form-control" name="tempatlahir" placeholder="Masukan Tempat" required>
                        <input type="date" class="form-control" style="width: 50%;" name="tgllahir" id="">
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="cpns">CPNS</option>
                        <option value="pppk">PPPK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="username" placeholder="Masukan Username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" placeholder="Masukan Password" required>
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
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['iduser']; ?>">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('user/edit_user/' . $value['iduser']) ?>
                    <div class="form-group">
                        <label>Nama User</label>
                        <input class="form-control" value="<?= $value['namauser']; ?>" name="nama_user" placeholder="Masukan Nama User" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk" required>
                            <option value="<?= $value['jk'] ?>"><?php if ($value['jk'] == "laki-laki") {
                                                                    echo 'Laki-laki';
                                                                } else {
                                                                    echo 'Perempuan';
                                                                } ?></option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat/TGL Lahir</label>
                        <div class="form-inline">
                            <input style="width: 50%;" value="<?= $value['tempatlahir']; ?>" class="form-control" name="tempatlahir" placeholder="Masukan Tempat" required>
                            <input type="date" value="<?= $value['tgllahir']; ?>" class="form-control" style="width: 50%;" name="tgllahir" id="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="<?= $value['status'] ?>"><?php if ($value['status'] == "cpns") {
                                                                        echo 'CPNS';
                                                                    } else if ($value['status'] == "admin") {
                                                                        echo 'Admin';
                                                                    } else if ($value['status'] == "guru") {
                                                                        echo 'Guru';
                                                                    } else {
                                                                        echo 'PPPK';
                                                                    } ?></option>
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="cpns">CPNS</option>
                            <option value="pppk">PPPK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" value="<?= $value['username'] ?>" name="username" placeholder="Masukan Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" value="<?php $value['password'] ?>" name="password" placeholder="Masukan Password" required>
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
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['iduser']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus User <?= $value['namauser']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('user/hapus_user/' . $value['iduser']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>