<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?? 'Sistem Sarana dan Prasarana' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f5f7fb;
}

.sidebar{
    width:240px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#1f2a6c;
    color:white;
    overflow-y:auto;
    z-index:1000;
}

.logo-box{
    text-align:center;
    padding:20px;
}

.logo-box img{
    width:70px;
    margin-bottom:10px;
}

.logo-text{
    font-weight:bold;
    font-size:14px;
    line-height:1.4;
}

.menu{
    padding:10px 0;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 18px;
    margin:5px 10px;
    border-radius:10px;
    color:#cbd5e1;
    text-decoration:none;
    transition:.3s;
}

.menu a:hover{
    background:rgba(255,255,255,.1);
    color:white;
}

.menu a.active{
    background:#3b82f6;
    color:white;
}

.menu i{
    width:20px;
}

.topbar{
    margin-left:240px;
    height:65px;
    background:linear-gradient(to right,#1f2a6c,#3b82f6);
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
}

.page-title{
    font-size:18px;
    font-weight:600;
}

.profile{
    display:flex;
    align-items:center;
    gap:15px;
}

.profile img{
    width:40px;
    height:40px;
    border-radius:50%;
    object-fit:cover;
    cursor:pointer;
    border:2px solid rgba(255,255,255,.3);
}

.dropdown-menu{
    border:none;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.content{
    margin-left:240px;
    padding:25px;
}

</style>

</head>
<body>

<?php $uri = service('uri'); ?>

<div class="sidebar">

    <div class="logo-box">
        <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo">

        <div class="logo-text">
            SMK Bhakti Kencana
            <br>
            Sistem Sarana dan Prasarana
        </div>
    </div>

    <div class="menu">

        <?php if(session()->get('role') == 'admin'): ?>

            <a href="<?= site_url('dashboard') ?>"
               class="<?= $uri->getSegment(1)=='dashboard' ? 'active' : '' ?>">
                <i class="fa fa-home"></i>
                Dashboard
            </a>

            <a href="<?= site_url('items') ?>"
               class="<?= $uri->getSegment(1)=='items' ? 'active' : '' ?>">
                <i class="fa fa-box"></i>
                Data Barang
            </a>

            <a href="<?= site_url('pengadaan') ?>"
               class="<?= $uri->getSegment(1)=='pengadaan' ? 'active' : '' ?>">
                <i class="fa fa-shopping-cart"></i>
                Pengadaan
            </a>

            <a href="<?= site_url('peminjaman') ?>"
               class="<?= $uri->getSegment(1)=='peminjaman' ? 'active' : '' ?>">
                <i class="fa fa-handshake"></i>
                Peminjaman
            </a>

            <a href="<?= site_url('pengembalian') ?>"
               class="<?= $uri->getSegment(1)=='pengembalian' ? 'active' : '' ?>">
                <i class="fa fa-undo"></i>
                Pengembalian
            </a>

            <a href="<?= site_url('reports') ?>"
               class="<?= $uri->getSegment(1)=='reports' ? 'active' : '' ?>">
                <i class="fa fa-chart-bar"></i>
                Laporan
            </a>

            <a href="<?= site_url('users') ?>"
               class="<?= $uri->getSegment(1)=='users' ? 'active' : '' ?>">
                <i class="fa fa-users"></i>
                Pengguna
            </a>

        <?php endif; ?>

        <?php if(session()->get('role') == 'guru'): ?>

            <a href="<?= site_url('dashboard-guru') ?>"
               class="<?= $uri->getSegment(1)=='dashboard-guru' ? 'active' : '' ?>">
                <i class="fa fa-home"></i>
                Dashboard Guru
            </a>

            <a href="<?= site_url('peminjaman') ?>"
               class="<?= $uri->getSegment(1)=='peminjaman' ? 'active' : '' ?>">
                <i class="fa fa-handshake"></i>
                Peminjaman
            </a>

            <a href="<?= site_url('pengembalian') ?>"
               class="<?= $uri->getSegment(1)=='pengembalian' ? 'active' : '' ?>">
                <i class="fa fa-undo"></i>
                Pengembalian
            </a>

        <?php endif; ?>

    </div>

</div>

<div class="topbar">

    <div class="page-title">
        <?= $title ?? 'Dashboard' ?>
    </div>

    <div class="profile dropdown">

        <i class="fa fa-bell"></i>

        <a href="#"
           class="text-white text-decoration-none"
           data-bs-toggle="dropdown">

            <img src="<?= base_url('uploads/profile/admin.png') ?>" alt="Profile">

        </a>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>
                <h6 class="dropdown-header">
                    <?= session()->get('name') ?>
                </h6>
            </li>

            <li>
                <span class="dropdown-item-text text-muted">
                    <?= ucfirst(session()->get('role')) ?>
                </span>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item text-danger"
                   href="<?= site_url('logout') ?>">

                    <i class="fa fa-sign-out-alt"></i>
                    Logout

                </a>
            </li>

        </ul>

    </div>

</div>

<div class="content">
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>