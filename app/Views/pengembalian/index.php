<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <h3>🔄 Data Pengembalian</h3>

        <a href="<?= site_url('pengembalian/create') ?>"
           class="btn btn-primary">
            + Tambah Pengembalian
        </a>

    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-primary">

                    <tr>
                        <th>No</th>
                        <th>Kode Pengembalian</th>
                        <th>Peminjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Kondisi Barang</th>
                        <th>Keterangan</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php $no=1; ?>

                    <?php foreach($data as $d): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= $d['kode_pengembalian'] ?></td>

                        <td><?= $d['nama_peminjam'] ?></td>

                        <td><?= $d['tanggal_kembali'] ?></td>

                        <td>

                            <?php
                            $badge = 'success';

                            if($d['kondisi_barang']=='rusak_ringan')
                                $badge = 'warning';

                            if($d['kondisi_barang']=='rusak_berat')
                                $badge = 'danger';

                            if($d['kondisi_barang']=='hilang')
                                $badge = 'dark';
                            ?>

                            <span class="badge bg-<?= $badge ?>">
                                <?= ucfirst(str_replace('_',' ',$d['kondisi_barang'])) ?>
                            </span>

                        </td>

                        <td><?= $d['keterangan'] ?></td>

                    </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <?= $pager->links() ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>