<?= $this->include('layout/header') ?>

<section class="order-history-page">
    <div class="container">
        <div class="order-history-header">
            <span class="section-label">MY ORDERS</span>

            <h1>
                Histori <em>Pesanan</em>
            </h1>

            <p>
                Lihat semua pesanan yang pernah kamu lakukan di Mielle.
            </p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (empty($pesanan)): ?>

            <div class="empty-order">
                <div class="empty-order-icon">
                    ♡
                </div>

                <h2>Belum Ada Pesanan</h2>

                <p>
                    Kamu belum memiliki histori pesanan.
                </p>

                <a href="<?= base_url('produk') ?>">
                    Mulai Belanja →
                </a>
            </div>

        <?php else: ?>

            <div class="order-list">
                <?php foreach ($pesanan as $p): ?>

                    <div class="order-card">
                        <div class="order-card-top">
                            <div>
                                <span class="order-label">
                                    NOMOR PESANAN
                                </span>

                                <h3>
                                    #<?= esc($p['id_pesanan']) ?>
                                </h3>

                                <small>
                                    <?= date('d M Y, H:i', strtotime($p['created_at'])) ?>
                                </small>
                            </div>

                            <div class="order-status">
                                <?php
                                $status = $p['status_pesanan'] ?? 'baru';

                                $statusText = [
                                    'baru'       => 'Pesanan Baru',
                                    'diproses'   => 'Sedang Diproses',
                                    'dikirim'    => 'Sedang Dikirim',
                                    'selesai'    => 'Pesanan Berhasil',
                                    'dibatalkan' => 'Dibatalkan'
                                ];

                                echo $statusText[$status] ?? ucfirst($status);
                                ?>
                            </div>
                        </div>

                        <div class="order-card-bottom">
                            <div>
                                <span>Total Pesanan</span>

                                <strong>
                                    Rp <?= number_format(
                                        $p['total_harga'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                                </strong>
                            </div>

                            <a href="<?= base_url('pesanan/detail/' . $p['id_pesanan']) ?>" class="order-detail-button">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>
</section>

<?= $this->include('layout/footer') ?>
