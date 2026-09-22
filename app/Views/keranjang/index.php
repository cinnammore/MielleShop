<?= $this->include('layout/header') ?>

<section class="cart-page">
    <div class="container">
        <div class="cart-header">
            <span class="section-label">
                YOUR SHOPPING BAG
            </span>

            <h1>
                Keranjang <em>Belanja</em>
            </h1>

            <p>
                Periksa kembali produk pilihanmu sebelum melanjutkan
                ke checkout.
            </p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>

        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>

        <?php endif; ?>

        <?php if (!empty($items)): ?>

            <div class="cart-layout">
                <div class="cart-items">
                    <?php foreach ($items as $item): ?>

                        <div class="cart-item">
                            <div class="cart-product-image">
                                <?php if ($item['gambar']): ?>

                                    <img src="<?= base_url('assets/img/' . $item['gambar']) ?>" alt="<?= esc($item['nama_produk']) ?>">

                                <?php else: ?>

                                    <div class="no-image">
                                        <span>MIELLE</span>
                                    </div>

                                <?php endif; ?>
                            </div>

                            <div class="cart-product-info">
                                <span class="product-category">
                                    MIELLE COLLECTION
                                </span>

                                <h3>
                                    <?= esc($item['nama_produk']) ?>
                                </h3>

                                <p class="cart-price">
                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                </p>

                                <div class="cart-bottom">
                                    <form action="<?= base_url('keranjang/update') ?>" method="post" class="quantity-control">

                                        <?= csrf_field() ?>

                                        <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">

                                        <button type="submit" name="qty" value="<?= max(1, $item['qty'] - 1) ?>">
                                            −
                                        </button>

                                        <span>
                                            <?= $item['qty'] ?>
                                        </span>

                                        <button type="submit" name="qty" value="<?= $item['qty'] + 1 ?>">
                                            +
                                        </button>
                                    </form>

                                    <a href="<?= base_url('keranjang/hapus/' . $item['id_produk']) ?>" class="remove-cart">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <a href="<?= base_url('keranjang/kosongkan') ?>" class="continue-shopping">
                        Kosongkan Keranjang
                    </a>
                </div>

                <aside class="cart-summary">
                    <span class="section-label">
                        ORDER SUMMARY
                    </span>

                    <h2>
                        Ringkasan <em>Pesanan</em>
                    </h2>

                    <div class="summary-row">
                        <span>Jumlah Item</span>
                        <strong>
                            <?= array_sum(array_column($items, 'qty')) ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>

                        <strong>
                            Rp <?= number_format($total, 0, ',', '.') ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Ongkir</span>
                        <span>Belum dihitung</span>
                    </div>

                    <div class="summary-line"></div>

                    <div class="summary-total">
                        <span>Total</span>

                        <strong>
                            Rp <?= number_format($total, 0, ',', '.') ?>
                        </strong>
                    </div>

                    <a href="<?= base_url('checkout') ?>" class="checkout-button">
                        Lanjut ke Checkout
                        <span>→</span>
                    </a>

                    <a href="<?= base_url('produk') ?>" class="continue-shopping">
                        ← Lanjut Belanja
                    </a>
                </aside>
            </div>

        <?php else: ?>

            <div class="empty-products">
                <div class="empty-icon">
                    ♡
                </div>

                <h3>
                    Keranjang masih kosong
                </h3>

                <p>
                    Yuk temukan sesuatu yang cantik untuk koleksimu.
                </p>

                <a href="<?= base_url('produk') ?>" class="checkout-button">
                    Explore Collection
                    <span>→</span>
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>

<?= $this->include('layout/footer') ?>
