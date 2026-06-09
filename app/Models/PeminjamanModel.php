<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode_peminjaman',
        'nama_peminjam',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan'
    ];

    protected $useTimestamps = true;
}