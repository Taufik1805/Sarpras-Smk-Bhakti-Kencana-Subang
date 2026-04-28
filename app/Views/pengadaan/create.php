<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

<h4>Tambah Pengadaan</h4>

<form action="<?= site_url('pengadaan/store') ?>" method="post">

<div class="mb-3">
<label>Nama Barang</label>
<input type="text" name="item_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Tanggal</label>
<input type="date" name="date" class="form-control" required>
</div>

<div class="mb-3">
<label>Pemasok</label>
<input type="text" name="supplier" class="form-control" required>
</div>

<div class="mb-3">
<label>Total</label>
<input type="number" name="total" class="form-control" required>
</div>

<button class="btn btn-primary">Simpan</button>

</form>

</div>

<?= $this->endSection() ?>