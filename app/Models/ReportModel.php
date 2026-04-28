<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'item_id',
        'description',
        'photo',
        'status'
    ];

    protected $useTimestamps = true;
}