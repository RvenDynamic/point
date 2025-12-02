<?php

namespace App\Models;

use CodeIgniter\Model;

class Detail extends Model
{
    protected $table            = 'detail';
    protected $primaryKey       = 'id_detail';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_point', 'id_jenis'];
}
