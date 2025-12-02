<?php

namespace App\Models;

use CodeIgniter\Model;

class Sanksi extends Model
{
    protected $table            = 'sanksi';
    protected $primaryKey       = 'id_sanksi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengendara', 'tanggal_sanksi'];
}
