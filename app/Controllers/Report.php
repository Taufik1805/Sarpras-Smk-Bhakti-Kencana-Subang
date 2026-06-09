<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\PengadaanModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use Dompdf\Dompdf;

class Report extends BaseController
{
    protected $itemModel;
    protected $pengadaanModel;
    protected $peminjamanModel;
    protected $pengembalianModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->pengadaanModel = new PengadaanModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->pengembalianModel = new PengembalianModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laporan',

            'barang' => $this->itemModel->findAll(),

            'pengadaan' => $this->pengadaanModel->findAll(),

            'peminjaman' => $this->peminjamanModel->findAll(),

            'pengembalian' => $this->pengembalianModel->findAll()
        ];

        return view('reports/index', $data);
    }

    public function exportPdf()
    {
        $data = [
            'barang' => $this->itemModel->findAll(),

            'pengadaan' => $this->pengadaanModel->findAll(),

            'peminjaman' => $this->peminjamanModel->findAll(),

            'pengembalian' => $this->pengembalianModel->findAll()
        ];

        $html = view('reports/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream(
            'laporan_sarpras.pdf',
            [
                'Attachment' => true
            ]
        );
    }
}