<?php

namespace App\Controllers;

use App\Models\PengadaanModel;

class Pengadaan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PengadaanModel();
    }

    // =========================
    // LIST + SEARCH
    // =========================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->model;

        if ($keyword) {
            $builder = $builder->like('item_name', $keyword);
        }

        $data['data'] = $builder->paginate(5);
        $data['pager'] = $this->model->pager;

        return view('pengadaan/index', $data);
    }

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        return view('pengadaan/create');
    }

    // =========================
    // SIMPAN
    // =========================
    public function store()
    {
        $this->model->save([
            'item_name' => $this->request->getPost('item_name'),
            'date' => $this->request->getPost('date'),
            'supplier' => $this->request->getPost('supplier'),
            'total' => $this->request->getPost('total'),
            'status' => 'proses'
        ]);

        return redirect()->to('/pengadaan')->with('success','Data berhasil ditambahkan');
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $data['item'] = $this->model->find($id);

        return view('pengadaan/edit', $data);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $this->model->update($id, [
            'item_name' => $this->request->getPost('item_name'),
            'date' => $this->request->getPost('date'),
            'supplier' => $this->request->getPost('supplier'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/pengadaan')->with('success','Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/pengadaan')->with('success','Data dihapus');
    }
}