<?php

namespace App\Controllers\gudang;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use CodeIgniter\HTTP\ResponseInterface;

class Courses extends BaseController
{
    public function index()
    {
        $stockModel = new StockModel();
        $data['stocks'] = $stockModel->findAll();
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
            'stock_name' => $this->request->getPost('stock_name'),
            'category' => $this->request->getPost('category'),
            'quantity' => $this->request->getPost('quantity'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $this->request->getPost('status'),
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

        $stockModel->update($id, [
            'stock_name' => $this->request->getPost('stock_name'),
            'category' => $this->request->getPost('category'),
            'quantity' => $this->request->getPost('quantity'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/gudang/stocks')->with('success', 'Stock updated!');
    }

    public function delete($id)
    {
        $stockModel = new StockModel();
        $stockModel->delete($id);

        return redirect()->to('/gudang/stocks')->with('success', 'Stock deleted!');
    }
}
