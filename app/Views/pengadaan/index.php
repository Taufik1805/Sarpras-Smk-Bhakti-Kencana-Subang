<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>

/* HEADER */
.page-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 15px;
}

/* BUTTON */
.btn-add {
    background: #8ec5d6;
    border-radius: 10px;
    padding: 8px 15px;
    font-weight: 500;
}

/* SEARCH */
.search-box {
    display: flex;
    gap: 10px;
}

.search-input {
    background: #dbeafe;
    border-radius: 20px;
    border: none;
    padding: 8px 15px;
    width: 200px;
}

.search-btn {
    border-radius: 10px;
}

/* CARD STAT */
.card-stat {
    padding: 15px;
    border-radius: 12px;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bg-total { background: #cde8f0; }
.bg-proses { background: #f6ea3a; }
.bg-selesai { background: #a7d7c5; }
.bg-batal { background: #f5b5b5; }

/* TABLE */
.table-custom {
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

.table-custom thead {
    background: #8ec5d6;
    color: black;
}

.table-custom td, .table-custom th {
    vertical-align: middle;
}

/* BADGE TOTAL */
.badge-total {
    background: #2c3e75;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
}

/* BUTTON AKSI */
.btn-edit {
    background: #facc15;
    border-radius: 8px;
}

.btn-delete {
    background: #ef4444;
    color: white;
    border-radius: 8px;
}

/* PAGINATION */
.pagination {
    justify-content: center;
}

</style>

<div class="container-fluid">

<div class="page-title">📦 Data Pengadaan</div>

<!-- TOP -->
<div class="d-flex justify-content-between mb-3">

    <a href="<?= site_url('pengadaan/create') ?>" class="btn btn-add">
        ➕ Tambah Pengadaan
    </a>

    <form method="get" class="search-box">
        <input type="text" name="keyword" class="search-input" placeholder="Cari Pengadaan...">
        <button class="btn btn-light search-btn">🔍</button>
    </form>

</div>

<!-- STAT -->
<div class="row mb-3">

    <div class="col-md-3">
        <div class="card-stat bg-total">
            <div>Total Pengadaan</div>
            <i class="fa fa-shopping-cart"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat bg-proses">
            <div>Proses</div>
            ⏳
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat bg-selesai">
            <div>Selesai</div>
            ✔
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat bg-batal">
            <div>Dibatalkan</div>
            ✖
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="table-responsive table-custom">

<table class="table text-center mb-0">

<thead>
<tr>
<th>No</th>
<th>Nama Barang</th>
<th>Tanggal</th>
<th>Pemasok</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($data as $d): ?>
<tr>

<td><?= $no++ ?></td>
<td><?= $d['item_name'] ?></td>
<td><?= $d['date'] ?></td>
<td><?= $d['supplier'] ?></td>

<td>
<span class="badge-total"><?= $d['total'] ?></span>
</td>

<td><?= ucfirst($d['status']) ?></td>

<td>
    <button class="btn btn-edit btn-sm">✏️</button>
    <a href="<?= site_url('pengadaan/delete/'.$d['id']) ?>" class="btn btn-delete btn-sm">🗑️</a>
</td>

</tr>
<?php endforeach; ?>

</tbody>

</table>

</div>

<!-- PAGINATION -->
<div class="mt-3">
<?= $pager->links() ?>
</div>

</div>

<?= $this->endSection() ?>