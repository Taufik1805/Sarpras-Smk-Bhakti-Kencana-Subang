<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class Dashboard extends BaseController
{
    protected $itemModel;
    protected $peminjamanModel;
    protected $pengembalianModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->pengembalianModel = new PengembalianModel();
    }

    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/dashboard-guru');
        }

        $total = $this->itemModel->countAll();

        $sarana = $this->itemModel
            ->where('jenis_aset', 'Sarana')
            ->countAllResults();

        $prasarana = $this->itemModel
            ->where('jenis_aset', 'Prasarana')
            ->countAllResults();

        $baik = $this->itemModel
            ->where('item_condition', 'baik')
            ->countAllResults();

        $rusak = $this->itemModel
            ->where('item_condition', 'rusak')
            ->countAllResults();

        $hilang = $this->itemModel
            ->where('item_condition', 'hilang')
            ->countAllResults();

        $habis = $this->itemModel
            ->where('item_condition', 'habis')
            ->countAllResults();

        $kategoriData = $this->itemModel
            ->select('category, COUNT(*) as total')
            ->groupBy('category')
            ->findAll();

        $lokasiData = $this->itemModel
            ->select('location, COUNT(*) as total')
            ->groupBy('location')
            ->findAll();

        $barangRusak = $this->itemModel
            ->where('item_condition', 'rusak')
            ->findAll();

        return view('dashboard', [
            'title' => 'Dashboard Admin',

            'total' => $total,
            'sarana' => $sarana,
            'prasarana' => $prasarana,

            'baik' => $baik,
            'rusak' => $rusak,
            'hilang' => $hilang,
            'habis' => $habis,

            'kategoriData' => $kategoriData,
            'lokasiData' => $lokasiData,
            'barangRusak' => $barangRusak
        ]);
    }

    public function guru()
    {
        if (session()->get('role') != 'guru') {
            return redirect()->to('/dashboard');
        }

        $totalBarang = $this->itemModel->countAll();

        $totalPeminjaman = $this->peminjamanModel->countAll();

        $totalPengembalian = $this->pengembalianModel->countAll();

        return view('dashboard_guru', [
            'title' => 'Dashboard Guru',
            'totalBarang' => $totalBarang,
            'totalPeminjaman' => $totalPeminjaman,
            'totalPengembalian' => $totalPengembalian
        ]);
    }
}