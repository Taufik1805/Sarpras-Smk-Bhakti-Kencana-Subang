<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

    <h2 class="mb-4">✏️ Edit Barang</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">

            <form action="<?= site_url('items/update/'.$item['id']) ?>" method="post" enctype="multipart/form-data">

                <!-- KODE BARANG -->
                <div class="mb-3">
                    <label class="form-label">Kode Barang</label>
                    <input type="text"
                           name="kode_barang"
                           value="<?= esc($item['kode_barang']) ?>"
                           class="form-control"
                           required>
                </div>

                <!-- JENIS ASET -->
                <div class="mb-3">
                    <label class="form-label">Jenis Aset</label>
                    <select name="jenis_aset" class="form-control" required>
                        <option value="Sarana"
                            <?= $item['jenis_aset']=='Sarana' ? 'selected' : '' ?>>
                            Sarana
                        </option>

                        <option value="Prasarana"
                            <?= $item['jenis_aset']=='Prasarana' ? 'selected' : '' ?>>
                            Prasarana
                        </option>
                    </select>
                </div>

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text"
                           name="name"
                           value="<?= esc($item['name']) ?>"
                           class="form-control"
                           required>
                </div>

                <!-- KATEGORI -->
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text"
                           name="category"
                           value="<?= esc($item['category']) ?>"
                           class="form-control"
                           required>
                </div>

                <!-- STOK -->
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stock"
                           value="<?= esc($item['stock']) ?>"
                           class="form-control"
                           required>
                </div>

                <!-- SATUAN -->
                <div class="mb-3">
                    <label class="form-label">Satuan</label>
                    <select name="satuan" class="form-control" required>
                        <option value="Unit" <?= $item['satuan']=='Unit'?'selected':'' ?>>Unit</option>
                        <option value="Buah" <?= $item['satuan']=='Buah'?'selected':'' ?>>Buah</option>
                        <option value="Set" <?= $item['satuan']=='Set'?'selected':'' ?>>Set</option>
                        <option value="Ruang" <?= $item['satuan']=='Ruang'?'selected':'' ?>>Ruang</option>
                    </select>
                </div>

                <!-- KONDISI -->
                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="condition" class="form-control" required>

                        <option value="baik"
                            <?= $item['item_condition']=='baik'?'selected':'' ?>>
                            Baik
                        </option>

                        <option value="rusak"
                            <?= $item['item_condition']=='rusak'?'selected':'' ?>>
                            Rusak
                        </option>

                        <option value="hilang"
                            <?= $item['item_condition']=='hilang'?'selected':'' ?>>
                            Hilang
                        </option>

                        <option value="habis"
                            <?= $item['item_condition']=='habis'?'selected':'' ?>>
                            Habis
                        </option>

                    </select>
                </div>

                <!-- LOKASI -->
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text"
                           name="location"
                           value="<?= esc($item['location']) ?>"
                           class="form-control"
                           required>
                </div>

                <!-- KETERANGAN -->
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="4"><?= esc($item['keterangan']) ?></textarea>
                </div>

                <!-- GAMBAR -->
                <div class="mb-3">
                    <label class="form-label">Gambar Barang</label>

                    <input type="file"
                           name="image"
                           class="form-control"
                           id="imageInput"
                           accept="image/*">

                    <?php
                    $img = !empty($item['image'])
                        ? base_url('uploads/'.$item['image'])
                        : base_url('uploads/default.png');
                    ?>

                    <img id="preview"
                         src="<?= $img ?>"
                         width="150"
                         class="mt-3 rounded border shadow">
                </div>

                <button class="btn btn-success">
                    💾 Update
                </button>

                <a href="<?= site_url('items') ?>"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

<script>
document.getElementById('imageInput').onchange = function() {
    const [file] = this.files;

    if(file){
        document.getElementById('preview').src =
            URL.createObjectURL(file);
    }
};
</script>

<?= $this->endSection() ?>