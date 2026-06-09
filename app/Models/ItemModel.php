<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode_barang',
        'jenis_aset',
        'name',
        'category',
        'stock',
        'item_condition',
        'location',
        'keterangan',
        'image'
    ];

    protected $useTimestamps = true;
}