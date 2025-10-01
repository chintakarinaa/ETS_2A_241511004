<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'permintaan_id';
    protected $allowedFields = ['pemohon_id', 'tanggal_masak', 'menu_makan', 'jumlah_porsi', 'status', 'created_at'];
}
