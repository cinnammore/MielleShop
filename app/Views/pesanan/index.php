<?= $this->include('layout/header') ?>

<section class="admin-page">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-label">MY ORDERS</span>
                <h1>Riwayat <em>Pesanan</em></h1>
                <p>Lihat daftar pesanan Anda di Mielle Accessories.</p>
            </div>
            <a href="<?= base_url('produk') ?>" class="admin-detail-button">&larr; Belanja Lagi</a>
        </div>

        <div class="admin-card">
            <div class="table-responsive">
                <table class="mielle-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($pesanan)): ?>
                        <?php $no = 1; foreach ($pesanan as $p): ?>
                        <tr>
                            <td class="table-number"><?= $no++ ?></td>
                            <td><strong class="order-code"><?= esc($p['kode_pesanan']) ?></strong></td>
                            <td><span class="order-date"><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></span></td>
                            <td class="admin-price">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="payment-badge"><?= strtoupper(esc($p['status_pembayaran'])) ?></span>
                            </td>
                            <td>
                                <?php
                                $statusClass = 'status-baru';
                                if ($p['status_pesanan'] === 'diproses') $statusClass = 'status-proses';
                                if ($p['status_pesanan'] === 'dikirim') $statusClass = 'status-kirim';
                                if ($p['status_pesanan'] === 'selesai') $statusClass = 'status-selesai';
                                if ($p['status_pesanan'] === 'dibatalkan') $statusClass = 'status-batal';
                                ?>
                                <span class="order-status <?= $statusClass ?>"><?= ucfirst(esc($p['status_pesanan'])) ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('pesanan/detail/' . $p['kode_pesanan']) ?>" class="admin-detail-button">Detail &rarr;</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">
                                <div class="admin-empty">
                                    <div>📦</div>
                                    <h3>Belum ada pesanan</h3>
                                    <p>Anda belum pernah melakukan pesanan.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->include('layout/footer') ?>
