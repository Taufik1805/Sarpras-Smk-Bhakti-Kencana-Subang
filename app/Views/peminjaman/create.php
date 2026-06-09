<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow">
        <div class="card-body">

            <h3 class="mb-4">
                ➕ Tambah Peminjaman
            </h3>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('peminjaman/store') ?>" method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">
                                Barang
                            </label>

                            <select name="barang_id"
                                    class="form-control"
                                    required>

                                <option value="">
                                    -- Pilih Barang --
                                </option>

                                <?php foreach($items as $i): ?>

                                    <option value="<?= $i['id'] ?>">
                                        <?= $i['kode_barang'] ?> -
                                        <?= $i['name'] ?>
                                        (Stok: <?= $i['stock'] ?>)
                                    </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Peminjam
                            </label>

                            <input type="text"
                                   name="nama_peminjam"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Jumlah Pinjam
                            </label>

                            <input type="number"
                                   name="jumlah"
                                   min="1"
                                   class="form-control"
                                   required>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">
                                Tanggal Pinjam
                            </label>

                            <input type="date"
                                   name="tanggal_pinjam"
                                   value="<?= date('Y-m-d') ?>"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Keterangan
                            </label>

                            <textarea name="keterangan"
                                      rows="5"
                                      class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <hr>

                <button type="submit"
                        class="btn btn-primary">
                    💾 Simpan
                </button>

                <a href="<?= site_url('peminjaman') ?>"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>