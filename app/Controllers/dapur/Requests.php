<?php

namespace App\Controllers\dapur;

use App\Controllers\BaseController;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\StockModel;

class Requests extends BaseController
{

    public function index()
    {
        $permintaanModel = new \App\Models\PermintaanModel();
        $detailModel     = new \App\Models\PermintaanDetailModel();
        $stockModel      = new \App\Models\StockModel();

        $permintaan = $permintaanModel->findAll();

        foreach ($permintaan as &$p) {
            $details = $detailModel->where('permintaan_id', $p['id'])->findAll();

            foreach ($details as &$d) {
                $stok = $stockModel->find($d['bahan_id']);
                $d['nama_bahan'] = $stok['nama'] ?? 'Unknown';
                $d['satuan']     = $stok['satuan'] ?? '';
            }

            $p['detail_bahan'] = $details;
        }

        return view('dapur/index', [
            'permintaan' => $permintaan
        ]);
    }

    public function create()
    {
        $stockModel = new StockModel();
        $bahan = $stockModel->where('jumlah >', 0)
                            ->where('status !=', 'kadaluarsa')
                            ->findAll();

        return view('dapur/create', ['bahan' => $bahan]);
    }

    public function store()
    {
        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();
        $pemohonId = session()->get('id');

        // Validasi login
        if (!$pemohonId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $permintaanId = $permintaanModel->insert([
            'pemohon_id' => session()->get('id'),
            'tgl_masak' => $this->request->getPost('tgl_masak'),
            'menu_makan' => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status' => 'menunggu',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlahs   = $this->request->getPost('jumlah_diminta');

        foreach ($bahan_ids as $i => $bahan_id) {
            $detailModel->insert([
                'permintaan_id' => $permintaanId,
                'bahan_id' => $bahan_id,
                'jumlah_diminta' => $jumlahs[$i]
            ]);
        }

        return redirect()->to('/dapur/requests/create')->with('success', 'Permintaan berhasil dibuat')->with('success_two_buttons', true);

    }
}
