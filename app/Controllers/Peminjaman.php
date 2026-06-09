<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\ItemModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $itemModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Peminjaman',
            'data' => $this->peminjamanModel
                ->select('peminjaman.*, items.name')
                ->join('items', 'items.id = peminjaman.barang_id')
                ->paginate(10),
            'pager' => $this->peminjamanModel->pager
        ];

        return view('peminjaman/index', $data);
    }

    public function create()
    {
        return view('peminjaman/create', [
            'title' => 'Tambah Peminjaman',
            'items' => $this->itemModel->findAll()
        ]);
    }

    public function store()
    {
        $barang = $this->itemModel->find(
            $this->request->getPost('barang_id')
        );

        if (!$barang) {
            return redirect()->back()
                ->with('error', 'Barang tidak ditemukan');
        }

        $jumlah = (int)$this->request->getPost('jumlah');

        if ($jumlah > $barang['stock']) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi');
        }

        $kode = 'PJM-' . date('Y') . '-' . str_pad(
            $this->peminjamanModel->countAll() + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        $this->peminjamanModel->save([
            'kode_peminjaman' => $kode,
            'nama_peminjam' => $this->request->getPost('nama_peminjam'),
            'barang_id' => $this->request->getPost('barang_id'),
            'jumlah' => $jumlah,
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'status' => 'dipinjam',
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        // Kurangi stok barang
        $this->itemModel->update($barang['id'], [
            'stock' => $barang['stock'] - $jumlah
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = $this->peminjamanModel->find($id);

        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('peminjaman/edit', [
            'title' => 'Edit Peminjaman',
            'item' => $item
        ]);
    }

    public function update($id)
    {
        $dataLama = $this->peminjamanModel->find($id);

        if (!$dataLama) {
            return redirect()->back();
        }

        $statusBaru = $this->request->getPost('status');

        if (
            $dataLama['status'] == 'dipinjam' &&
            $statusBaru == 'dikembalikan'
        ) {

            $barang = $this->itemModel->find(
                $dataLama['barang_id']
            );

            if ($barang) {

                $this->itemModel->update(
                    $barang['id'],
                    [
                        'stock' => $barang['stock']
                            + $dataLama['jumlah']
                    ]
                );
            }
        }

        $this->peminjamanModel->update($id, [
            'status' => $statusBaru,
            'tanggal_kembali' =>
                $this->request->getPost('tanggal_kembali')
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $data = $this->peminjamanModel->find($id);

        if ($data) {

            if ($data['status'] == 'dipinjam') {

                $barang = $this->itemModel->find(
                    $data['barang_id']
                );

                if ($barang) {

                    $this->itemModel->update(
                        $barang['id'],
                        [
                            'stock' => $barang['stock']
                                + $data['jumlah']
                        ]
                    );
                }
            }

            $this->peminjamanModel->delete($id);
        }

        return redirect()->to('/peminjaman')
            ->with('success', 'Data berhasil dihapus');
    }
}