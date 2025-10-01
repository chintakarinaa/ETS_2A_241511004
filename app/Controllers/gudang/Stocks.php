<?php

namespace App\Controllers\gudang;

use App\Controllers\BaseController;
use App\Models\StockModel;

class Stocks extends BaseController
{
    public function index()
    {
        $stockModel = new StockModel();
        $stocks = $stockModel->findAll();

        $today = date('Y-m-d');
        foreach ($stocks as &$s) {
            if ($s['jumlah'] == 0) {
                $s['status'] = 'habis';
            } elseif ($today >= $s['tanggal_kadaluarsa']) {
                $s['status'] = 'kadaluarsa';
            } elseif ((strtotime($s['tanggal_kadaluarsa']) - strtotime($today)) / 86400 <= 3) {
                $s['status'] = 'segera kadaluarsa';
            } else {
                $s['status'] = 'tersedia';
            }
        }

        $data['stocks'] = $stocks;
        $data['title'] = 'Manage Stocks';
        return view('gudang/stocks/index', $data);
    }

    public function create()
    {
        return view('gudang/stocks/create', ['title' => 'Add Stock']);
    }

    public function store()
    {
        $stockModel = new StockModel();

        $stockModel->insert([
            'nama'              => $this->request->getPost('nama'),
            'kategori'          => $this->request->getPost('kategori'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'satuan'            => $this->request->getPost('satuan'),
            'tanggal_masuk'     => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa'=> $this->request->getPost('tanggal_kadaluarsa'),
            'status'            => 'tersedia',
        ]);

        return redirect()->to('/gudang/stocks')->with('success', 'Stock added successfully!');
    }
}
