<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PembayaranModel;

class PesananController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pesananModel = new PesananModel();
        $pesanan = $pesananModel
            ->where('id_user', session()->get('id_user'))
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('pesanan/index', [
            'title'   => 'Riwayat Pesanan Saya',
            'pesanan' => $pesanan
        ]);
    }

    public function detail($kode)
    {
        $pesananModel    = new PesananModel();
        $detailModel     = new DetailPesananModel();
        $pembayaranModel = new PembayaranModel();

        $pesanan = $pesananModel
            ->where('kode_pesanan', $kode)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/produk')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        $detail = $detailModel
            ->where('id_pesanan', $pesanan['id_pesanan'])
            ->findAll();

        $pembayaran = $pembayaranModel
            ->where('id_pesanan', $pesanan['id_pesanan'])
            ->first();

        $data = [
            'title'      => 'Pesanan ' . $kode,
            'pesanan'    => $pesanan,
            'detail'     => $detail,
            'pembayaran' => $pembayaran
        ];

        return view('pesanan/detail', $data);
    }

    public function invoice($kode)
    {
        $pesananModel = new PesananModel();
        $detailModel  = new DetailPesananModel();

        $pesanan = $pesananModel
            ->where('kode_pesanan', $kode)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/produk');
        }

        $detail = $detailModel
            ->where('id_pesanan', $pesanan['id_pesanan'])
            ->findAll();

        return view('pesanan/invoice', [
            'pesanan' => $pesanan,
            'detail'  => $detail
        ]);
    }

    public function histori(): string
    {
        return view('Histori');
    }
}