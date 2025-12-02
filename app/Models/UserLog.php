<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLog extends Model
{
    protected $table            = 'user_log';
    protected $primaryKey       = 'id_user_log';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'ip_address', 'device', 'created_at', 'updated_at', 'deleted_at'];

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
