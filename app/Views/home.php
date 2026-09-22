<?= $this->include('layout/header') ?>

<!-- HERO SECTION -->
<section class="mielle-hero">
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <!-- Hero Text -->
            <div class="col-lg-6 hero-content">
                <span class="hero-eyebrow">
                    ✦ MIELLE ACCESSORIES ✦
                </span>

                <h1>
                    Little Things,<br>
                    <span>Beautiful Moments.</span>
                </h1>

                <p class="hero-description">
                    Temukan koleksi aksesori cantik yang dirancang untuk
                    melengkapi setiap momen dan membuatmu semakin percaya diri.
                </p>

                <div class="hero-buttons">
                    <a href="<?= base_url('produk') ?>" class="btn-mielle">
                        Explore Collection
                        <span>→</span>
                    </a>

                    <a href="#produk-terbaru" class="btn-outline-mielle">
                        Lihat Terbaru
                    </a>
                </div>

                <div class="hero-note">
                    <span>♡</span>
                    Made for your everyday elegance
                </div>
            </div>

            <!-- Hero Decoration -->
            <div class="col-lg-6">
                <div class="hero-visual">
                    <div class="hero-circle"></div>

                    <div class="hero-card hero-card-main">
                        <div class="hero-placeholder">
                            <span>MIELLE</span>
                            <small>ACCESSORIES</small>
                        </div>
                    </div>

                    <div class="floating-element floating-one">
                        ✦
                    </div>

                    <div class="floating-element floating-two">
                        ♡
                    </div>

                    <div class="floating-text">
                        elegance<br>
                        in every detail
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BRAND INTRO -->
<section class="brand-intro">
    <div class="container text-center">
        <span class="section-label">OUR COLLECTION</span>

        <h2>
            Made to make you feel
            <em>beautiful.</em>
        </h2>

        <p>
            Dari detail kecil hingga statement piece,
            setiap aksesori Mielle dipilih untuk menemani
            gaya personalmu.
        </p>
    </div>
</section>

<!-- PRODUCT SECTION -->
<section class="product-section" id="produk-terbaru">
    <div class="container">
        <div class="section-heading">
            <div>
                <span class="section-label">NEW ARRIVALS</span>

                <h2>
                    Produk <em>Terbaru</em>
                </h2>
            </div>

            <a href="<?= base_url('produk') ?>" class="view-all">
                View All
                <span>→</span>
            </a>
        </div>

        <div class="row g-4">
            <?php if (!empty($produk)): ?>

                <?php foreach (array_slice($produk, 0, 4) as $p): ?>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="product-card">
                            <!-- Product Image -->
                            <div class="product-image">
                                <?php if ($p['gambar']): ?>

                                    <img src="<?= base_url('assets/img/' . $p['gambar']) ?>" alt="<?= esc($p['nama_produk']) ?>">

                                <?php else: ?>

                                    <div class="no-image">
                                        <span>MIELLE</span>
                                    </div>

                                <?php endif; ?>

                                <span class="product-badge">
                                    NEW
                                </span>
                            </div>

                            <!-- Product Information -->
                            <div class="product-info">
                                <span class="product-category">
                                    MIELLE COLLECTION
                                </span>

                                <h3>
                                    <?= esc($p['nama_produk']) ?>
                                </h3>

                                <div class="product-bottom">
                                    <p class="product-price">
                                        Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                    </p>

                                    <a href="<?= base_url('produk/detail/' . $p['id_produk']) ?>" class="product-arrow" aria-label="Lihat detail <?= esc($p['nama_produk']) ?>">
                                        →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">
                    <div class="empty-products">
                        <div class="empty-icon">
                            ♡
                        </div>

                        <h3>Belum ada produk</h3>

                        <p>
                            Koleksi cantik Mielle akan segera hadir.
                        </p>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</section>

<!-- AESTHETIC QUOTE -->
<section class="mielle-quote">
    <div class="quote-decoration left">
        ✦
    </div>

    <div class="container text-center">
        <span>MIELLE</span>

        <h2>
            "Elegance is not about<br>
            being noticed, it's about<br>
            <em>being remembered.</em>"
        </h2>

        <div class="quote-line"></div>
    </div>

    <div class="quote-decoration right">
        ♡
    </div>
</section>

<!-- CTA -->
<section class="mielle-cta">
    <div class="container">
        <div class="cta-box">
            <div class="cta-content">
                <span class="section-label">
                    FIND YOUR FAVORITE
                </span>

                <h2>
                    Something pretty<br>
                    <em>is waiting for you.</em>
                </h2>

                <p>
                    Jelajahi koleksi Mielle dan temukan aksesori
                    yang cocok untuk melengkapi gayamu.
                </p>

                <a href="<?= base_url('produk') ?>" class="btn-mielle">
                    Shop Now
                    <span>→</span>
                </a>
            </div>

            <div class="cta-flower">
                ✿
            </div>
        </div>
    </div>
</section>

<?= $this->include('layout/footer') ?>
