<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $allowedFields = [
        'id_pesanan',
        'metode',
        'nama_bank',
        'nomor_rekening',
        'jumlah',
        'bukti_pembayaran',
        'status_verifikasi'
    ];

    protected $useTimestamps = false;
}