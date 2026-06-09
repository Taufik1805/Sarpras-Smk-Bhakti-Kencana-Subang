<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Laporan Sarana dan Prasarana</title>

<style>

body{
    font-family: Arial, sans-serif;
    font-size: 11px;
}

h2{
    text-align:center;
    margin-bottom:20px;
}

h3{
    margin-top:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-bottom:20px;
}

th,td{
    border:1px solid #000;
    padding:5px;
}

th{
    background:#d9d9d9;
}

</style>

</head>

<body>

<h2>LAPORAN SARANA DAN PRASARANA</h2>

<h3>Data Barang</h3>

<table>

<tr>
    <th>No</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Jenis Aset</th>
    <th>Kategori</th>
    <th>Stok</th>
    <th>Kondisi</th>
</tr>

<?php $no=1; ?>

<?php foreach($barang as $b): ?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $b['kode_barang'] ?></td>
    <td><?= $b['name'] ?></td>
    <td><?= $b['jenis_aset'] ?></td>
    <td><?= $b['category'] ?></td>
    <td><?= $b['stock'] ?></td>
    <td><?= ucfirst($b['item_condition']) ?></td>
</tr>

<?php endforeach; ?>

</table>


<h3>Data Pengadaan</h3>

<table>

<tr>
    <th>No</th>
    <th>Barang</th>
    <th>Pemasok</th>
    <th>Total</th>
    <th>Status</th>
</tr>

<?php $no=1; ?>

<?php foreach($pengadaan as $p): ?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['item_name'] ?></td>
    <td><?= $p['supplier'] ?></td>
    <td><?= number_format($p['total'],0,',','.') ?></td>
    <td><?= ucfirst($p['status']) ?></td>
</tr>

<?php endforeach; ?>

</table>


<h3>Data Peminjaman</h3>

<table>

<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Peminjam</th>
    <th>Jumlah</th>
    <th>Tanggal Pinjam</th>
    <th>Status</th>
</tr>

<?php $no=1; ?>

<?php foreach($peminjaman as $p): ?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['kode_peminjaman'] ?></td>
    <td><?= $p['nama_peminjam'] ?></td>
    <td><?= $p['jumlah'] ?></td>
    <td><?= $p['tanggal_pinjam'] ?></td>
    <td><?= ucfirst($p['status']) ?></td>
</tr>

<?php endforeach; ?>

</table>


<h3>Data Pengembalian</h3>

<table>

<tr>
    <th>No</th>
    <th>Kode Pengembalian</th>
    <th>Tanggal Kembali</th>
    <th>Kondisi Barang</th>
    <th>Keterangan</th>
</tr>

<?php $no=1; ?>

<?php foreach($pengembalian as $p): ?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['kode_pengembalian'] ?></td>
    <td><?= $p['tanggal_kembali'] ?></td>
    <td><?= ucfirst($p['kondisi_barang']) ?></td>
    <td><?= $p['keterangan'] ?></td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>