<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password');

        $user = $userModel->where('name', $name)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'name' => $user['name'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
