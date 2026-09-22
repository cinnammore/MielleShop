<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PembayaranModel;

class AdminPesanan extends BaseController
{
    protected $pesananModel;
    protected $detailPesananModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pesananModel       = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->pembayaranModel    = new PembayaranModel();
    }

    public function index()
    {
        $pesanan = $this->pesananModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'title'   => 'Pesanan - Admin',
            'pesanan' => $pesanan
        ];

        return view('admin/pesanan/index', $data);
    }

    public function detail($kode)
    {
        $pesanan = $this->pesananModel
            ->where('kode_pesanan', $kode)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        $detail = $this->detailPesananModel
            ->where('id_pesanan', $pesanan['id_pesanan'])
            ->findAll();

        $pembayaran = $this->pembayaranModel
            ->where('id_pesanan', $pesanan['id_pesanan'])
            ->first();

        $data = [
            'title'      => 'Detail Pesanan - Admin',
            'pesanan'    => $pesanan,
            'detail'     => $detail,
            'pembayaran' => $pembayaran
        ];

        return view('admin/pesanan/detail', $data);
    }

    public function updateStatus($kode)
    {
        $pesanan = $this->pesananModel
            ->where('kode_pesanan', $kode)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        $status = $this->request->getPost('status_pesanan');

        $statusYangDiizinkan = [
            'baru',
            'diproses',
            'dikirim',
            'selesai',
            'dibatalkan'
        ];

        if (!in_array($status, $statusYangDiizinkan)) {
            return redirect()->back()
                ->with('error', 'Status pesanan tidak valid.');
        }

        $this->pesananModel->update(
            $pesanan['id_pesanan'],
            ['status_pesanan' => $status]
        );

        return redirect()->back()
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function updatePembayaran($kode)
    {
        $pesanan = $this->pesananModel
            ->where('kode_pesanan', $kode)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        $status = $this->request->getPost('status_pembayaran');

        $statusYangDiizinkan = [
            'menunggu',
            'dibayar',
            'dikonfirmasi'
        ];

        if (!in_array($status, $statusYangDiizinkan)) {
            return redirect()->back()
                ->with('error', 'Status pembayaran tidak valid.');
        }

        $this->pesananModel->update(
            $pesanan['id_pesanan'],
            ['status_pembayaran' => $status]
        );

        if ($status === 'dikonfirmasi') {
            $this->pesananModel->update(
                $pesanan['id_pesanan'],
                [
                    'status_pembayaran' => 'dikonfirmasi',
                    'status_pesanan'    => 'diproses'
                ]
            );
        }

        return redirect()->back()
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function updatePengiriman($kode)
    {
        $pesanan = $this->pesananModel
            ->where('kode_pesanan', $kode)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        $lokasi = $this->request->getPost('lokasi_terakhir');

        $this->pesananModel->update(
            $pesanan['id_pesanan'],
            ['lokasi_terakhir' => $lokasi]
        );

        return redirect()->back()
            ->with('success', 'Lokasi/Status paket berhasil diperbarui.');
    }
}