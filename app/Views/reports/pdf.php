<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial;
            font-size: 12px;
        }

        .kop {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>

<?php
// 🔥 FIX LOGO DOMPDF (BASE64)
$path = ROOTPATH . 'public/logo.png';

$base64 = '';
if (is_file($path)) {
    $image = file_get_contents($path);
    $base64 = 'data:image/png;base64,' . base64_encode($image);
}
?>

<!-- 🔥 KOP SURAT -->
<div class="kop">
    <table>
        <tr>
            <!-- LOGO -->
            <td width="15%" style="border: none;">
                <?php if ($base64): ?>
                    <img src="<?= $base64 ?>" width="80">
                <?php endif; ?>
            </td>

            <!-- TEXT -->
            <td width="85%" style="border: none; text-align: center;">
                <h2 style="margin:0;">SMK Bhakti Kencana Subang</h2>
                <h4 style="margin:0;">Laporan Sarana dan Prasarana</h4>
                <p style="margin:0;">Jl. Contoh No.123 Subang</p>
            </td>
        </tr>
    </table>

    <hr style="border:2px solid black;">
</div>

<!-- 🔥 TANGGAL -->
<p><b>Tanggal Cetak:</b> <?= date('d-m-Y') ?></p>

<!-- 🔥 TABEL DATA -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Deskripsi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($reports as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['description'] ?></td>
            <td><?= $r['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 🔥 TANDA TANGAN -->
<div class="ttd">
    <p>Subang, <?= date('d-m-Y') ?></p>
    <p>Kepala Sekolah</p>

    <br><br><br>

    <p><b>(Nama Kepala Sekolah)</b></p>
</div>

</body>
</html>