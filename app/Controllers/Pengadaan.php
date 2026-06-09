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

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->model;

        if ($keyword) {
            $builder = $builder
                ->groupStart()
                ->like('kode_pengadaan', $keyword)
                ->orLike('nama_barang', $keyword)
                ->orLike('jenis_aset', $keyword)
                ->orLike('pemasok', $keyword)
                ->groupEnd();
        }

        $data['data'] = $builder->paginate(5);
        $data['pager'] = $this->model->pager;

        $data['totalPengadaan'] = $this->model->countAll();

        $data['proses'] = $this->model
            ->where('status', 'proses')
            ->countAllResults();

        $data['selesai'] = $this->model
            ->where('status', 'selesai')
            ->countAllResults();

        $data['dibatalkan'] = $this->model
            ->where('status', 'dibatalkan')
            ->countAllResults();

        return view('pengadaan/index', $data);
    }

    public function create()
    {
        $last = $this->model
            ->orderBy('id', 'DESC')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last['kode_pengadaan'], -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodePengadaan =
            'PGD-' .
            date('Y') .
            '-' .
            str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return view('pengadaan/create', [
            'kodePengadaan' => $kodePengadaan
        ]);
    }

    public function store()
    {
        $jumlah = (int) $this->request->getPost('jumlah');
        $hargaSatuan = (int) $this->request->getPost('harga_satuan');

        $totalHarga = $jumlah * $hargaSatuan;

        $this->model->save([
            'kode_pengadaan' => $this->request->getPost('kode_pengadaan'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jenis_aset' => $this->request->getPost('jenis_aset'),
            'jumlah' => $jumlah,
            'harga_satuan' => $hargaSatuan,
            'tanggal_pengadaan' => $this->request->getPost('tanggal_pengadaan'),
            'pemasok' => $this->request->getPost('pemasok'),
            'total_harga' => $totalHarga,
            'sumber_dana' => $this->request->getPost('sumber_dana'),
            'lokasi_penempatan' => $this->request->getPost('lokasi_penempatan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => 'proses'
        ]);

        return redirect()->to('/pengadaan')
            ->with('success', 'Data pengadaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            return redirect()->to('/pengadaan');
        }

        return view('pengadaan/edit', [
            'item' => $item
        ]);
    }

    public function update($id)
    {
        $jumlah = (int) $this->request->getPost('jumlah');
        $hargaSatuan = (int) $this->request->getPost('harga_satuan');

        $totalHarga = $jumlah * $hargaSatuan;

        $this->model->update($id, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jenis_aset' => $this->request->getPost('jenis_aset'),
            'jumlah' => $jumlah,
            'harga_satuan' => $hargaSatuan,
            'tanggal_pengadaan' => $this->request->getPost('tanggal_pengadaan'),
            'pemasok' => $this->request->getPost('pemasok'),
            'total_harga' => $totalHarga,
            'sumber_dana' => $this->request->getPost('sumber_dana'),
            'lokasi_penempatan' => $this->request->getPost('lokasi_penempatan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/pengadaan')
            ->with('success', 'Data pengadaan berhasil diupdate');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/pengadaan')
            ->with('success', 'Data pengadaan berhasil dihapus');
    }
}