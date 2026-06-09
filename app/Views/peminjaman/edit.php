<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">

    <h3 class="mb-4">
        ✏️ Edit Peminjaman
    </h3>

    <form action="<?= site_url('peminjaman/update/'.$item['id']) ?>"
          method="post">

        <div class="mb-3">

            <label>Status</label>

            <select name="status"
                    class="form-control">

                <option value="dipinjam"
                    <?= $item['status']=='dipinjam'?'selected':'' ?>>
                    Dipinjam
                </option>

                <option value="dikembalikan"
                    <?= $item['status']=='dikembalikan'?'selected':'' ?>>
                    Dikembalikan
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Tanggal Kembali</label>

            <input type="date"
                   name="tanggal_kembali"
                   value="<?= $item['tanggal_kembali'] ?>"
                   class="form-control">

        </div>

        <button class="btn btn-success">
            Update
        </button>

        <a href="<?= site_url('peminjaman') ?>"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>