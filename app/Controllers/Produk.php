<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

   public function index()
   {
    $produkModel = new \App\Models\ProdukModel();
    $kategoriModel = new \App\Models\KategoriModel();
    $search = $this->request->getGet('search');
    $selectedKategori = $this->request->getGet('kategori');

    $produkModel
        ->select('produk.*, kategori.nama_kategori')
        ->join(
            'kategori',
            'kategori.id_kategori = produk.id_kategori',
            'left'
        );

    // Search nama produk
    if (!empty($search)) {
        $produkModel->like('produk.nama_produk', $search);
    }

    // Filter kategori
    if (!empty($selectedKategori)) {
        $produkModel->where(
            'produk.id_kategori',
            $selectedKategori
        );
    }
       
    $data = [
        'produk' => $produkModel->findAll(),
        'kategori' => $kategoriModel->findAll(),
        'search' => $search,
        'selectedKategori' => $selectedKategori
    ];

    return view('produk/index', $data);
    }

    public function detail($id)
    {
        $produk = $this->produkModel->find($id);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'  => $produk['nama_produk'],
            'produk' => $produk
        ];

        return view('produk/detail', $data);
    }
}
