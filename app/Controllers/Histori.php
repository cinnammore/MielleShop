<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;

class Histori extends BaseController
{
    protected $pesananModel;
    protected $detailPesananModel;

    public function __construct()
    {
        $this->pesananModel       = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $idUser = session()->get('id_user');

        $pesanan = $this->pesananModel
            ->where('id_user', $idUser)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'title'   => 'Histori Pesanan',
            'pesanan' => $pesanan
        ];

        return view('pesanan/index', $data);
    }

    public function detail($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $idUser = session()->get('id_user');

        $pesanan = $this->pesananModel
            ->where('id_pesanan', $id)
            ->where('id_user', $idUser)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/pesanan')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        $detail = $this->detailPesananModel
            ->select('detail_pesanan.*, produk.nama_produk, produk.gambar')
            ->join(
                'produk',
                'produk.id_produk = detail_pesanan.id_produk'
            )
            ->where('detail_pesanan.id_pesanan', $id)
            ->findAll();

        $data = [
            'title'   => 'Detail Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $detail
        ];

        return view('pesanan/detail', $data);
    }
}