<?= $this->include('layout/header') ?>

<section class="admin-page">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-label">MIELLE ADMIN</span>
                <h1>
                    Data <em>Produk</em>
                </h1>
                <p>
                    Kelola koleksi produk Mielle Accessories.
                </p>
            </div>

            <a href="<?= base_url('admin/tambah') ?>" class="admin-primary-button">
                + Tambah Produk
            </a>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <span class="section-label">PRODUCT COLLECTION</span>
                    <h2>Daftar Produk</h2>
                </div>

                <span class="product-total">
                    <?= count($produk) ?> Produk
                </span>
            </div>

            <div class="table-responsive">
                <table class="mielle-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($produk)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($produk as $p): ?>
                            <tr>
                                <td class="table-number">
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <div class="admin-product">
                                        <div class="admin-product-image">
                                            <?php if (!empty($p['gambar'])): ?>
                                                <img src="<?= base_url('assets/img/' . $p['gambar']) ?>" alt="<?= esc($p['nama_produk']) ?>">
                                            <?php else: ?>
                                                <span>♡</span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <strong>
                                                <?= esc($p['nama_produk']) ?>
                                            </strong>
                                            <small>
                                                ID #<?= $p['id_produk'] ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="category-badge">
                                        <?= esc($p['nama_kategori']) ?>
                                    </span>
                                </td>

                                <td class="admin-price">
                                    Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                </td>

                                <td>
                                    <?php if ($p['stok'] > 0): ?>

                                        <span class="stock-badge">
                                            <?= $p['stok'] ?> tersedia
                                        </span>

                                    <?php else: ?>

                                        <span class="stock-empty">
                                            Habis
                                        </span>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="admin-actions">
                                        <a href="<?= base_url('admin/edit/' . $p['id_produk']) ?>" class="admin-edit">
                                            Edit
                                        </a>
                                        <a href="<?= base_url('admin/hapus/' . $p['id_produk']) ?>" class="admin-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="admin-empty">
                                    <div>♡</div>
                                    <h3>Belum ada produk</h3>
                                    <p>
                                        Tambahkan produk pertama ke koleksi Mielle.
                                    </p>
                                    <a href="<?= base_url('admin/tambah') ?>" class="admin-primary-button">
                                        + Tambah Produk
                                    </a>
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
