<?= $this->include('layout/header') ?>

<section class="admin-page">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-label">MIELLE ADMIN</span>
                <h1>Detail <em>Pesanan</em></h1>
                <p>Kelola status dan pengiriman pesanan <?= esc($pesanan['kode_pesanan']) ?>.</p>
            </div>
            <a href="<?= base_url('admin/pesanan') ?>" class="admin-detail-button">&larr; Kembali</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mielle-alert success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mielle-alert error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h2>Informasi <em>Pesanan</em></h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
                            <tr>
                                <th style="width: 150px;">Kode Pesanan</th>
                                <td>: <strong><?= esc($pesanan['kode_pesanan']) ?></strong></td>
                            </tr>
                            <tr>
                                <th>Pelanggan</th>
                                <td>: <?= esc($pesanan['nama_pelanggan']) ?> (<?= esc($pesanan['no_hp']) ?>)</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>: <?= esc($pesanan['alamat']) ?>, <?= esc($pesanan['kota']) ?></td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>: <?= esc($pesanan['catatan'] ?: '-') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="admin-card mt-4" style="margin-top: 2rem;">
                    <div class="admin-card-header">
                        <h2>Detail <em>Produk</em></h2>
                    </div>
                    <div class="table-responsive">
                        <table class="mielle-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_produk']) ?></td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td><?= $item['qty'] ?></td>
                                    <td><strong>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot style="border-top: 2px solid var(--mielle-gray);">
                                <tr>
                                    <th colspan="3" class="text-end" style="text-align: right; padding-right: 15px;">Total Pembayaran :</th>
                                    <th><strong style="color: var(--mielle-primary); font-size: 1.1rem;">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></strong></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h2>Update <em>Status</em></h2>
                    </div>

                    <form action="<?= base_url('admin/pesanan/status/' . $pesanan['kode_pesanan']) ?>" method="POST" class="mb-4" style="margin-bottom: 2rem;">
                        <div class="form-group mb-2">
                            <label style="font-weight: 600; font-size: 0.9rem; color: var(--mielle-dark); margin-bottom: 5px; display: block;">Status Pesanan</label>
                            <select name="status_pesanan" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--mielle-gray); border-radius: 8px; margin-bottom: 10px;">
                                <option value="baru" <?= $pesanan['status_pesanan'] == 'baru' ? 'selected' : '' ?>>Baru</option>
                                <option value="diproses" <?= $pesanan['status_pesanan'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                <option value="dikirim" <?= $pesanan['status_pesanan'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                <option value="selesai" <?= $pesanan['status_pesanan'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                <option value="dibatalkan" <?= $pesanan['status_pesanan'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                        </div>
                        <button type="submit" class="admin-detail-button" style="width: 100%; justify-content: center;">Update Status Pesanan</button>
                    </form>

                    <hr style="border-color: var(--mielle-gray); margin: 20px 0;">

                    <form action="<?= base_url('admin/pesanan/pembayaran/' . $pesanan['kode_pesanan']) ?>" method="POST" class="mb-4" style="margin-bottom: 2rem;">
                        <div class="form-group mb-2">
                            <label style="font-weight: 600; font-size: 0.9rem; color: var(--mielle-dark); margin-bottom: 5px; display: block;">Status Pembayaran (<?= strtoupper($pesanan['metode_pembayaran']) ?>)</label>
                            <select name="status_pembayaran" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--mielle-gray); border-radius: 8px; margin-bottom: 10px;">
                                <option value="menunggu" <?= $pesanan['status_pembayaran'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                <option value="dibayar" <?= $pesanan['status_pembayaran'] == 'dibayar' ? 'selected' : '' ?>>Dibayar (Menunggu Konfirmasi)</option>
                                <option value="dikonfirmasi" <?= $pesanan['status_pembayaran'] == 'dikonfirmasi' ? 'selected' : '' ?>>Dikonfirmasi</option>
                            </select>
                        </div>
                        <button type="submit" class="admin-detail-button" style="width: 100%; justify-content: center; background: #2c3e50;">Update Status Pembayaran</button>
                    </form>

                    <hr style="border-color: var(--mielle-gray); margin: 20px 0;">

                    <form action="<?= base_url('admin/pesanan/pengiriman/' . $pesanan['kode_pesanan']) ?>" method="POST">
                        <div class="form-group mb-2">
                            <label style="font-weight: 600; font-size: 0.9rem; color: var(--mielle-dark); margin-bottom: 5px; display: block;">Lokasi / Status Paket</label>
                            <textarea name="lokasi_terakhir" class="form-control" rows="3" style="width: 100%; padding: 10px; border: 1px solid var(--mielle-gray); border-radius: 8px; margin-bottom: 10px;" placeholder="Contoh: Paket telah diserahkan ke kurir JNE..."><?= esc($pesanan['lokasi_terakhir'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="admin-detail-button" style="width: 100%; justify-content: center; background: #27ae60;">Update Status Paket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('layout/footer') ?>