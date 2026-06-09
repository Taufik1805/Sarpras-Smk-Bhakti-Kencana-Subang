```php
<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <h3 class="mb-4">✏️ Edit Pengadaan</h3>

    <form action="<?= site_url('pengadaan/update/'.$item['id']) ?>" method="post">

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">
                    <label>Kode Pengadaan</label>
                    <input type="text"
                           class="form-control"
                           value="<?= $item['kode_pengadaan'] ?>"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           value="<?= $item['nama_barang'] ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label>Jenis Aset</label>

                    <select name="jenis_aset" class="form-control">

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

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           value="<?= $item['jumlah'] ?>">
                </div>

                <div class="mb-3">
                    <label>Harga Satuan</label>
                    <input type="number"
                           name="harga_satuan"
                           class="form-control"
                           value="<?= $item['harga_satuan'] ?>">
                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label>Tanggal Pengadaan</label>
                    <input type="date"
                           name="tanggal_pengadaan"
                           class="form-control"
                           value="<?= $item['tanggal_pengadaan'] ?>">
                </div>

                <div class="mb-3">
                    <label>Pemasok</label>
                    <input type="text"
                           name="pemasok"
                           class="form-control"
                           value="<?= $item['pemasok'] ?>">
                </div>

                <div class="mb-3">
                    <label>Sumber Dana</label>
                    <input type="text"
                           name="sumber_dana"
                           class="form-control"
                           value="<?= $item['sumber_dana'] ?>">
                </div>

                <div class="mb-3">
                    <label>Lokasi Penempatan</label>
                    <input type="text"
                           name="lokasi_penempatan"
                           class="form-control"
                           value="<?= $item['lokasi_penempatan'] ?>">
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="proses"
                            <?= $item['status']=='proses' ? 'selected' : '' ?>>
                            Proses
                        </option>

                        <option value="selesai"
                            <?= $item['status']=='selesai' ? 'selected' : '' ?>>
                            Selesai
                        </option>

                        <option value="dibatalkan"
                            <?= $item['status']=='dibatalkan' ? 'selected' : '' ?>>
                            Dibatalkan
                        </option>

                    </select>
                </div>

            </div>

        </div>

        <div class="mb-3">
            <label>Keterangan</label>

            <textarea name="keterangan"
                      class="form-control"
                      rows="4"><?= $item['keterangan'] ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            💾 Simpan Perubahan
        </button>

        <a href="<?= site_url('pengadaan') ?>"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>
```
