<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Item extends BaseController
{
    protected $itemModel;

    public function __construct()
    {            
        $this->itemModel = new ItemModel();
    }

    // =========================
    // 📋 DATA + SEARCH + PAGINATION + STATUS
    // =========================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->itemModel;

        if ($keyword) {
            $builder = $builder
                ->groupStart()
                    ->like('name', $keyword)
                    ->orLike('category', $keyword)
                    ->orLike('location', $keyword)
                ->groupEnd();
        }

        // 🔥 PAGINATION (5 DATA PER HALAMAN)
        $items = $builder->paginate(5);
        $pager = $this->itemModel->pager;

        // 🔥 TOTAL
        $total = $this->itemModel->countAll();

        // 🔥 STATUS (PAKAI MODEL BARU BIAR QUERY TIDAK TABRAK)
        $baik   = (new ItemModel())->where('item_condition','baik')->countAllResults();
        $rusak  = (new ItemModel())->where('item_condition','rusak')->countAllResults();
        $hilang = (new ItemModel())->where('item_condition','hilang')->countAllResults();

        return view('items/index', [
            'title' => 'Data Barang',
            'items' => $items,
            'pager' => $pager,
            'total' => $total,
            'baik' => $baik,
            'rusak' => $rusak,
            'hilang' => $hilang
        ]);
    }

    // =========================
    // ➕ FORM TAMBAH
    // =========================
    public function create()
    {
        return view('items/create', [
            'title' => 'Tambah Barang'
        ]);
    }

    // =========================
    // 💾 SIMPAN DATA
    // =========================
    public function store()
    {
        $file = $this->request->getFile('image');
        $imageName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $ext = strtolower($file->getExtension());
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()->with('error', 'Format gambar harus JPG / PNG');
            }

            if ($file->getSize() > 2048000) {
                return redirect()->back()->with('error', 'Ukuran maksimal 2MB');
            }

            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
        }

        $this->itemModel->save([
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'stock' => $this->request->getPost('stock'),
            'item_condition' => $this->request->getPost('condition'),
            'location' => $this->request->getPost('location'),
            'image' => $imageName,
        ]);

        return redirect()->to('/items')->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // ✏️ EDIT
    // =========================
    public function edit($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        return view('items/edit', [
            'title' => 'Edit Barang',
            'item' => $item
        ]);
    }

    // =========================
    // 🔄 UPDATE
    // =========================
    public function update($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $file = $this->request->getFile('image');
        $imageName = $item['image'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $ext = strtolower($file->getExtension());
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()->with('error', 'Format gambar harus JPG / PNG');
            }

            if ($file->getSize() > 2048000) {
                return redirect()->back()->with('error', 'Ukuran maksimal 2MB');
            }

            if ($item['image'] && file_exists(FCPATH . 'uploads/' . $item['image'])) {
                unlink(FCPATH . 'uploads/' . $item['image']);
            }

            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
        }

        $this->itemModel->update($id, [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'stock' => $this->request->getPost('stock'),
            'item_condition' => $this->request->getPost('condition'),
            'location' => $this->request->getPost('location'),
            'image' => $imageName,
        ]);

        return redirect()->to('/items')->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // 🗑️ DELETE AJAX
    // =========================
    public function delete($id)
    {
        if ($this->request->isAJAX()) {

            $item = $this->itemModel->find($id);

            if (!$item) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            if ($item['image'] && file_exists(FCPATH . 'uploads/' . $item['image'])) {
                unlink(FCPATH . 'uploads/' . $item['image']);
            }

            $this->itemModel->delete($id);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        }

        return redirect()->to('/items');
    }
}