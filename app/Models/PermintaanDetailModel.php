<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanDetailModel extends Model
{
    protected $table = 'permintaan_detail';
    protected $primaryKey = 'detail_id';
    protected $allowedFields = ['bahan_id','jumlah_peminta'];
}
