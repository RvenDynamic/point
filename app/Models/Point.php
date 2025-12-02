<?php

namespace App\Models;

use CodeIgniter\Model;

class Point extends Model
{
    protected $table            = 'point';
    protected $primaryKey       = 'id_point';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'id_pengendara', 'tanggal_sidang', 'total_point', 'last_reset', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
