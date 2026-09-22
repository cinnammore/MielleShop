<?= $this->include('layout/header') ?>

<section class="detail-page">
<div class="container">
    <a href="<?= base_url('produk') ?>" class="back-link">
        ← Kembali ke Collection
    </a>

    <div class="detail-wrapper">
        <!-- FOTO PRODUK -->
        <div class="detail-image">
            <?php if ($produk['gambar']): ?>

                <img src="<?= base_url('assets/img/' . $produk['gambar']) ?>" alt="<?= esc($produk['nama_produk']) ?>">

            <?php else: ?>

                <div class="detail-no-image">
                    <span>MIELLE</span>
                    <small>ACCESSORIES</small>
                </div>

            <?php endif; ?>
        </div>

        <!-- INFORMASI PRODUK -->
        <div class="detail-info">
            <span class="section-label">
                MIELLE COLLECTION
            </span>

            <h1>
                <?= esc($produk['nama_produk']) ?>
            </h1>

            <div class="detail-price">
                Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
            </div>

            <div class="detail-line"></div>

            <div class="detail-description" id="productDescription">
                <?= esc($produk['deskripsi']) ?>
            </div>

            <button type="button" class="description-toggle" onclick="toggleDescription()">
                Selengkapnya
                <span>↓</span>
            </button>

            <div class="detail-stock">
                <?php if ($produk['stok'] > 0): ?>

                    <span class="stock-dot"></span>
                    Stok tersedia:
                    <strong><?= $produk['stok'] ?></strong>

                <?php else: ?>

                    <span class="stock-out">
                        <?= $produk['status_stok'] === 'out_of_order' ? 'Out of Order' : 'Sold Out' ?>
                    </span>

                <?php endif; ?>
            </div>

            <?php if ($produk['stok'] > 0): ?>

                <a href="<?= base_url('keranjang/tambah/' . $produk['id_produk']) ?>" class="detail-cart-button">
    Tambah ke Keranjang
    <span>→</span>
</a>

            <?php else: ?>

                <button class="detail-cart-button disabled" disabled>
                    <?= $produk['status_stok'] === 'out_of_order' ? 'Out of Order' : 'Sold Out' ?>
                </button>

            <?php endif; ?>

            <p class="detail-note">
                ♡ Made for your everyday elegance
            </p>
        </div>
    </div>
</div>
</section>

<script>
function toggleDescription() {
    const description = document.getElementById('productDescription');
    const button = document.querySelector('.description-toggle');

    description.classList.toggle('expanded');

    if (description.classList.contains('expanded')) {
        button.innerHTML = 'Sembunyikan <span>↑</span>';
    } else {
        button.innerHTML = 'Selengkapnya <span>↓</span>';
    }
}
</script>

<?= $this->include('layout/footer') ?>
