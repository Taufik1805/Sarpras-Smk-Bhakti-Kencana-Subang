<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">📋 Data Laporan</h3>

<form method="get" class="row g-3 mb-3">

    <div class="col-md-3">
        <input type="date" name="from" class="form-control" value="<?= $from ?>">
    </div>

    <div class="col-md-3">
        <input type="date" name="to" class="form-control" value="<?= $to ?>">
    </div>

    <div class="col-md-4">
        <button class="btn btn-success">Filter</button>

        <a href="<?= base_url('/reports') ?>" class="btn btn-secondary">Reset</a>

        <a href="<?= base_url('/reports/pdf?from='.$from.'&to='.$to) ?>" class="btn btn-danger">
            Export PDF
        </a>
    </div>

</form>

<div class="card shadow">
<div class="card-body">

<table class="table table-bordered table-hover">
<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Barang</th>
    <th>Deskripsi</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($reports as $r): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r['name'] ?></td>
<td><?= $r['description'] ?></td>
<td>
<?php if($r['status']=='rusak'): ?>
    <span class="badge bg-danger">Rusak</span>
<?php elseif($r['status']=='hilang'): ?>
    <span class="badge bg-dark">Hilang</span>
<?php else: ?>
    <span class="badge bg-success"><?= $r['status'] ?></span>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

</div>
</div>

<?= $this->endSection() ?>