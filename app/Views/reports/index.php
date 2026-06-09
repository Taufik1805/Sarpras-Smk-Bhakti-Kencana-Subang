<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <h2 class="mb-4">
        📊 Laporan Sistem Sarana dan Prasarana
    </h2>

    <!-- DATA BARANG -->
    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white">
            Data Barang
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(!empty($barang)): ?>

                    <?php $no=1; ?>

                    <?php foreach($barang as $b): ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $b['kode_barang'] ?></td>
                        <td><?= $b['name'] ?></td>
                        <td><?= $b['category'] ?></td>
                        <td><?= $b['stock'] ?></td>
                        <td><?= ucfirst($b['item_condition']) ?></td>
                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak ada data barang
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- DATA PENGADAAN -->
    <div class="card shadow mb-4">

        <div class="card-header bg-success text-white">
            Data Pengadaan
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Jenis Aset</th>
                        <th>Jumlah</th>
                        <th>Pemasok</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(!empty($pengadaan)): ?>

                    <?php $no=1; ?>

                    <?php foreach($pengadaan as $p): ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['kode_pengadaan'] ?></td>
                        <td><?= $p['nama_barang'] ?></td>
                        <td><?= $p['jenis_aset'] ?></td>
                        <td><?= $p['jumlah'] ?></td>
                        <td><?= $p['pemasok'] ?></td>
                        <td>Rp <?= number_format($p['total_harga'],0,',','.') ?></td>
                        <td><?= ucfirst($p['status']) ?></td>
                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="text-center">
                            Tidak ada data pengadaan
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- DATA PEMINJAMAN -->
    <div class="card shadow mb-4">

        <div class="card-header bg-warning">
            Data Peminjaman
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Peminjaman</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(!empty($peminjaman)): ?>

                    <?php $no=1; ?>

                    <?php foreach($peminjaman as $p): ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['kode_peminjaman'] ?></td>
                        <td><?= $p['nama_peminjam'] ?></td>
                        <td><?= $p['jumlah'] ?></td>
                        <td><?= $p['tanggal_pinjam'] ?></td>
                        <td><?= ucfirst($p['status']) ?></td>
                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak ada data peminjaman
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- DATA PENGEMBALIAN -->
    <div class="card shadow">

        <div class="card-header bg-danger text-white">
            Data Pengembalian
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pengembalian</th>
                        <th>Tanggal Kembali</th>
                        <th>Kondisi Barang</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(!empty($pengembalian)): ?>

                    <?php $no=1; ?>

                    <?php foreach($pengembalian as $p): ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['kode_pengembalian'] ?></td>
                        <td><?= $p['tanggal_kembali'] ?></td>
                        <td><?= ucfirst($p['kondisi_barang']) ?></td>
                        <td><?= $p['keterangan'] ?></td>
                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center">
                            Tidak ada data pengembalian
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>v