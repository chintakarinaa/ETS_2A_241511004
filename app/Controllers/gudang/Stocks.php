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

            // update ke DB biar status sinkron
            $stockModel->update($s['id'], ['status' => $s['status']]);
        }
        $data['stocks'] = $stocks;
        $data['title']  = 'Manage Stocks';
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

    public function edit($id)
    {
        $stockModel = new StockModel();
        $data['stock'] = $stockModel->find($id);
        return view('gudang/stocks/edit', $data);
    }

    public function update($id)
    {
        $stockModel = new StockModel();

        $jumlah = (int)$this->request->getPost('jumlah'); 

        // Validasi jumlah
        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'Jumlah stok tidak boleh kurang dari 0!');
        }

        // Cuman update kolom jumlah
        $stockModel->update($id, [
            'jumlah' => $jumlah
        ]);

        return redirect()->to('/gudang/stocks')->with('success', 'Jumlah stok berhasil diupdate!');
        }

        public function delete($id)
        {
            $stockModel = new StockModel();
            $stock = $stockModel->find($id);

            $today = date('Y-m-d');
            if ($stock['jumlah'] == 0) {
                $stock['status'] = 'habis';
            } elseif ($today >= $stock['tanggal_kadaluarsa']) {
                $stock['status'] = 'kadaluarsa';
            } elseif ((strtotime($stock['tanggal_kadaluarsa']) - strtotime($today)) / 86400 <= 3) {
                $stock['status'] = 'segera kadaluarsa';
            } else {
                $stock['status'] = 'tersedia';
            }

        if ($stock['status'] !== 'kadaluarsa') 
            {
            return redirect()->to('/gudang/stocks')->with('error', 'Data tidak bisa dihapus karena belum kadaluarsa');
        }
        
        $stockModel->delete($id);
        return redirect()->to('/gudang/stocks')->with('success', 'Stock berhasil dihapus!');

    }

}
