<?php

namespace App\Models;

use CodeIgniter\Model;

class PengadaanModel extends Model
{
    protected $table = 'pengadaan';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode_pengadaan',
        'nama_barang',
        'jenis_aset',
        'jumlah',
        'harga_satuan',
        'tanggal_pengadaan',
        'pemasok',
        'total_harga',
        'sumber_dana',
        'lokasi_penempatan',
        'keterangan',
        'status'
    ];

    protected $useTimestamps = true;
}