<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';
    protected $allowedFields = ['stock_name', 'category', 'quantity', 'satuan', 'tanggal_masuk', 'tanggal_kadaluarsa', 'status', 'created_at'];
}
