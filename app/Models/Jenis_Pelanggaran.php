<?php

namespace App\Models;

use CodeIgniter\Model;

class Jenis_Pelanggaran extends Model
{
    protected $table            = 'jenis_pelanggaran';
    protected $primaryKey       = 'id_jenis';
    protected $allowedFields    = ['id_kategori', 'nama_pelanggaran'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}