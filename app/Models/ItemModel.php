<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'category',
        'stock',
         'item_condition',
        'location',
        'image' // 🔥 WAJIB TAMBAH INI
    ];

    protected $useTimestamps = true;
}