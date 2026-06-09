<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-body">

            <h3 class="mb-4">
                🔄 Tambah Pengembalian
            </h3>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('pengembalian/store') ?>"
                  method="post">

                <div class="mb-3">

                    <label class="form-label">
                        Data Peminjaman
                    </label>

                    <select name="peminjaman_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Pilih Peminjaman --
                        </option>

                        <?php foreach($pinjam as $p): ?>

                            <option value="<?= $p['id'] ?>">

                                <?= $p['kode_peminjaman'] ?>

                                -

                                <?= $p['nama_peminjam'] ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Kembali
                    </label>

                    <input type="date"
                           name="tanggal_kembali"
                           value="<?= date('Y-m-d') ?>"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kondisi Barang
                    </label>

                    <select name="kondisi_barang"
                            class="form-control"
                            required>

                        <option value="baik">
                            Baik
                        </option>

                        <option value="rusak_ringan">
                            Rusak Ringan
                        </option>

                        <option value="rusak_berat">
                            Rusak Berat
                        </option>

                        <option value="hilang">
                            Hilang
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea name="keterangan"
                              rows="4"
                              class="form-control"></textarea>

                </div>

                <button type="submit"
                        class="btn btn-success">

                    💾 Simpan

                </button>

                <a href="<?= site_url('pengembalian') ?>"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>