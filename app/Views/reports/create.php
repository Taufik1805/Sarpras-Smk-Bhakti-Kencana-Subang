<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

    <h2 class="mb-4">➕ Tambah Barang</h2>

    <div class="card shadow">
        <div class="card-body">

            <form action="<?= site_url('items/store') ?>" method="post" enctype="multipart/form-data">

                <!-- Nama -->
                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="category" class="form-control" required>
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <!-- Kondisi -->
                <div class="mb-3">
                    <label>Kondisi</label>
                    <select name="condition" class="form-control">
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="location" class="form-control" required>
                </div>

                <!-- 🔥 UPLOAD GAMBAR -->
                <div class="mb-3">
                    <label>Gambar Barang</label>
                    <input type="file" name="image" class="form-control" id="imageInput">
                    
                    <!-- Preview -->
                    <img id="preview" src="#" class="mt-3 rounded shadow" width="120" style="display:none;">
                    
                    <small class="text-muted">
                        Format: JPG/PNG | Maks: 2MB
                    </small>
                </div>

                <!-- Tombol -->
                <button class="btn btn-success">💾 Simpan</button>
                <a href="<?= site_url('items') ?>" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>

<!-- 🔥 SCRIPT PREVIEW -->
<script>
document.getElementById('imageInput').onchange = function (evt) {
    const [file] = this.files;
    if (file) {
        let preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
};
</script>

<?= $this->endSection() ?>