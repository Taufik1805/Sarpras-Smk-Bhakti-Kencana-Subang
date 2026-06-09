<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

    <h3 class="mb-4">
        Edit Pengguna
    </h3>

    <form action="<?= site_url('users/update/'.$user['id']) ?>"
          method="post">

        <div class="mb-3">

            <label>Nama</label>

            <input type="text"
                   name="name"
                   value="<?= $user['name'] ?>"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   value="<?= $user['email'] ?>"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Password Baru</label>

            <input type="password"
                   name="password"
                   class="form-control">

            <small class="text-muted">
                Kosongkan jika tidak ingin mengubah password
            </small>

        </div>

        <div class="mb-3">

            <label>Role</label>

            <select name="role"
                    class="form-control">

                <option value="admin"
                    <?= $user['role']=='admin' ? 'selected' : '' ?>>
                    Admin
                </option>

                <option value="guru"
                    <?= $user['role']=='guru' ? 'selected' : '' ?>>
                    Guru
                </option>

            </select>

        </div>

        <button class="btn btn-success">
            Update
        </button>

        <a href="<?= site_url('users') ?>"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>