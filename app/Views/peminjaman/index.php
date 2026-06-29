<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <h3>📋 Data Peminjaman</h3>

        <a href="<?= site_url('peminjaman/create') ?>"
           class="btn btn-primary">
            + Tambah Peminjaman
        </a>

    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-primary">

                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Barang</th>
                    <th>Peminjam</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>

                    <?php if(session()->get('role') == 'admin'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>

                </tr>

            </thead>

            <tbody>

            <?php $no = 1; ?>

            <?php foreach($data as $d): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $d['kode_peminjaman'] ?></td>

                <td><?= $d['name'] ?></td>

                <td><?= $d['nama_peminjam'] ?></td>

                <td><?= $d['jumlah'] ?></td>

                <td><?= $d['tanggal_pinjam'] ?></td>

                <td>

                    <?php if($d['status'] == 'dipinjam'): ?>

                        <span class="badge bg-warning">
                            Dipinjam
                        </span>

                    <?php else: ?>

                        <span class="badge bg-success">
                            Dikembalikan
                        </span>

                    <?php endif; ?>

                </td>

                <?php if(session()->get('role') == 'admin'): ?>

                <td>

                    <a href="<?= site_url('peminjaman/edit/'.$d['id']) ?>"
                       class="btn btn-warning btn-sm">
                        ✏️
                    </a>

                    <a href="<?= site_url('peminjaman/delete/'.$d['id']) ?>"
                       onclick="return confirm('Yakin hapus data?')"
                       class="btn btn-danger btn-sm">
                        🗑️
                    </a>

                </td>

                <?php endif; ?>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>