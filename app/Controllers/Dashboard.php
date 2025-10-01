<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $role = session()->get('role');
        if ($role === 'gudang') {
            return view('dashboard/gudang');
        } elseif ($role === 'dapur') {
            return view('dashboard/dapur');
        }
        return redirect()->to('/login');
    }
}
