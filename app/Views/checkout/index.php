<?= $this->include('layout/header') ?>

<section class="checkout-page">
    <div class="container">
        <div class="checkout-header">
            <span class="section-label">
                CHECKOUT
            </span>

            <h1>
                Complete Your <em>Order</em>
            </h1>

            <p>
                Isi informasi pengiriman dan pilih metode pembayaran.
            </p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>

        <?php endif; ?>

        <form action="<?= base_url('checkout/process') ?>" method="post">

            <?= csrf_field() ?>

            <div class="checkout-layout">
                <!-- FORM -->

                <div class="checkout-form">
                    <div class="checkout-card">
                        <span class="section-label">
                            01 — DELIVERY INFORMATION
                        </span>

                        <h2>
                            Informasi <em>Pengiriman</em>
                        </h2>

                        <div class="form-group">
                            <label>
                                Nama Lengkap
                            </label>
                            <input type="text" name="nama_pelanggan" value="<?= old('nama_pelanggan') ?>" placeholder="Nama penerima" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>
                                    No. WhatsApp
                                </label>
                                <input type="text" name="no_hp" value="<?= old('no_hp') ?>" placeholder="08xxxxxxxxxx" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    Kota
                                </label>
                                <input type="text" name="kota" value="<?= old('kota') ?>" placeholder="Kota / Kabupaten" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                Alamat Lengkap
                            </label>
                            <textarea name="alamat" rows="4" placeholder="Nama jalan, nomor rumah, RT/RW, kecamatan..." required><?= old('alamat') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>
                                Catatan Pesanan
                                <small>(opsional)</small>
                            </label>
                            <textarea name="catatan" rows="3" placeholder="Contoh: Tolong taruh di depan rumah."><?= old('catatan') ?></textarea>
                        </div>
                    </div>

                    <!-- PAYMENT -->

                    <div class="checkout-card">
                        <span class="section-label">
                            02 — PAYMENT METHOD
                        </span>

                        <h2>
                            Metode <em>Pembayaran</em>
                        </h2>

                        <label class="payment-option">
                            <input type="radio" name="metode_pembayaran" value="cod" required>

                            <div class="payment-content">
                                <div>
                                    <strong>
                                        Cash on Delivery
                                    </strong>

                                    <small>
                                        Bayar saat pesanan diterima.
                                    </small>
                                </div>

                                <span class="payment-icon">
                                    COD
                                </span>
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="metode_pembayaran" value="transfer">

                            <div class="payment-content">
                                <div>
                                    <strong>
                                        Transfer Bank
                                    </strong>

                                    <small>
                                        Transfer melalui rekening Mielle.
                                    </small>
                                </div>

                                <span class="payment-icon">
                                    BANK
                                </span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- SUMMARY -->

                <aside class="checkout-summary">
                    <span class="section-label">
                        YOUR ORDER
                    </span>

                    <h2>
                        Pesanan <em>Kamu</em>
                    </h2>

                    <?php foreach ($items as $item): ?>

                        <div class="checkout-product">
                            <div class="checkout-product-image">
                                <?php if ($item['gambar']): ?>

                                    <img src="<?= base_url('assets/img/' . $item['gambar']) ?>" alt="<?= esc($item['nama_produk']) ?>">

                                <?php endif; ?>
                            </div>

                            <div>
                                <h3>
                                    <?= esc($item['nama_produk']) ?>
                                </h3>

                                <span>
                                    <?= $item['qty'] ?> ×
                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                </span>
                            </div>

                            <strong>
                                Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                            </strong>
                        </div>

                    <?php endforeach; ?>

                    <div class="summary-line"></div>

                    <div class="summary-row">
                        <span>
                            Subtotal
                        </span>

                        <strong>
                            Rp <?= number_format($total, 0, ',', '.') ?>
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>
                            Ongkir
                        </span>

                        <span>
                            Belum dihitung
                        </span>
                    </div>

                    <div class="summary-total">
                        <span>
                            Total
                        </span>

                        <strong>
                            Rp <?= number_format($total, 0, ',', '.') ?>
                        </strong>
                    </div>

                    <button type="submit" class="checkout-button">
                        Buat Pesanan
                        <span>→</span>
                    </button>
                </aside>
            </div>
        </form>
    </div>
</section>

<?= $this->include('layout/footer') ?>
