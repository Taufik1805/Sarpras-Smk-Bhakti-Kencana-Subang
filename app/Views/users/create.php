<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

    <h3 class="mb-4">
        Tambah Pengguna
    </h3>

    <form action="<?= site_url('users/store') ?>" method="post">

        <div class="mb-3">

            <label>Nama</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Role</label>

           <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
             <option value="guru">Guru</option>
              <option value="kepala_sekolah">Kepala Sekolah</option>
            </select>
            
        </div>

        <button class="btn btn-success">
            Simpan
        </button>

        <a href="<?= site_url('users') ?>"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>