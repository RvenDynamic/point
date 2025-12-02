<?php

namespace App\Models;

use CodeIgniter\Model;

class LupaPassword extends Model
{
    protected $table            = 'lupa_password';
    protected $primaryKey       = 'id_forgot';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'kode'];
}
