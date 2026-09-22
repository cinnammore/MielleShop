<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PembayaranModel;
use App\Models\ProdukModel;

class CheckoutController extends BaseController
{
    protected $keranjangModel;
    protected $produkModel;
    protected $pesananModel;
    protected $detailPesananModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->keranjangModel     = new KeranjangModel();
        $this->produkModel        = new ProdukModel();
        $this->pesananModel       = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->pembayaranModel    = new PembayaranModel();
    }

    public function index()
    {
        $items = $this->keranjangModel->getCartItems();

        if (empty($items)) {
            return redirect()->to('/keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        $data = [
            'title' => 'Checkout | Mielle Accessories',
            'items' => $items,
            'total' => $this->keranjangModel->getTotal()
        ];

        return view('checkout/index', $data);
    }

    public function process()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu sebelum checkout.');
        }

        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        $db = \Config\Database::connect();

        $db->transStart();

        try {
            $items = [];

            foreach ($cart as $idProduk => $qty) {
                $produk = $this->produkModel->find($idProduk);

                if (!$produk) {
                    throw new \Exception('Produk tidak ditemukan.');
                }

                $qty = (int) $qty;

                if ($qty <= 0) {
                    throw new \Exception('Jumlah produk tidak valid.');
                }

                if ($produk['status_stok'] === 'out_of_order') {
                    throw new \Exception($produk['nama_produk'] . ' sedang tidak tersedia.');
                }

                if ($produk['stok'] <= 0) {
                    throw new \Exception($produk['nama_produk'] . ' sudah sold out.');
                }

                if ($qty > $produk['stok']) {
                    throw new \Exception(
                        'Stok ' . $produk['nama_produk'] . ' hanya tersisa ' . $produk['stok'] . '.'
                    );
                }

                $items[] = [
                    'produk'   => $produk,
                    'qty'      => $qty,
                    'subtotal' => $produk['harga'] * $qty
                ];
            }

            $total = 0;

            foreach ($items as $item) {
                $total += $item['subtotal'];
            }

            $kodePesanan = 'ML' . date('YmdHis') . rand(100, 999);

            $idPesanan = $this->pesananModel->insert([
                'id_user'           => session()->get('id_user'),
                'kode_pesanan'      => $kodePesanan,
                'nama_pelanggan'    => $this->request->getPost('nama_pelanggan'),
                'no_hp'             => $this->request->getPost('no_hp'),
                'alamat'            => $this->request->getPost('alamat'),
                'kota'              => $this->request->getPost('kota'),
                'catatan'           => $this->request->getPost('catatan'),
                'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
                'status_pembayaran' => 'menunggu',
                'status_pesanan'    => 'baru',
                'lokasi_terakhir'   => 'Toko Mielle Accessories - Simpang Lima, Semarang',
                'total_harga'       => $total
            ]);

            foreach ($items as $item) {
                $produk = $item['produk'];
                $qty    = $item['qty'];

                $this->detailPesananModel->insert([
                    'id_pesanan'  => $idPesanan,
                    'id_produk'   => $produk['id_produk'],
                    'nama_produk' => $produk['nama_produk'],
                    'harga'       => $produk['harga'],
                    'qty'         => $qty,
                    'subtotal'    => $item['subtotal']
                ]);

                $stokBaru    = $produk['stok'] - $qty;
                $statusStok  = $stokBaru > 0 ? 'tersedia' : 'sold_out';

                $this->produkModel->update(
                    $produk['id_produk'],
                    [
                        'stok'        => $stokBaru,
                        'status_stok' => $statusStok
                    ]
                );
            }

            $this->pembayaranModel->insert([
                'id_pesanan'       => $idPesanan,
                'metode'           => $this->request->getPost('metode_pembayaran'),
                'jumlah'           => $total,
                'status_verifikasi' => 'menunggu'
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan pesanan.');
            }

            session()->remove('cart');

            return redirect()->to('/pesanan/detail/' . $kodePesanan);

        } catch (\Exception $e) {
            $db->transRollback();

            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}