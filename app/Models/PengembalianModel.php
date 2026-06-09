<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'pengembalian';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode_pengembalian',
        'peminjaman_id',
        'tanggal_kembali',
        'kondisi_barang',
        'keterangan'
    ];

    protected $useTimestamps = true;
}