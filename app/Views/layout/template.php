<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'Sarpras' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f5f7fb;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    position: fixed;
    background: #1f2a6c;
    color: white;
    padding: 20px 10px;
}

/* LOGO */
.logo-box {
    text-align: center;
    margin-bottom: 25px;
}

.logo-box img {
    width: 60px;
    margin-bottom: 10px;
}

.logo-text {
    font-weight: bold;
    font-size: 14px;
}

/* MENU */
.menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    margin: 5px 10px;
    border-radius: 10px;
    color: #cbd5e1;
    text-decoration: none;
    transition: 0.3s;
}

.menu a:hover {
    background: rgba(255,255,255,0.1);
    color: white;
}

.menu a.active {
    background: #3b82f6;
    color: white;
}

/* TOPBAR */
.topbar {
    margin-left: 240px;
    height: 60px;
    background: linear-gradient(to right, #1f2a6c, #3b82f6);
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
}

/* CONTENT */
.content {
    margin-left: 240px;
    padding: 25px;
}

/* PROFILE */
.profile {
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
}
</style>
</head>

<body>

<?php $uri = service('uri'); ?>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo-box">
        <img src="<?= base_url('uploads/logo.png') ?>">
        <div class="logo-text">SMK Bhakti Kencana</div>
    </div>

    <div class="menu">

        <a href="<?= site_url('dashboard') ?>" class="<?= $uri->getSegment(1)=='dashboard'?'active':'' ?>">
            <i class="fa fa-home"></i> Dashboard
        </a>

        <a href="<?= site_url('items') ?>" class="<?= $uri->getSegment(1)=='items'?'active':'' ?>">
            <i class="fa fa-box"></i> Data Barang
        </a>

        <a href="<?= site_url('pengadaan') ?>" class="<?= $uri->getSegment(1)=='pengadaan'?'active':'' ?>">
            <i class="fa fa-shopping-cart"></i> Pengadaan
        </a>

        <a href="#">
            <i class="fa fa-handshake"></i> Peminjaman
        </a>

        <a href="#">
            <i class="fa fa-undo"></i> Pengembalian
        </a>

        <a href="<?= site_url('reports') ?>" class="<?= $uri->getSegment(1)=='reports'?'active':'' ?>">
            <i class="fa fa-chart-bar"></i> Laporan
        </a>

        <a href="#">
            <i class="fa fa-users"></i> Pengguna
        </a>

        <a href="<?= site_url('logout') ?>" style="color:#ff6b6b;">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>

    </div>

</div>

<!-- TOPBAR -->
<div class="topbar">

    <div><?= $title ?? 'Dashboard' ?></div>

    <div class="profile">
        <i class="fa fa-bell"></i>
        <img src="https://i.pravatar.cc/100">
    </div>

</div>

<!-- CONTENT -->
<div class="content">
    <?= $this->renderSection('content') ?>
</div>

</body>
</html>