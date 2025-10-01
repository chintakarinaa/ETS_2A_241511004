<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'bahan_baku';     
    protected $primaryKey = 'id';        
    
    protected $allowedFields = [
        'nama',
        'kategori',
        'jumlah',
        'satuan',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'status',
        'created_at'
    ];
    
    protected $useTimestamps = false;
}
