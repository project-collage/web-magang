<h1> <?= $title ?></h1>

<div class="card">
    <div class="card-body">
        <label>Pilih Kategori</label>

        <form action="<?= base_url('detailsoal/prosestambahsoal') ?>" method="post">
            <input type="hidden" name="idgroup" value="<?= $tambah_soal[0]['idgroup']; ?>">
            <div>
                <select name="kategori" class="form-control" required>
                    <option value="1">TWK</option>
                    <option value="2">TIU</option>
                    <option value="3">TKP</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label>Soal</label>
                <div>
                    <textarea id="textarea-ckeditor" name="soal" class="form-control ckeditor" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan A</label>
                <div>
                    <textarea id="textarea-ckeditor" rows="2" name="pilihana" class="form-control ckeditor" style="height: 150px;" required></textarea>
                </div>
                <label>Point A</label>
                <div>
                    <input type="text" name="pointa" class="form-control " required></input>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan B</label>
                <div>
                    <textarea id="textarea-ckeditor" rows="2" name="pilihanb" class="form-control ckeditor" style="height: 150px;" required></textarea>
                </div>
                <label>Point B</label>
                <div>
                    <input type="text" name="pointb" class="form-control " required></input>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan C</label>
                <div>
                    <textarea id="textarea-ckeditor" rows="2" name="pilihanc" class="form-control ckeditor" style="height: 150px;" required></textarea>
                </div>
                <label>Point C</label>
                <div>
                    <input type="text" name="pointc" class="form-control " required></input>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan D</label>
                <div>
                    <textarea id="textarea-ckeditor" rows="2" name="pilihand" class="form-control ckeditor" style="height: 150px;" required></textarea>
                </div>
                <label>Point D</label>
                <div>
                    <input type="text" name="pointd" class="form-control " required></input>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan E</label>
                <div>
                    <textarea id="textarea-ckeditor" rows="2" name="pilihane" class="form-control ckeditor" style="height: 150px;" required></textarea>
                </div>
                <label>Point E</label>
                <div>
                    <input type="text" name="pointd" class="form-control " required></input>
                </div>
            </div>
            <div class="form-group">
                <label>Jawaban Benar</label>
                <div>
                    <select name="jawabanbenar" class="form-control" required>
                        <option value="a">Pilihan A</option>
                        <option value="b">Pilihan B</option>
                        <option value="c">Pilihan C</option>
                        <option value="d">Pilihan D</option>
                        <option value="e">Pilihan E</option>
                    </select>
                </div>
                <label>Point Jawaban Benar</label>
                <div>
                    <input type="text" name="pointbenar" class="form-control " required></input>
                </div>
            </div>
            <div class="form-group">
                <label>Pembahasan</label>
                <div>
                    <textarea id="textarea-ckeditor" rows="2" name="pembahasan" class="form-control ckeditor" style="height: 100px;"></textarea>
                </div>
            </div>
            <div class="form-group form-actions">
                <div>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Tambah Soal</button>
                </div>
            </div>
        </form>
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