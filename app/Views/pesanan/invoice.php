<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Invoice <?= esc($pesanan['kode_pesanan']) ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2>
                MIELLE
            </h2>

            <small>
                ACCESSORIES
            </small>
        </div>

        <div class="text-end">
            <strong>
                INVOICE
            </strong>

            <br>

            <?= esc($pesanan['kode_pesanan']) ?>
        </div>
    </div>

    <hr>

    <div class="row mb-4">
        <div class="col-md-6">
            <strong>
                Dikirim kepada:
            </strong>

            <p class="mt-2">
                <?= esc($pesanan['nama_pelanggan']) ?><br>

                <?= esc($pesanan['no_hp']) ?><br>

                <?= esc($pesanan['alamat']) ?><br>

                <?= esc($pesanan['kota']) ?>
            </p>
        </div>

        <div class="col-md-6 text-md-end">
            <strong>
                Tanggal Pesanan
            </strong>

            <p>
                <?= date('d F Y H:i', strtotime($pesanan['created_at'])) ?>
            </p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>
                    Produk
                </th>

                <th class="text-center">
                    Qty
                </th>

                <th class="text-end">
                    Harga
                </th>

                <th class="text-end">
                    Subtotal
                </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($detail as $item): ?>

                <tr>
                    <td>
                        <?= esc($item['nama_produk']) ?>
                    </td>

                    <td class="text-center">
                        <?= $item['qty'] ?>
                    </td>

                    <td class="text-end">
                        Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                    </td>

                    <td class="text-end">
                        Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" class="text-end">
                    TOTAL
                </th>

                <th class="text-end">
                    Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?>
                </th>
            </tr>
        </tfoot>
    </table>

    <div class="mt-4">
        <strong>
            Metode Pembayaran:
        </strong>

        <?= strtoupper($pesanan['metode_pembayaran']) ?>
    </div>

    <div class="mt-5">
        <button onclick="window.print()" class="btn btn-dark">
            Cetak Invoice
        </button>

        <a href="<?= base_url('pesanan/detail/' . $pesanan['kode_pesanan']) ?>" class="btn btn-outline-dark">
            Kembali
        </a>
    </div>
</div>
</body>
</html>
