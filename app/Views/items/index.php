```php
<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>

.page-title{
    background:#1f2a6c;
    color:white;
    padding:15px 25px;
    font-weight:700;
    font-size:24px;
    border-radius:12px;
    margin-bottom:20px;
}

.btn-add{
    background:#8ec5d6;
    border:none;
    border-radius:12px;
    padding:12px 20px;
    text-decoration:none;
    color:#000;
    font-weight:600;
    transition:.3s;
}

.btn-add:hover{
    background:#6fb3c8;
    color:#000;
}

.search-box{
    background:#cde7ef;
    border:none;
    border-radius:12px;
    padding:10px 15px;
    min-width:250px;
}

.total-box{
    background:#8ec5d6;
    padding:15px;
    border-radius:12px;
    margin-bottom:15px;
    font-size:20px;
    font-weight:600;
}

.table{
    background:white;
    border-radius:12px;
    overflow:hidden;
}

.table thead{
    background:#8ec5d6;
}

.table th{
    text-align:center;
    vertical-align:middle;
    font-weight:700;
}

.table td{
    vertical-align:middle;
}

.stock{
    background:#2c3e75;
    color:white;
    padding:8px 14px;
    border-radius:10px;
    font-weight:bold;
    display:inline-block;
}

.kondisi{
    background:#dcdcdc;
    padding:8px 14px;
    border-radius:10px;
    display:inline-block;
}

.badge-sarana{
    background:#198754;
    color:white;
    padding:8px 12px;
    border-radius:8px;
    font-weight:600;
}

.badge-prasarana{
    background:#0d6efd;
    color:white;
    padding:8px 12px;
    border-radius:8px;
    font-weight:600;
}

.btn-edit{
    background:#ffd54f;
    border:none;
}

.btn-delete{
    background:#ff0000;
    color:white;
    border:none;
}

.btn-edit:hover,
.btn-delete:hover{
    transform:scale(1.05);
}

.status-box{
    padding:12px 25px;
    border-radius:12px;
    font-weight:bold;
    margin-left:10px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.status-baik{
    background:#8ec5d6;
}

.status-rusak{
    background:#ff0000;
    color:white;
}

.status-hilang{
    background:#fff200;
}

.pagination{
    display:flex;
    gap:8px;
    list-style:none;
    padding:0;
    margin-top:10px;
}

.pagination li a{
    display:block;
    padding:10px 16px;
    background:white;
    border:1px solid #dcdcdc;
    border-radius:10px;
    text-decoration:none;
    color:#1f2a6c;
    font-weight:600;
    transition:.3s;
}

.pagination li a:hover{
    background:#3b82f6;
    color:white;
    transform:translateY(-2px);
}

.pagination li.active a{
    background:#1f2a6c;
    color:white;
    border-color:#1f2a6c;
}

.pagination li.disabled span{
    display:block;
    padding:10px 16px;
    border-radius:10px;
    background:#f1f1f1;
    color:#999;
}

img{
    border-radius:8px;
}

</style>

<div class="container-fluid">

    <div class="page-title">Data Barang</div>

    <div class="d-flex justify-content-between my-3">
        <a href="<?= site_url('items/create') ?>" class="btn btn-add">
            + Tambah Barang
        </a>

        <form method="get" class="d-flex">
            <input type="text"
                   name="keyword"
                   class="search-box me-2"
                   value="<?= esc(request()->getGet('keyword')) ?>"
                   placeholder="Cari barang...">

            <button class="btn btn-light">Cari</button>
        </form>
    </div>

    <div class="total-box">
        Total Barang: <?= $total ?>
    </div>

    <table class="table table-bordered text-center align-middle">

        <thead style="background:#8ec5d6;">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Kode Barang</th>
                <th>Jenis Aset</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

       <tbody>
        <?php $no = 1 + (5 * ($currentPage - 1)); ?>
        <?php foreach($items as $item): ?>
            <tr>
                <td><?= $no++ ?></td>
            <td>
                <img src="<?= base_url('uploads/' . ($item['image'] ?? 'default.png')) ?>"
                     width="50">
            </td>

            <td>
                <?= esc($item['kode_barang']) ?>
            </td>

            <td>
                <?php if($item['jenis_aset'] == 'Sarana'): ?>
                    <span class="badge-sarana">
                        Sarana
                    </span>
                <?php else: ?>
                    <span class="badge-prasarana">
                        Prasarana
                    </span>
                <?php endif; ?>
            </td>

            <td><?= esc($item['name']) ?></td>

            <td><?= esc($item['category']) ?></td>

            <td>
                <span class="stock">
                    <?= $item['stock'] ?>
                    <?= $item['satuan'] ?? '' ?>
                </span>
            </td>

            <td>
                <span class="kondisi">
                    <?= ucfirst($item['item_condition']) ?>
                </span>
            </td>

            <td><?= esc($item['location']) ?></td>

            <td>
                <?= esc($item['keterangan'] ?? '-') ?>
            </td>

            <td>

                <a href="<?= site_url('items/edit/'.$item['id']) ?>"
                   class="btn btn-edit btn-sm">
                    ✏️
                </a>

                <button class="btn btn-delete btn-sm btn-delete"
                        data-id="<?= $item['id'] ?>">
                    🗑️
                </button>

            </td>

        </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

    <div class="d-flex justify-content-between mt-3">

        <div>
         <?= $pager->links('default', 'custom') ?>
        </div>

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

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.btn-delete').forEach(btn => {

        btn.addEventListener('click', function () {

            let id = this.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then(res => {

                if (res.isConfirmed) {

                    fetch("<?= site_url('items/delete') ?>/" + id, {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(r => r.json())
                    .then(d => {

                        if (d.success) {

                            Swal.fire(
                                'Berhasil',
                                d.message,
                                'success'
                            );

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
```
