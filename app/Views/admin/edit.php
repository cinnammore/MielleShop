<?= $this->include('layout/header') ?>

<section class="admin-form-page">
<div class="container">
    <a href="<?= base_url('admin') ?>" class="admin-back-link">
        ← Kembali ke Produk
    </a>
    <div class="admin-form-header">
        <span class="section-label">MIELLE ADMIN</span>
        <h1>
            Edit <em>Produk</em>
        </h1>
        <p>
            Perbarui informasi produk yang sudah ada di koleksi Mielle.
        </p>
    </div>

    <div class="admin-form-card">
        <div class="admin-form-title">
            <span class="section-label">
                EDIT PRODUCT #<?= $produk['id_produk'] ?>
            </span>
            <h2>
                Informasi <em>Produk</em>
            </h2>
        </div>

        <form action="<?= base_url('admin/update/' . $produk['id_produk']) ?>" method="post">

            <div class="admin-form-group">
                <label>Kategori</label>
                <select name="id_kategori" required>
                    <?php foreach ($kategori as $k): ?>
                        <option
                            value="<?= $k['id_kategori'] ?>"
                            <?= $k['id_kategori'] == $produk['id_kategori']
                                ? 'selected'
                                : '' ?>
                        >
                            <?= esc($k['nama_kategori']) ?>
                        </option>

                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= esc($produk['nama_produk']) ?>" required>
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label>Harga</label>
                    <div class="price-input">
                        <span>Rp</span>
                        <input type="number" name="harga" value="<?= $produk['harga'] ?>" min="0" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" value="<?= $produk['stok'] ?>" min="0" required>
                </div>
            </div>

            <div class="admin-form-group">
                <label>Nama File Gambar</label>
                <input type="text" name="gambar" value="<?= esc($produk['gambar']) ?>" placeholder="contoh: necklace.jpg">

                <?php if (!empty($produk['gambar'])): ?>

                    <div class="current-image">
                        <img src="<?= base_url('assets/img/' . $produk['gambar']) ?>" alt="<?= esc($produk['nama_produk']) ?>">
                        <div>
                            <span>GAMBAR SAAT INI</span>

                            <strong>
                                <?= esc($produk['gambar']) ?>
                            </strong>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
            <div class="admin-form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" rows="6" placeholder="Tuliskan deskripsi produk..."><?= esc($produk['deskripsi']) ?></textarea>
            </div>
            <div class="admin-form-actions">
                <a href="<?= base_url('admin') ?>" class="admin-secondary-button">
                    Batal
                </a>

                <button type="submit" class="admin-primary-button">
                    Simpan Perubahan
                    <span>→</span>
                </button>
            </div>
        </form>
    </div>
</div>
</section>

<?= $this->include('layout/footer') ?>
