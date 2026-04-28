<?php

namespace App\Models;

use CodeIgniter\Model;

class PengadaanModel extends Model
{
    protected $table = 'pengadaan';
    protected $allowedFields = [
        'item_name','date','supplier','total','status'
    ];
}