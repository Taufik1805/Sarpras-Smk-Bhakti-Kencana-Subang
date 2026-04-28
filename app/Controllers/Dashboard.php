<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Dashboard extends BaseController
{
    protected $itemModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        // TOTAL
        $total = $this->itemModel->countAll();

        // KONDISI
        $baik   = $this->itemModel->where('item_condition', 'baik')->countAllResults();
        $rusak  = $this->itemModel->where('item_condition', 'rusak')->countAllResults();
        $hilang = $this->itemModel->where('item_condition', 'hilang')->countAllResults();
        $habis  = $this->itemModel->where('item_condition', 'habis')->countAllResults();

        // 🔥 KATEGORI OTOMATIS (INI YANG KURANG TADI)
        $kategoriData = $this->itemModel
            ->select('category, COUNT(*) as total')
            ->groupBy('category')
            ->findAll();

        return view('dashboard', [
            'title' => 'Dashboard',

            'total' => $total,
            'baik' => $baik,
            'rusak' => $rusak,
            'hilang' => $hilang,
            'habis' => $habis,

            // 🔥 WAJIB ADA INI
            'kategoriData' => $kategoriData
        ]);
    }
}