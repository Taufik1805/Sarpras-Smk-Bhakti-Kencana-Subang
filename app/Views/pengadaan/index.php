<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>

.page-title{
    font-size:22px;
    font-weight:bold;
    margin-bottom:15px;
}

.btn-add{
    background:#8ec5d6;
    border-radius:10px;
    padding:8px 15px;
    font-weight:500;
}

.search-box{
    display:flex;
    gap:10px;
}

.search-input{
    background:#dbeafe;
    border:none;
    border-radius:20px;
    padding:8px 15px;
    width:220px;
}

.card-stat{
    padding:15px;
    border-radius:12px;
    font-weight:600;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.bg-total{
    background:#cde8f0;
}

.bg-proses{
    background:#fef08a;
}

.bg-selesai{
    background:#bbf7d0;
}

.bg-batal{
    background:#fecaca;
}

.table-custom{
    background:white;
    border-radius:10px;
    overflow:hidden;
}

.table-custom thead{
    background:#8ec5d6;
}

.badge-total{
    background:#2c3e75;
    color:white;
    padding:6px 12px;
    border-radius:8px;
}

.badge-sarana{
    background:#0ea5e9;
    color:white;
    padding:5px 10px;
    border-radius:6px;
}

.badge-prasarana{
    background:#8b5cf6;
    color:white;
    padding:5px 10px;
    border-radius:6px;
}

.btn-edit{
    background:#facc15;
}

.btn-delete{
    background:#ef4444;
    color:white;
}

.pagination{
    justify-content:center;
}

</style>

<div class="container-fluid">

    <div class="page-title">
        📦 Data Pengadaan
    </div>

    <div class="d-flex justify-content-between mb-3">

        <a href="<?= site_url('pengadaan/create') ?>" class="btn btn-add">
            ➕ Tambah Pengadaan
        </a>

        <form method="get" class="search-box">

            <input
                type="text"
                name="keyword"
                class="search-input"
                placeholder="Cari pengadaan...">

            <button class="btn btn-light">
                🔍
            </button>

        </form>

    </div>

    <div class="row mb-3">

        <div class="col-md-3">
            <div class="card-stat bg-total">
                <div>
                    Total Pengadaan
                    <br>
                    <strong><?= $totalPengadaan ?></strong>
                </div>
                📦
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-proses">
                <div>
                    Proses
                    <br>
                    <strong><?= $proses ?></strong>
                </div>
                ⏳
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-selesai">
                <div>
                    Selesai
                    <br>
                    <strong><?= $selesai ?></strong>
                </div>
                ✔
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-stat bg-batal">
                <div>
                    Dibatalkan
                    <br>
                    <strong><?= $dibatalkan ?></strong>
                </div>
                ✖
            </div>
        </div>

    </div>

    <div class="table-responsive table-custom">

        <table class="table text-center mb-0">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Pemasok</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php $no = 1; ?>

            <?php foreach($data as $d): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= esc($d['kode_pengadaan']) ?></td>

                <td><?= esc($d['nama_barang']) ?></td>

                <td>

                    <?php if($d['jenis_aset'] == 'Sarana'): ?>

                        <span class="badge-sarana">
                            Sarana
                        </span>

                    <?php else: ?>

                        <span class="badge-prasarana">
                            Prasarana
                        </span>

                    <?php endif; ?>

                </td>

                <td><?= esc($d['jumlah']) ?></td>

                <td><?= esc($d['tanggal_pengadaan']) ?></td>

                <td><?= esc($d['pemasok']) ?></td>

                <td>
                    <span class="badge-total">
                        Rp <?= number_format($d['total_harga'],0,',','.') ?>
                    </span>
                </td>

                <td><?= ucfirst($d['status']) ?></td>

                <td>

                    <a href="<?= site_url('pengadaan/edit/'.$d['id']) ?>"
                       class="btn btn-edit btn-sm">
                        ✏️
                    </a>

                    <a href="<?= site_url('pengadaan/delete/'.$d['id']) ?>"
                       class="btn btn-delete btn-sm"
                       onclick="return confirm('Yakin hapus data?')">
                        🗑️
                    </a>

                </td>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <div class="mt-3">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>