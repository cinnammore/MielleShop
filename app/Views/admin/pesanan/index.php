<?= $this->include('layout/header') ?>

<section class="admin-page">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-label">
                    MIELLE ADMIN
                </span>
                <h1>
                    Data <em>Pesanan</em>
                </h1>
                <p>
                    Kelola pesanan pelanggan Mielle Accessories.
                </p>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mielle-alert success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mielle-alert error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <span class="section-label">
                        ORDER MANAGEMENT
                    </span>

                    <h2>
                        Daftar <em>Pesanan</em>
                    </h2>
                </div>

                <span class="product-total">
                    <?= count($pesanan) ?> Pesanan
                </span>
            </div>

            <div class="table-responsive">
                <table class="mielle-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($pesanan)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($pesanan as $p): ?>

                            <tr>
                                <td class="table-number">
                                    <?= $no++ ?>
                                </td>

                                <td>
                                    <strong class="order-code">
                                        <?= esc($p['kode_pesanan']) ?>
                                    </strong>
                                </td>

                                <td>
                                    <strong class="customer-name">
                                        <?= esc($p['nama_pelanggan']) ?>
                                    </strong>
                                    <small class="customer-phone">
                                        <?= esc($p['no_hp']) ?>
                                    </small>
                                </td>

                                <td class="admin-price">
                                    Rp <?= number_format(
                                        $p['total_harga'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                                </td>

                                <td>
                                    <span class="payment-badge">
                                        <?= strtoupper(
                                            esc($p['status_pembayaran'])
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <?php
                                    $statusClass = 'status-baru';

                                    if ($p['status_pesanan'] === 'diproses') {
                                        $statusClass = 'status-proses';
                                    }

                                    if ($p['status_pesanan'] === 'dikirim') {
                                        $statusClass = 'status-kirim';
                                    }

                                    if ($p['status_pesanan'] === 'selesai') {
                                        $statusClass = 'status-selesai';
                                    }

                                    if ($p['status_pesanan'] === 'dibatalkan') {
                                        $statusClass = 'status-batal';
                                    }
                                    ?>

                                    <span class="order-status <?= $statusClass ?>">
                                        <?= ucfirst(
                                            esc($p['status_pesanan'])
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="order-date">
                                        <?= date(
                                            'd/m/Y H:i',
                                            strtotime($p['created_at'])
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <a
                                        href="<?= base_url(
                                            'admin/pesanan/detail/' .
                                            $p['kode_pesanan']
                                        ) ?>"
                                        class="admin-detail-button"
                                    >
                                        Detail →
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="8">
                                <div class="admin-empty">
                                    <div>♡</div>

                                    <h3>
                                        Belum ada pesanan
                                    </h3>

                                    <p>
                                        Pesanan pelanggan akan muncul di sini.
                                    </p>
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
