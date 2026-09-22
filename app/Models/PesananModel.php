<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $allowedFields = [
        'id_user',
        'kode_pesanan',
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'kota',
        'catatan',
        'metode_pembayaran',
        'status_pembayaran',
        'status_pesanan',
        'lokasi_terakhir',
        'total_harga'
    ];

    protected $useTimestamps = false;
}