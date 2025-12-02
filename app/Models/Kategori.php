<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table            = 'kategori_pelanggaran';
    protected $primaryKey       = 'id_kategori';
    protected $allowedFields    = ['kategori', 'bobot_point'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}