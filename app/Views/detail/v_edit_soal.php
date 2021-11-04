<h1> <?= $title ?></h1>
<div class="card">
    <div class="card-body">
        <label>Pilih Kategori</label>

        <?php foreach ($editsoal as $key => $values) { ?>
            <form action="<?= base_url('detailsoal/proses_edit_soal/' . $values['idsoal']) ?>" method="post">

                <div>
                    <select name="kategori" class="form-control">
                        <option value="1">TWK</option>
                        <option value="2">TIU</option>
                        <option value="3">TKP</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Soal</label>
                    <div>
                        <textarea id="textarea-ckeditor" name="soal" class="form-control ckeditor" value="<?php $values['soal'] ?>" required><?= $values['soal']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilihan A</label>
                    <div>
                        <textarea id="textarea-ckeditor" rows="2" name="pilihana" class="form-control ckeditor" value="<?php $values['pilihana'] ?>" style="height: 150px;" required><?= $values['pilihana'] ?></textarea>
                    </div>

                </div>
                <div class="form-group">
                    <label>Point A</label>
                    <div>
                        <input type="text" name="pointa" class="form-control " value="<?= $values['pointa'] ?>" required></input>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilihan B</label>
                    <div>
                        <textarea id="textarea-ckeditor" rows="2" name="pilihanb" class="form-control ckeditor" value="<?php $values['pilihanb'] ?>" style="height: 150px;" required><?= $values['pilihanb']; ?></textarea>
                    </div>
                    <label>Point B</label>
                    <div>
                        <input type="text" name="pointb" class="form-control " value=" <?= $values['pointb']; ?>" required></input>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilihan C</label>
                    <div>
                        <textarea id="textarea-ckeditor" rows="2" name="pilihanc" class="form-control ckeditor" value="<?php $values['pilihanc'] ?>" style="height: 150px;" required><?= $values['pilihanc']; ?></textarea>
                    </div>
                    <label>Point C</label>
                    <div>
                        <input type="text" name="pointc" class="form-control " value=" <?= $values['pointc']; ?>" required></input>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilihan D</label>
                    <div>
                        <textarea id="textarea-ckeditor" rows="2" name="pilihand" class="form-control ckeditor" value="<?php $values['pilihand'] ?>" style="height: 150px;" required><?= $values['pilihand']; ?></textarea>
                    </div>
                    <label>Point D</label>
                    <div>
                        <input type="text" name="pointd" class="form-control " value=" <?= $values['pointd']; ?>" required></input>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilihan E</label>
                    <div>
                        <textarea id="textarea-ckeditor" rows="2" name="pilihane" class="form-control ckeditor" value="<?php $values['pilihane'] ?>" style="height: 150px;" required><?= $values['pilihane']; ?></textarea>
                    </div>
                    <label>Point E</label>
                    <div>
                        <input type="text" name="pointe" class="form-control " value=" <?= $values['pointe']; ?>" required></input>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jawaban Benar</label>
                    <div>
                        <select name="jawabanbenar" class="form-control">
                            <option value=" <?= $values['pilihanbenar'] ?>">Pilihan <?= $values['pilihanbenar']; ?></option>
                            <option value="a">Pilihan A</option>
                            <option value="b">Pilihan B</option>
                            <option value="c">Pilihan C</option>
                            <option value="d">Pilihan D</option>
                            <option value="e">Pilihan E</option>
                        </select>
                    </div>
                    <label>Point Jawaban Benar</label>
                    <div>
                        <input type="text" name="pointbenar" class="form-control " value=" <?= $values['pointbenar']; ?>" required></input>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pembahasan</label>
                    <div>
                        <textarea id="textarea-ckeditor" rows="2" name="pembahasan" class="form-control ckeditor" required value="<?php $values['pembahasan'] ?>" style="height: 100px;"><?= $values['pembahasan']; ?></textarea>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div>
                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Edit Soal</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<script src="<?= base_url('ckeditor5-build-classic/ckeditor.js') ?>" type="text/javascript"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#textarea-ckeditor'))
        .catch(error => {
            console.error(error);
        });
</script>