<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\ProdukModel;

class KeranjangController extends BaseController
{
    protected $keranjangModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Keranjang | Mielle Accessories',
            'items' => $this->keranjangModel->getCartItems(),
            'total' => $this->keranjangModel->getTotal()
        ];

        return view('keranjang/index', $data);
    }

    public function tambah($id)
    {
        $produkModel = new ProdukModel();

        $produk = $produkModel->find($id);

        if (!$produk) {
            return redirect()->to('/produk')
                ->with('error', 'Produk tidak ditemukan.');
        }

        if ($produk['stok'] <= 0) {
            return redirect()->back()
                ->with('error', 'Stok produk habis.');
        }

        $session = session();

        $cart = $session->get('cart') ?? [];

        $qtySekarang = $cart[$id] ?? 0;

        if (($qtySekarang + 1) > $produk['stok']) {
            return redirect()->back()
                ->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$id] = $qtySekarang + 1;

        $session->set('cart', $cart);

        return redirect()->back()
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update()
    {
        $id = $this->request->getPost('id_produk');
        $qty = (int) $this->request->getPost('qty');

        if ($qty < 1) {
            return $this->hapus($id);
        }

        $produkModel = new ProdukModel();

        $produk = $produkModel->find($id);

        if (!$produk) {
            return redirect()->to('/keranjang')
                ->with('error', 'Produk tidak ditemukan.');
        }

        if ($qty > $produk['stok']) {
            return redirect()->to('/keranjang')
                ->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $session = session();

        $cart = $session->get('cart') ?? [];

        $cart[$id] = $qty;

        $session->set('cart', $cart);

        return redirect()->to('/keranjang')
            ->with('success', 'Jumlah produk diperbarui.');
    }

    public function hapus($id)
    {
        $session = session();

        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return redirect()->to('/keranjang')
            ->with('success', 'Produk dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        session()->remove('cart');

        return redirect()->to('/keranjang')
            ->with('success', 'Keranjang dikosongkan.');
    }
}