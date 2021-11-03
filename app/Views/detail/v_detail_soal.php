<ul class="nav nav-tabs">
    <li class="active nav-item">
        <a class="nav-link active" aria-current="page" href="#">
            <h5><i class="fa fa-th-large"></i> CPNS</h5>
        </a>
    </li>
    <li class="active nav-item">
        <a class="nav-link " href="#">
            <h5><i class="fa fa-th-large"></i>PPPK</h5>
        </a>
    </li>
</ul>

<div class="card-header">
    <div class="row" style="padding: 10px;">
        <?php if (session()->get('status') == 'guru') { ?>
            <a href="<?= base_url('detailsoal/tambahsoal/' . $tambah[0]['idgroup']) ?>" class="btn btn-primary btn-sm" style="margin-right: 10px;">Tambah</a>
        <?php } ?>
    </div>
</div>
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Soal</th>
                <th width="200px">Pembahasan</th>
                <th width="150">Jawaban Benar</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($soal as $key => $value) { ?>
                <tr class="" style="font-size: 13px;">
                    <td><?= $no++; ?></td>
                    <td><?= $value['soal']; ?></td>
                    <td><?= $value['pembahasan']; ?></td>
                    <td class="text-center"><?= $value['pilihanbenar']; ?></td>
                    <td><?php if (session()->get('status') == 'admin') { ?>
                            <button class="btn btn-danger" disabled>You Are Not Author</button><?php } else { ?>
                            <a href="<?= base_url('detailsoal/editsoal/' . $value['idsoal']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $value['idsoal'] ?>"><i class="fas fa-trash-alt"></i></button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- modal delete -->
<?php foreach ($soal as $key => $value) { ?>
    <div class="modal fade" id="modal-hapus<?= $value['idsoal']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Soal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-weight:bolder">Apakah anda yakin menghapus Soal </p> <?= $value['soal']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('detailsoal/hapus_soal/' . $value['idsoal']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>