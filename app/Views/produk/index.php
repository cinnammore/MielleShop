<?= $this->include('layout/header') ?>

<section class="produk-page">
    <div class="container">
        <!-- HEADER -->
        <div class="produk-header text-center">
            <span class="section-label">
                MIELLE COLLECTION
            </span>

            <h1>
                Semua <em>Produk</em>
            </h1>

            <p>
                Temukan aksesori pilihan untuk melengkapi
                setiap gaya dan momen spesialmu.
            </p>
        </div>

        <!-- PRODUCT GRID -->
        <div class="row g-4">
            <?php foreach ($produk as $p): ?>

                <div class="col-6 col-lg-4">
                    <div class="product-card">
                        <!-- IMAGE -->
                        <div class="product-image">
                            <?php if ($p['gambar']): ?>

                                <img src="<?= base_url('assets/img/' . $p['gambar']) ?>" alt="<?= esc($p['nama_produk']) ?>">

                            <?php else: ?>

                                <div class="no-image">
                                    <span>MIELLE</span>
                                </div>

                            <?php endif; ?>
                        </div>

                        <!-- PRODUCT INFO -->
                        <div class="product-info">
                            <span class="product-category">
                                MIELLE COLLECTION
                            </span>

                            <h3>
                                <?= esc($p['nama_produk']) ?>
                            </h3>

                            <!-- DESCRIPTION -->
                            <p class="product-description">
                                <?= esc($p['deskripsi']) ?>
                            </p>

                            <!-- PRICE -->
                            <div class="product-price">
                                Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                            </div>

                            <!-- STOCK -->
                            <div class="product-stock">
                                <?php if ($p['stok'] > 0): ?>
                                    <span class="stock-dot"></span>
                                    Stok tersedia: <?= $p['stok'] ?>
                                <?php else: ?>
                                    <span class="stock-out">
                                        <?= $p['status_stok'] === 'out_of_order' ? 'Out of Order' : 'Sold Out' ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- BUTTON -->
                            <a href="<?= base_url('produk/detail/' . $p['id_produk']) ?>" class="product-detail-btn">
                                Lihat Detail
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->include('layout/footer') ?>
