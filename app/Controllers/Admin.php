<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Admin extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Produk',
            'produk' => $this->produkModel
                ->select('produk.*, kategori.nama_kategori')
                ->join(
                    'kategori',
                    'kategori.id_kategori = produk.id_kategori'
                )
                ->findAll()
        ];

        return view('admin/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Produk',
            'kategori' => $this->kategoriModel->findAll()
        ];

        return view('admin/tambah', $data);
    }

    public function simpan()
    {
        $stok = (int) $this->request->getPost('stok');

        $statusStok = $stok > 0 ? 'tersedia' : 'out_of_order';

        $gambar = $this->uploadGambar();

        $this->produkModel->save([
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $stok,
            'status_stok' => $statusStok,
            'gambar'      => $gambar,
            'deskripsi'   => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/admin')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Produk',
            'produk'   => $this->produkModel->find($id),
            'kategori' => $this->kategoriModel->findAll()
        ];

        return view('admin/edit', $data);
    }

    public function update($id)
    {
        $produkLama = $this->produkModel->find($id);

        if (!$produkLama) {
            return redirect()->to('/admin')
                ->with('error', 'Produk tidak ditemukan.');
        }

        $stok = (int) $this->request->getPost('stok');

        $statusStok = $stok > 0 ? 'tersedia' : 'out_of_order';

        $gambar = $produkLama['gambar'] ?? null;

        $gambarBaru = $this->uploadGambar();

        if ($gambarBaru !== null) {
            $gambar = $gambarBaru;
        }

        $this->produkModel->update($id, [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $stok,
            'status_stok' => $statusStok,
            'gambar'      => $gambar,
            'deskripsi'   => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/admin')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->produkModel->delete($id);

        return redirect()->to('/admin');
    }

    private function uploadGambar()
    {
        $file = $this->request->getFile('gambar');

        if (!$file || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if (!$file->isValid()) {
            return null;
        }

        $jenisYangDiizinkan = [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!in_array($file->getMimeType(), $jenisYangDiizinkan)) {
            return null;
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            return null;
        }

        $namaFile = $file->getRandomName();

        $file->move(
            FCPATH . 'assets/img',
            $namaFile
        );

        return $namaFile;
    }
}
