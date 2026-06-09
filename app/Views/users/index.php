<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <h3>Data Pengguna</h3>

        <a href="<?= site_url('users/create') ?>"
           class="btn btn-primary">
            + Tambah Pengguna
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-primary">

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>

                </thead>

                <tbody>

                <?php $no=1; ?>

                <?php foreach($users as $u): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td><?= $u['name'] ?></td>

                    <td><?= $u['email'] ?></td>

                    <td><?= ucfirst($u['role']) ?></td>

                    <td>

                        <a href="<?= site_url('users/edit/'.$u['id']) ?>"
                           class="btn btn-warning btn-sm">
                            ✏️
                        </a>

                        <a href="<?= site_url('users/delete/'.$u['id']) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus pengguna?')">
                            🗑️
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>