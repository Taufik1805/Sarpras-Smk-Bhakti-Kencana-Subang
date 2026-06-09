```php
<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
.form-wrapper {
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
}

.form-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.input-group-custom {
    background: #e0e0e0;
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding: 10px;
}

.input-group-custom i {
    margin-right: 10px;
    color: #666;
}

.input-group-custom input,
.input-group-custom select,
.input-group-custom textarea {
    border: none;
    background: transparent;
    width: 100%;
    outline: none;
    color: #333;
    font-weight: 500;
}

.input-group-custom input::placeholder,
textarea::placeholder {
    color: #777;
}

textarea {
    height: 120px;
}

label {
    color: #333;
    font-weight: 600;
}

.btn-reset {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 8px 20px;
}

.btn-simpan {
    background: #1f2a6c;
    color: white;
    border-radius: 10px;
    padding: 8px 25px;
}

.form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}
</style>

<div class="container-fluid">

    <h4 class="fw-bold">Tambah Barang</h4>

    <a href="<?= site_url('items') ?>" class="text-decoration-none text-muted mb-3 d-inline-block">
        ← Kembali ke Data Barang
    </a>

    <div class="form-wrapper">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-title">
                Form Tambah Barang
            </div>

            <button type="reset" class="btn btn-reset">
                <i class="fa fa-rotate"></i> Reset Form
            </button>
        </div>

        <form action="<?= site_url('items/store') ?>" method="post" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6">

                    <label>Kode Barang</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-barcode"></i>
                        <input type="text"
                               name="kode_barang"
                               placeholder="Contoh: BK-001"
                               required>
                    </div>

                    <label>Jenis Aset</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-building"></i>
                        <select name="jenis_aset" required>
                            <option value="">Pilih Jenis Aset</option>
                            <option value="Sarana">Sarana</option>
                            <option value="Prasarana">Prasarana</option>
                        </select>
                    </div>

                    <label>Nama Barang</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-box"></i>
                        <input type="text"
                               name="name"
                               placeholder="Masukkan Nama Barang"
                               required>
                    </div>

                    <label>Kategori</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-layer-group"></i>
                        <select name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option>Alat Kebersihan</option>
                            <option>Peralatan Sekolah</option>
                            <option>Elektronik</option>
                            <option>Furniture</option>
                            <option>Laboratorium</option>
                        </select>
                    </div>

                    <label>Kondisi</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-check-circle"></i>
                        <select name="condition" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </div>

                    <label>Lokasi</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-map-marker-alt"></i>
                        <input type="text"
                               name="location"
                               placeholder="Masukkan Lokasi"
                               required>
                    </div>

                </div>

                <div class="col-md-6">

                    <label>Stok</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-hashtag"></i>
                        <input type="number"
                               name="stock"
                               placeholder="Masukkan Jumlah Stok"
                               required>
                    </div>

                    <label>Satuan</label>
                    <div class="input-group-custom mb-3">
                        <i class="fa fa-ruler"></i>
                        <select name="satuan" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Unit">Unit</option>
                            <option value="Buah">Buah</option>
                            <option value="Set">Set</option>
                            <option value="Paket">Paket</option>
                        </select>
                    </div>

                    <label>Keterangan</label>
                    <div class="input-group-custom mb-3">
                        <textarea
                            name="keterangan"
                            placeholder="Masukkan Keterangan (opsional)"></textarea>
                    </div>

                    <label>Gambar</label>
                    <div class="input-group-custom mb-3">
                        <input type="file" name="image">
                    </div>

                </div>

            </div>

            <div class="form-footer">
                <a href="<?= site_url('items') ?>" class="btn btn-light">
                    Batal
                </a>

                <button type="submit" class="btn btn-simpan">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
```
