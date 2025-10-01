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

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['user_id'],
                'username' => $user['username'],
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
