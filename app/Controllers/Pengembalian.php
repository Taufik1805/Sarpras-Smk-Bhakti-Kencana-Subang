<?php

namespace App\Controllers;

use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;
use App\Models\ItemModel;

class Pengembalian extends BaseController
{
    protected $pengembalianModel;
    protected $peminjamanModel;
    protected $itemModel;

    public function __construct()
    {
        $this->pengembalianModel = new PengembalianModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengembalian',
            'data' => $this->pengembalianModel
                ->select('pengembalian.*, peminjaman.nama_peminjam')
                ->join(
                    'peminjaman',
                    'peminjaman.id = pengembalian.peminjaman_id'
                )
                ->paginate(10),
            'pager' => $this->pengembalianModel->pager
        ];

        return view('pengembalian/index', $data);
    }

    public function create()
    {
        $pinjam = $this->peminjamanModel
            ->where('status', 'dipinjam')
            ->findAll();

        return view('pengembalian/create', [
            'title' => 'Tambah Pengembalian',
            'pinjam' => $pinjam
        ]);
    }

    public function store()
    {
        $peminjamanId = $this->request->getPost('peminjaman_id');

        $pinjam = $this->peminjamanModel->find($peminjamanId);

        if (!$pinjam) {
            return redirect()->back();
        }

        $kode = 'KMB-' . date('Y') . '-' .
            str_pad(
                $this->pengembalianModel->countAll() + 1,
                4,
                '0',
                STR_PAD_LEFT
            );

        $this->pengembalianModel->save([
            'kode_pengembalian' => $kode,
            'peminjaman_id' => $peminjamanId,
            'tanggal_kembali' =>
                $this->request->getPost('tanggal_kembali'),
            'kondisi_barang' =>
                $this->request->getPost('kondisi_barang'),
            'keterangan' =>
                $this->request->getPost('keterangan')
        ]);

        $this->peminjamanModel->update(
            $peminjamanId,
            [
                'status' => 'dikembalikan',
                'tanggal_kembali' =>
                    $this->request->getPost('tanggal_kembali')
            ]
        );

        $barang = $this->itemModel->find(
            $pinjam['barang_id']
        );

        if ($barang) {

            $this->itemModel->update(
                $barang['id'],
                [
                    'stock' =>
                        $barang['stock']
                        + $pinjam['jumlah']
                ]
            );
        }

        return redirect()->to('/pengembalian')
            ->with(
                'success',
                'Barang berhasil dikembalikan'
            );
    }
}