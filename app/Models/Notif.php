<?php

namespace App\Models;

use CodeIgniter\Model;

class Notif extends Model
{
    protected $table            = 'notif';
    protected $primaryKey       = 'id_notif';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['notif', 'pesan', 'is_active', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
