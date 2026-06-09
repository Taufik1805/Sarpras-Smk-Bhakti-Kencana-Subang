<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('users/index', [
            'title' => 'Pengguna',
            'users' => $this->userModel->findAll()
        ]);
    }

    public function create()
    {
        return view('users/create', [
            'title' => 'Tambah Pengguna'
        ]);
    }

    public function store()
    {
        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role' => $this->request->getPost('role')
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        return view('users/edit', [
            'title' => 'Edit Pengguna',
            'user' => $this->userModel->find($id)
        ]);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        if ($this->request->getPost('password')) {

            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/users');
    }
}