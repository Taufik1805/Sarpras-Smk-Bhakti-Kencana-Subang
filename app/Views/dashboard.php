<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>
.glass-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    color: white;
    transition: 0.3s;
}
.glass-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 0 25px rgba(0,255,255,0.2);
}
.gradient-blue { background: linear-gradient(135deg,#3b82f6,#06b6d4); }
.gradient-green { background: linear-gradient(135deg,#22c55e,#4ade80); }
.gradient-red { background: linear-gradient(135deg,#ef4444,#f87171); }
.gradient-dark { background: linear-gradient(135deg,#111827,#374151); }

.counter {
    font-size: 32px;
    font-weight: bold;
}

canvas {
    filter: drop-shadow(0 0 10px rgba(0,255,255,0.4));
}
</style>

<div class="container-fluid">

    <h3 class="mb-4">📊 Dashboard Sarpras</h3>

    <!-- ===================== -->
    <!-- 📊 STAT -->
    <!-- ===================== -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-blue">
                <h6>Total</h6>
                <div class="counter" data-target="<?= $total ?? 0 ?>">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-green">
                <h6>Baik</h6>
                <div class="counter" data-target="<?= $baik ?? 0 ?>">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-red">
                <h6>Rusak</h6>
                <div class="counter" data-target="<?= $rusak ?? 0 ?>">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card p-4 text-center gradient-dark">
                <h6>Hilang</h6>
                <div class="counter" data-target="<?= $hilang ?? 0 ?>">0</div>
            </div>
        </div>

    </div>

    <!-- ===================== -->
    <!-- 📦 KATEGORI -->
    <!-- ===================== -->
    <div class="row g-3 mb-4">

        <?php if (!empty($kategoriData)): ?>
            <?php foreach ($kategoriData as $k): ?>
                <div class="col-md-3">
                    <div class="glass-card p-4 text-center">
                        <h6>📦 <?= esc($k['category']) ?></h6>
                        <div class="counter text-info" data-target="<?= $k['total'] ?>">0</div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center text-muted">Belum ada data kategori</div>
        <?php endif; ?>

    </div>

    <!-- ===================== -->
    <!-- 📊 CHART -->
    <!-- ===================== -->
    <div class="row g-4">

        <div class="col-md-6">
            <div class="glass-card p-4">
                <h5>Kondisi Barang</h5>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="glass-card p-4">
                <h5>Kategori Barang</h5>
                <canvas id="barChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ======================
// 🔥 ANIMASI ANGKA
// ======================
document.querySelectorAll('.counter').forEach(counter => {
    const update = () => {
        const target = +counter.dataset.target;
        const count = +counter.innerText;
        const inc = target / 30;

        if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(update, 20);
        } else {
            counter.innerText = target;
        }
    };
    update();
});

// ======================
// PIE CHART
// ======================
new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['Baik','Rusak','Hilang','Habis'],
        datasets: [{
            data: [
                <?= $baik ?? 0 ?>,
                <?= $rusak ?? 0 ?>,
                <?= $hilang ?? 0 ?>,
                <?= $habis ?? 0 ?>
            ],
            backgroundColor: [
                '#22c55e',
                '#ef4444',
                '#111827',
                '#facc15'
            ]
        }]
    },
    options: {
        plugins: {
            legend: { labels: { color: 'white' } }
        }
    }
});

// ======================
// BAR CHART
// ======================
const labels = [
<?php if (!empty($kategoriData)): ?>
    <?php foreach ($kategoriData as $k): ?>
        "<?= $k['category'] ?>",
    <?php endforeach; ?>
<?php endif; ?>
];

const data = [
<?php if (!empty($kategoriData)): ?>
    <?php foreach ($kategoriData as $k): ?>
        <?= $k['total'] ?>,
    <?php endforeach; ?>
<?php endif; ?>
];

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: '#06b6d4',
            borderRadius: 10
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: 'white' } },
            y: { ticks: { color: 'white' } }
        }
    }
});
</script>

<?= $this->endSection() ?>