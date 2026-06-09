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

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->itemModel;

        if ($keyword) {
            $builder = $builder
                ->groupStart()
                    ->like('kode_barang', $keyword)
                    ->orLike('name', $keyword)
                    ->orLike('category', $keyword)
                    ->orLike('location', $keyword)
                    ->orLike('jenis_aset', $keyword)
                ->groupEnd();
        }

        $items = $builder->paginate(5);
        $pager = $this->itemModel->pager;

        $total = $this->itemModel->countAll();

        $baik   = (new ItemModel())->where('item_condition', 'baik')->countAllResults();
        $rusak  = (new ItemModel())->where('item_condition', 'rusak')->countAllResults();
        $hilang = (new ItemModel())->where('item_condition', 'hilang')->countAllResults();

        return view('items/index', [
            'title'  => 'Data Barang',
            'items'  => $items,
            'pager'  => $pager,
            'total'  => $total,
            'baik'   => $baik,
            'rusak'  => $rusak,
            'hilang' => $hilang
        ]);
    }

    public function create()
    {
        return view('items/create', [
            'title' => 'Tambah Barang'
        ]);
    }

    public function store()
    {
        $file = $this->request->getFile('image');
        $imageName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $ext = strtolower($file->getExtension());

            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()
                    ->with('error', 'Format gambar harus JPG atau PNG');
            }

            if ($file->getSize() > 2048000) {
                return redirect()->back()
                    ->with('error', 'Ukuran gambar maksimal 2MB');
            }

            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
        }

        $this->itemModel->save([
            'kode_barang'    => $this->request->getPost('kode_barang'),
            'jenis_aset'     => $this->request->getPost('jenis_aset'),
            'name'           => $this->request->getPost('name'),
            'category'       => $this->request->getPost('category'),
            'stock'          => $this->request->getPost('stock'),
            'satuan'         => $this->request->getPost('satuan'),
            'item_condition' => $this->request->getPost('condition'),
            'location'       => $this->request->getPost('location'),
            'keterangan'     => $this->request->getPost('keterangan'),
            'image'          => $imageName,
        ]);

        return redirect()->to('/items')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Data tidak ditemukan'
            );
        }

        return view('items/edit', [
            'title' => 'Edit Barang',
            'item'  => $item
        ]);
    }

    public function update($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan');
        }

        $file = $this->request->getFile('image');
        $imageName = $item['image'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $ext = strtolower($file->getExtension());

            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()
                    ->with('error', 'Format gambar harus JPG atau PNG');
            }

            if ($file->getSize() > 2048000) {
                return redirect()->back()
                    ->with('error', 'Ukuran gambar maksimal 2MB');
            }

            if (
                $item['image'] &&
                file_exists(FCPATH . 'uploads/' . $item['image'])
            ) {
                unlink(FCPATH . 'uploads/' . $item['image']);
            }

            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
        }

        $this->itemModel->update($id, [
            'kode_barang'    => $this->request->getPost('kode_barang'),
            'jenis_aset'     => $this->request->getPost('jenis_aset'),
            'name'           => $this->request->getPost('name'),
            'category'       => $this->request->getPost('category'),
            'stock'          => $this->request->getPost('stock'),
            'satuan'         => $this->request->getPost('satuan'),
            'item_condition' => $this->request->getPost('condition'),
            'location'       => $this->request->getPost('location'),
            'keterangan'     => $this->request->getPost('keterangan'),
            'image'          => $imageName,
        ]);

        return redirect()->to('/items')
            ->with('success', 'Data berhasil diupdate');
    }

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

            if (
                $item['image'] &&
                file_exists(FCPATH . 'uploads/' . $item['image'])
            ) {
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