<?= $this->include('layout/header') ?>

<section class="checkout-page">
    <div class="container">
        <div class="checkout-header">
            <span class="section-label">
                MIELLE ORDER
            </span>

            <h1>
                Pesanan <em>Berhasil</em>
            </h1>

            <p>
                Terima kasih sudah berbelanja di Mielle Accessories.
            </p>
        </div>

        <div class="checkout-layout">
            <div class="checkout-form">
                <div class="checkout-card">
                    <span class="section-label">
                        ORDER INFORMATION
                    </span>

                    <h2>
                        <?= esc($pesanan['kode_pesanan']) ?>
                    </h2>

                    <div class="summary-row">
                        <span>Nama</span>
                        <strong>
                            <?= esc($pesanan['nama_pelanggan']) ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>WhatsApp</span>
                        <strong>
                            <?= esc($pesanan['no_hp']) ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Kota</span>
                        <strong>
                            <?= esc($pesanan['kota']) ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Metode Pembayaran</span>
                        <strong>
                            <?= strtoupper($pesanan['metode_pembayaran']) ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Status Pesanan</span>
                        <strong>
                            <?= ucfirst($pesanan['status_pesanan']) ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Status Pembayaran</span>
                        <strong>
                            <?= ucfirst($pesanan['status_pembayaran']) ?>
                        </strong>
                    </div>

                    <div class="summary-row" style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-top: 15px; border-left: 4px solid var(--mielle-primary);">
                        <span>Status / Lokasi Paket</span>
                        <strong style="text-align: right; color: var(--mielle-primary);">
                            <?= esc($pesanan['lokasi_terakhir'] ?? 'Pesanan sedang disiapkan') ?>
                        </strong>
                    </div>

                    <div class="summary-line"></div>

                    <span class="section-label">
                        SHIPPING ADDRESS
                    </span>

                    <p style="margin-top:15px;">
                        <?= nl2br(esc($pesanan['alamat'])) ?>
                    </p>
                </div>

                <div class="checkout-card">
                    <span class="section-label">
                        ORDER ITEMS
                    </span>

                    <h2>
                        Detail <em>Produk</em>
                    </h2>

                    <?php foreach ($detail as $item): ?>

                        <div class="summary-row">
                            <span>
                                <?= esc($item['nama_produk']) ?>
                                × <?= $item['qty'] ?>
                            </span>

                            <strong>
                                Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                            </strong>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

            <aside class="checkout-summary">
                <span class="section-label">
                    TOTAL
                </span>

                <h2>
                    Ringkasan <em>Pesanan</em>
                </h2>

                <div class="summary-total">
                    <span>
                        Total
                    </span>

                    <strong>
                        Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?>
                    </strong>
                </div>

                <?php if ($pesanan['metode_pembayaran'] === 'transfer'): ?>

                    <div class="summary-line"></div>

                    <span class="section-label">
                        BANK TRANSFER
                    </span>

                    <p style="margin-top:15px; font-size: 0.95rem;">
                        Silakan transfer sebesar <strong>Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></strong> ke rekening berikut:
                        <br><br>
                        <strong>BCA - 1234567890</strong><br>
                        a.n. Mielle Accessories
                        <br><br>
                        Admin akan melakukan konfirmasi secara manual maksimal 1x24 jam setelah Anda mentransfer.
                    </p>

                    <?php if ($pesanan['status_pembayaran'] === 'menunggu'): ?>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Mielle,%20saya%20sudah%20transfer%20untuk%20pesanan%20<?= esc($pesanan['kode_pesanan']) ?>" class="checkout-button" target="_blank">
                            Konfirmasi via WhatsApp
                            <span>→</span>
                        </a>
                    <?php else: ?>
                        <div class="mielle-alert success" style="text-align: center; margin-top: 15px;">
                            Pembayaran: <?= ucfirst($pesanan['status_pembayaran']) ?>
                        </div>
                    <?php endif; ?>

                <?php else: ?>

                    <div class="summary-line"></div>

                    <p>
                        Pembayaran dilakukan saat pesanan
                        diterima melalui COD.
                    </p>

                <?php endif; ?>

                <a href="<?= base_url('pesanan/invoice/' . $pesanan['kode_pesanan']) ?>" class="continue-shopping">
                    Lihat Invoice →
                </a>

                <a href="<?= base_url('produk') ?>" class="continue-shopping">
                    ← Kembali Belanja
                </a>
            </aside>
        </div>
    </div>
</section>

<?= $this->include('layout/footer') ?>
