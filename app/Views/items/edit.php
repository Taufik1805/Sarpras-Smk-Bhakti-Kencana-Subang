<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

    <h2 class="mb-4">✏️ Edit Barang</h2>

    <!-- NOTIFIKASI ERROR -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">

            <form action="<?= site_url('items/update/'.$item['id']) ?>" method="post" enctype="multipart/form-data">

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="name" value="<?= esc($item['name']) ?>" class="form-control" required>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" value="<?= esc($item['category']) ?>" class="form-control" required>
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" value="<?= esc($item['stock']) ?>" class="form-control" required>
                </div>

                <!-- 🔥 FIX KONDISI -->
                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="condition" class="form-control" required>
                        <option value="baik" <?= $item['item_condition']=='baik'?'selected':'' ?>>Baik</option>
                        <option value="rusak" <?= $item['item_condition']=='rusak'?'selected':'' ?>>Rusak</option>
                        <option value="hilang" <?= $item['item_condition']=='hilang'?'selected':'' ?>>Hilang</option>
                        <option value="habis" <?= $item['item_condition']=='habis'?'selected':'' ?>>Habis</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" value="<?= esc($item['location']) ?>" class="form-control" required>
                </div>

                <!-- 🔥 GAMBAR -->
                <div class="mb-3">
                    <label class="form-label">Gambar Barang</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">

                    <?php 
                        $img = !empty($item['image']) 
                            ? base_url('uploads/' . $item['image']) 
                            : base_url('uploads/default.png');
                    ?>

                    <!-- PREVIEW -->
                    <img id="preview" 
                         src="<?= $img ?>" 
                         width="120"
                         class="mt-3 rounded shadow border">
                </div>

                <!-- Tombol -->
                <button class="btn btn-success">
                    💾 Update
                </button>

                <a href="<?= site_url('items') ?>" class="btn btn-secondary">
                    Kembali
                </a>

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
    }
};
</script>

<?= $this->endSection() ?>