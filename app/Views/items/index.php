<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.page-title {
    background: #1f2a6c;
    color: white;
    padding: 12px 20px;
    font-weight: bold;
    border-radius: 10px;
}

.btn-add {
    background: #8ec5d6;
    border-radius: 10px;
    padding: 8px 15px;
    text-decoration: none;
    color: black;
}

.search-box {
    background: #cde7ef;
    border-radius: 10px;
    border: none;
    padding: 8px;
}

.total-box {
    background: #8ec5d6;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
}

.stock {
    background: #2c3e75;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: bold;
}

.kondisi {
    background: #dcdcdc;
    padding: 6px 12px;
    border-radius: 8px;
}

.btn-edit { background: #ffd54f; }
.btn-delete { background: red; color:white; }

.status-box {
    padding: 8px 20px;
    border-radius: 5px;
    margin-right: 10px;
}

.status-baik { background: #8ec5d6; }
.status-rusak { background: red; color:white; }
.status-hilang { background: yellow; }
</style>

<div class="container-fluid">

    <div class="page-title">Data Barang</div>

    <div class="d-flex justify-content-between my-3">
        <a href="<?= site_url('items/create') ?>" class="btn btn-add">
            + Tambah Barang
        </a>

        <form method="get" class="d-flex">
            <input type="text" name="keyword" class="search-box me-2"
                   value="<?= esc(request()->getGet('keyword')) ?>"
                   placeholder="Cari barang...">
            <button class="btn btn-light">🔍</button>
        </form>
    </div>

    <div class="total-box">
        Total Barang: <?= $total ?>
    </div>

    <!-- TABLE -->
    <table class="table table-bordered text-center align-middle">
        <thead style="background:#8ec5d6;">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($items as $i => $item): ?>
        <tr>
            <td><?= $i+1 ?></td>

            <td>
                <img src="<?= base_url('uploads/'.($item['image'] ?? 'default.png')) ?>" width="50">
            </td>

            <td><?= $item['name'] ?></td>
            <td><?= $item['category'] ?></td>

            <td><span class="stock"><?= $item['stock'] ?></span></td>

            <td><span class="kondisi"><?= ucfirst($item['item_condition']) ?></span></td>

            <td><?= $item['location'] ?></td>

            <td>
                <a href="<?= site_url('items/edit/'.$item['id']) ?>" class="btn btn-edit btn-sm">✏️</a>

                <button class="btn btn-delete btn-sm btn-delete"
                        data-id="<?= $item['id'] ?>">🗑️</button>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 🔥 PAGINATION -->
    <div class="d-flex justify-content-between mt-3">

        <div>
            <?= $pager->links() ?>
        </div>

        <!-- 🔥 STATUS REAL -->
        <div>
            <span class="status-box status-baik">
                Baik <?= $baik ?>
            </span>

            <span class="status-box status-rusak">
                Rusak <?= $rusak ?>
            </span>

            <span class="status-box status-hilang">
                Hilang <?= $hilang ?>
            </span>
        </div>

    </div>

</div>

<!-- DELETE -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.btn-delete').forEach(btn => {

        btn.addEventListener('click', function () {

            let id = this.dataset.id;

            Swal.fire({
                title: 'Yakin?',
                icon: 'warning',
                showCancelButton: true
            }).then(res => {

                if(res.isConfirmed){

                    fetch("<?= site_url('items/delete') ?>/"+id, {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(r=>r.json())
                    .then(d=>{
                        if(d.success){
                            this.closest('tr').remove();
                        }
                    });

                }

            });

        });

    });

});
</script>

<?= $this->endSection() ?>