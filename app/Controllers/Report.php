<?php

namespace App\Controllers;

use App\Models\ReportModel;
use App\Models\ItemModel;
use Dompdf\Dompdf;

class Report extends BaseController
{
    protected $reportModel;
    protected $itemModel;

    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->itemModel   = new ItemModel();
    }

    // =========================
    // 📋 LIST + FILTER
    // =========================
    public function index()
    {
        $from = $this->request->getGet('from');
        $to   = $this->request->getGet('to');

        $builder = $this->reportModel
            ->select('reports.*, items.name')
            ->join('items', 'items.id = reports.item_id', 'left');

        if ($from && $to) {
            $builder->where('DATE(reports.created_at) >=', $from);
            $builder->where('DATE(reports.created_at) <=', $to);
        }

        $reports = $builder->findAll();

        return view('reports/index', [
            'title'   => 'Data Laporan',
            'reports' => $reports,
            'from'    => $from,
            'to'      => $to
        ]);
    }

    // =========================
    // ➕ FORM TAMBAH LAPORAN
    // =========================
    public function create()
    {
        $items = $this->itemModel->findAll();

        return view('reports/create', [
            'title' => 'Tambah Laporan',
            'items' => $items
        ]);
    }

    // =========================
    // 💾 SIMPAN LAPORAN
    // =========================
    public function store()
    {
        $this->reportModel->save([
            'item_id'     => $this->request->getPost('item_id'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/reports')->with('success', 'Laporan berhasil ditambahkan');
    }

    // =========================
    // 🧾 EXPORT PDF
    // =========================
    public function exportPdf()
    {
        $from = $this->request->getGet('from');
        $to   = $this->request->getGet('to');

        $builder = $this->reportModel
            ->select('reports.*, items.name')
            ->join('items', 'items.id = reports.item_id', 'left');

        if ($from && $to) {
            $builder->where('DATE(reports.created_at) >=', $from);
            $builder->where('DATE(reports.created_at) <=', $to);
        }

        $reports = $builder->findAll();

        $html = view('reports/pdf', [
            'reports' => $reports,
            'from'    => $from,
            'to'      => $to
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('laporan.pdf', ['Attachment' => false]);
    }
}