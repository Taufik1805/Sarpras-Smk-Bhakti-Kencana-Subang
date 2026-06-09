<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('logged_in')) {

            if (session()->get('role') == 'admin') {
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/dashboard-guru');
        }

        return view('auth/login');
    }

    public function process()
    {
        $email    = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$email || !$password) {
            return redirect()->back()
                ->with('error', 'Email dan password wajib diisi');
        }

        $user = $this->userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Email tidak ditemukan');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->with('error', 'Password salah');
        }

        session()->set([
            'user_id'   => $user['id'],
            'name'      => $user['name'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        if ($user['role'] == 'admin') {
            return redirect()->to('/dashboard');
        }

        if ($user['role'] == 'guru') {
            return redirect()->to('/dashboard-guru');
        }

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    public function generate()
    {
        echo password_hash('123456', PASSWORD_DEFAULT);
    }
}