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

    // =========================
    // 🔐 FORM LOGIN
    // =========================
    public function login()
    {
        // kalau sudah login → langsung ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    // =========================
    // 🔐 PROSES LOGIN
    // =========================
    public function process()
    {
        $email    = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 🔥 VALIDASI INPUT
        if (!$email || !$password) {
            return redirect()->back()->with('error', 'Email dan password wajib diisi');
        }

        // 🔍 CARI USER
        $user = $this->userModel
            ->where('email', $email)
            ->first();

        // ❌ USER TIDAK ADA
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        // ❌ PASSWORD SALAH
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        // ✅ LOGIN BERHASIL
        session()->set([
            'user_id'   => $user['id'],
            'name'      => $user['name'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    // =========================
    // 🚪 LOGOUT
    // =========================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // =========================
    // 🔑 GENERATE PASSWORD HASH
    // =========================
    public function generate()
    {
        echo password_hash('123456', PASSWORD_DEFAULT);
    }
}