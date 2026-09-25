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


        <!-- SEARCH & FILTER -->
        <div class="product-filter">
            <form action="<?= base_url('produk') ?>" method="get">
                <div class="row g-3 align-items-center">
                    <!-- SEARCH -->
                    <div class="col-12 col-md-7">
                        <div class="search-box">
                            <span class="search-icon">⌕</span>
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari nama produk..."
                                value="<?= esc($search ?? '') ?>"
                            >
                        </div>
                    </div>

                    <!-- CATEGORY -->
                    <div class="col-12 col-md-3">
                        <select
                            name="kategori"
                            class="form-select category-select"
                        >
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategori as $k): ?>
                                <option
                                    value="<?= $k['id_kategori'] ?>"
                                    <?= ($selectedKategori ?? '') == $k['id_kategori'] ? 'selected' : '' ?>
                                >
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- BUTTON -->
                    <div class="col-12 col-md-2">
                        <button
                            type="submit"
                            class="filter-button"
                        >
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- RESULT INFO -->
        <?php if (!empty($search) || !empty($selectedKategori)): ?>
            <div class="filter-result">
                <?php if (!empty($search)): ?>
                    Hasil pencarian untuk
                    <strong>"<?= esc($search) ?>"</strong>
                <?php endif; ?>
                <?php if (!empty($search) && !empty($selectedKategori)): ?>
                <?php endif; ?>
                <?php if (!empty($selectedKategori)): ?>
                    <?php
                    $namaKategori = '';
                    foreach ($kategori as $k) {
                        if ($k['id_kategori'] == $selectedKategori) {
                            $namaKategori = $k['nama_kategori'];
                            break;
                        }
                    }
                    ?>
                    Kategori:
                    <strong><?= esc($namaKategori) ?></strong>
                <?php endif; ?>
                <a href="<?= base_url('produk') ?>">
                    Reset
                </a>
            </div>
        <?php endif; ?>

        <!-- PRODUCT GRID -->
        <div class="row g-4">
            <?php if (!empty($produk)): ?>
                <?php foreach ($produk as $p): ?>
                    <div class="col-6 col-lg-4">
                        <div class="product-card">
                            <!-- IMAGE -->
                            <div class="product-image">
                                <?php if ($p['gambar']): ?>
                                    <img
                                        src="<?= base_url('assets/img/' . $p['gambar']) ?>"
                                        alt="<?= esc($p['nama_produk']) ?>"
                                    >
                                <?php else: ?>
                                    <div class="no-image">
                                        <span>MIELLE</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- PRODUCT INFO -->
                            <div class="product-info">
                                <span class="product-category">
                                    <?= esc($p['nama_kategori'] ?? 'MIELLE COLLECTION') ?>
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
                                        Stok tersedia:
                                        <?= $p['stok'] ?>
                                    <?php else: ?>
                                        <span class="stock-out">
                                            <?= $p['status_stok'] === 'out_of_order'
                                                ? 'Out of Order'
                                                : 'Sold Out'
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- BUTTON -->
                                <a
                                    href="<?= base_url('produk/detail/' . $p['id_produk']) ?>"
                                    class="product-detail-btn"
                                >
                                    Lihat Detail
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- EMPTY RESULT -->
                <div class="col-12">
                    <div class="empty-product">
                        <div class="empty-icon">
                            ♡
                        </div>
                        <h3>Produk tidak ditemukan</h3>
                        <p>
                            Tidak ada produk yang sesuai dengan pencarianmu.
                        </p>
                        <a
                            href="<?= base_url('produk') ?>"
                            class="product-detail-btn"
                        >
                            Lihat Semua Produk
                            <span>→</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->include('layout/footer') ?>
