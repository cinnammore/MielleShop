<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    public function getCart()
    {
        $session = session();

        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return [];
        }

        return $this->whereIn('id_produk', array_keys($cart))
                    ->findAll();
    }

    public function getCartItems()
    {
        $session = session();

        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return [];
        }

        $products = $this->whereIn(
            'id_produk',
            array_keys($cart)
        )->findAll();

        $items = [];

        foreach ($products as $product) {

            $id = $product['id_produk'];

            $qty = $cart[$id];

            $items[] = [
                'id_produk'   => $id,
                'nama_produk' => $product['nama_produk'],
                'harga'       => $product['harga'],
                'stok'        => $product['stok'],
                'gambar'      => $product['gambar'],
                'deskripsi'   => $product['deskripsi'],
                'qty'         => $qty,
                'subtotal'    => $product['harga'] * $qty
            ];
        }

        return $items;
    }

    public function getTotal()
    {
        $items = $this->getCartItems();

        $total = 0;

        foreach ($items as $item) {
            $total += $item['subtotal'];
        }

        return $total;
    }

    public function getCount()
    {
        $session = session();

        $cart = $session->get('cart') ?? [];

        return array_sum($cart);
    }
}