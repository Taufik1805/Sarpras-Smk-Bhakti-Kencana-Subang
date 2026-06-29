<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>
.glass-card{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(12px);
    border-radius:20px;
    color:white;
    transition:.3s;
}

.glass-card:hover{
    transform:translateY(-5px);
    box-shadow:0 0 20px rgba(0,255,255,.2);
}

.gradient-blue{
    background:linear-gradient(135deg,#3b82f6,#06b6d4);
}

.gradient-green{
    background:linear-gradient(135deg,#22c55e,#4ade80);
}

.gradient-red{
    background:linear-gradient(135deg,#ef4444,#f87171);
}

.gradient-purple{
    background:linear-gradient(135deg,#7c3aed,#a78bfa);
}

.counter{
    font-size:32px;
    font-weight:bold;
}

.table-card{
    background:white;
    border-radius:15px;
    padding:20px;
}
</style>

<div class="container-fluid">

    <h3 class="mb-4">Dashboard Kepala Sekolah</h3>

    <div class="alert alert-primary">
        Selamat Datang,
        <strong><?= session()->get('name') ?></strong>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-blue">
                <h6>Total Barang</h6>
                <div class="counter" data-target="<?= $total ?>">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-green">
                <h6>Barang Baik</h6>
                <div class="counter" data-target="<?= $baik ?>">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-red">
                <h6>Barang Rusak</h6>
                <div class="counter" data-target="<?= $rusak ?>">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-purple">
                <h6>Barang Hilang</h6>
                <div class="counter" data-target="<?= $hilang ?>">0</div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="glass-card p-4">
                <h5>Kondisi Barang</h5>
                <canvas id="kondisiChart"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="glass-card p-4">
                <h5>Kategori Barang</h5>
                <canvas id="kategoriChart"></canvas>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-12">

            <div class="table-card">

                <div class="d-flex justify-content-between mb-3">

                    <h5>Barang Rusak</h5>

                    <a href="<?= base_url('reports') ?>"
                       class="btn btn-primary">

                        <i class="fa fa-file-pdf"></i>
                        Lihat Laporan

                    </a>

                </div>

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(!empty($barangRusak)): ?>

                        <?php foreach($barangRusak as $item): ?>

                        <tr>
                            <td><?= esc($item['kode_barang']) ?></td>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['category']) ?></td>
                            <td><?= esc($item['location']) ?></td>
                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak ada barang rusak
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.querySelectorAll('.counter').forEach(counter => {

    const update = () => {

        const target = +counter.dataset.target;
        const count = +counter.innerText;
        const inc = target / 30;

        if(count < target){
            counter.innerText = Math.ceil(count + inc);
            setTimeout(update,20);
        }else{
            counter.innerText = target;
        }
    };

    update();
});

new Chart(document.getElementById('kondisiChart'),{
    type:'doughnut',
    data:{
        labels:['Baik','Rusak','Hilang'],
        datasets:[{
            data:[
                <?= $baik ?>,
                <?= $rusak ?>,
                <?= $hilang ?>
            ],
            backgroundColor:[
                '#22c55e',
                '#ef4444',
                '#7c3aed'
            ]
        }]
    }
});

const kategoriLabels = [
<?php foreach($kategoriData as $k): ?>
"<?= $k['category'] ?>",
<?php endforeach; ?>
];

const kategoriData = [
<?php foreach($kategoriData as $k): ?>
<?= $k['total'] ?>,
<?php endforeach; ?>
];

new Chart(document.getElementById('kategoriChart'),{
    type:'bar',
    data:{
        labels:kategoriLabels,
        datasets:[{
            data:kategoriData,
            backgroundColor:'#06b6d4',
            borderRadius:10
        }]
    },
    options:{
        plugins:{
            legend:{
                display:false
            }
        }
    }
});

</script>

<?= $this->endSection() ?>