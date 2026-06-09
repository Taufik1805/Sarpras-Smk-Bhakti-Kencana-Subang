```php
<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <h3 class="mb-4">
        Dashboard Guru
    </h3>

    <div class="alert alert-info">
        Selamat datang,
        <strong><?= session()->get('name') ?></strong>.
        Anda dapat melakukan peminjaman dan pengembalian barang.
    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>Total Barang</h5>

                    <h2 class="text-primary">
                        <?= $totalBarang ?>
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>Total Peminjaman</h5>

                    <h2 class="text-warning">
                        <?= $totalPeminjaman ?>
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>Total Pengembalian</h5>

                    <h2 class="text-success">
                        <?= $totalPengembalian ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    Menu Peminjaman
                </div>

                <div class="card-body">

                    <p>
                        Klik tombol berikut untuk melakukan peminjaman barang.
                    </p>

                    <a href="<?= site_url('peminjaman') ?>"
                       class="btn btn-primary">

                        Peminjaman Barang

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    Menu Pengembalian
                </div>

                <div class="card-body">

                    <p>
                        Klik tombol berikut untuk melakukan pengembalian barang.
                    </p>

                    <a href="<?= site_url('pengembalian') ?>"
                       class="btn btn-success">

                        Pengembalian Barang

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
```
