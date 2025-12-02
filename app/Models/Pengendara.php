<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengendara extends Model
{
    protected $table            = 'pengendara';
    protected $primaryKey       = 'id_pengendara';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['no_sim', 'tipe_sim', 'nama_pengendara', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'pekerjaan', 'provinsi', 'tanggal_berlaku', 'email'];
}
