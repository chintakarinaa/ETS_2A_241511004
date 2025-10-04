<?php

namespace App\Controllers\gudang;

use App\Controllers\BaseController;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\StockModel;

class Requests extends BaseController
{
    public function index()
    {
        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();
        $stockModel = new StockModel();

        $requests = $permintaanModel
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($requests as &$r) {
            $details = $detailModel
                ->where('permintaan_id', $r['id'])
                ->findAll();

            foreach ($details as &$d) {
                $stok = $stockModel->find($d['bahan_id']);
                $d['nama_bahan'] = $stok['nama'] ?? 'Unknown';
                $d['satuan'] = $stok['satuan'] ?? '';
            }

            $r['detail_bahan'] = $details;
        }

        return view('gudang/requests/index', [
            'requests' => $requests,
            'title' => 'Permintaan Bahan Masuk',
        ]);
    }

    public function approve($id)
    {
        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();
        $stockModel = new StockModel();

        $details = $detailModel->where('permintaan_id', $id)->findAll();

        foreach ($details as $item) {
            $stock = $stockModel->find($item['bahan_id']);

            if (!$stock || $stock['jumlah'] < $item['jumlah_diminta']) {
                return redirect()->back()->with('error', 'Stok tidak cukup untuk bahan: ' . ($stock['nama'] ?? 'Tidak diketahui'));
            }

            $jumlahBaru = $stock['jumlah'] - $item['jumlah_diminta'];
            $statusBaru = $jumlahBaru == 0 ? 'habis' : $stock['status'];

            $stockModel->update($stock['id'], [
                'jumlah' => $jumlahBaru,
                'status' => $statusBaru
            ]);
        }

        // Update status permintaan jadi disetujui
        $permintaanModel->update($id, ['status' => 'disetujui']);

        return redirect()->to('/gudang/requests')->with('success', 'Permintaan berhasil disetujui.');
    }

    public function reject($id)
    {
        $alasan = $this->request->getPost('alasan');

        if (!$alasan) {
            return redirect()->back()->with('error', 'Harap isi alasan penolakan!');
        }

        $permintaanModel = new PermintaanModel();

        $permintaanModel->update($id, [
            'status' => 'ditolak',
            'alasan_penolakan' => $alasan
        ]);
        return redirect()->to('/gudang/requests')->with('success', 'Permintaan berhasil ditolak.')->with('alasan_penolakan', $alasan);
    }
}
