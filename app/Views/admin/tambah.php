<?= $this->include('layout/header') ?>

<section class="admin-form-page">
    <div class="container">
        <a href="<?= base_url('admin') ?>" class="admin-back-link">
            ← Kembali ke Produk
        </a>

        <div class="admin-form-header">
            <span class="section-label">MIELLE ADMIN</span>
            <h1>
                Tambah <em>Produk</em>
            </h1>
            <p>
                Tambahkan produk baru ke dalam koleksi Mielle Accessories.
            </p>
        </div>

        <div class="admin-form-card">
            <div class="admin-form-title">
                <span class="section-label">NEW PRODUCT</span>

                <h2>
                    Informasi <em>Produk</em>
                </h2>
            </div>

            <form action="<?= base_url('admin/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="admin-form-group">
                    <label for="nama_produk">
                        Nama Produk
                    </label>
                    <input type="text" id="nama_produk" name="nama_produk" value="<?= old('nama_produk') ?>" placeholder="Contoh: Pearl Necklace" required>
                </div>

                <div class="admin-form-group">
                    <label for="id_kategori">
                        Kategori
                    </label>
                    <select id="id_kategori" name="id_kategori" required>
                        <option value="">
                            Pilih kategori
                        </option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori'] ?>" <?= old('id_kategori') == $k['id_kategori'] ? 'selected' : '' ?>>
                                <?= esc($k['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="harga">
                            Harga
                        </label>
                        <input type="number" id="harga" name="harga" value="<?= old('harga') ?>" placeholder="50000" min="0" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="stok">
                            Stok
                        </label>
                        <input type="number" id="stok" name="stok" value="<?= old('stok') ?>" placeholder="10" min="0" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>
                        Gambar Produk
                    </label>
                    <div class="image-dropzone" id="imageDropzone">
                        <input type="file" name="gambar" id="gambarInput" accept="image/jpeg,image/png,image/webp" hidden>

                        <div class="dropzone-content" id="dropzoneContent">
                            <div class="dropzone-icon">
                                ♡
                            </div>
                            <h3>
                                Drag & Drop gambar di sini
                            </h3>
                            <p>
                                atau klik untuk memilih gambar
                            </p>
                            <small>
                                JPG, JPEG, PNG atau WEBP
                                <br>
                                Maksimal 5 MB
                            </small>
                            <div class="dropzone-paste">
                                Ctrl + V untuk paste gambar
                            </div>
                        </div>
>
                        <div class="image-preview-wrapper" id="imagePreviewWrapper" style="display: none;">
                            <img id="imagePreview" src="" alt="Preview gambar">

                            <button type="button" class="remove-image" id="removeImage" title="Hapus gambar">
                                ×
                            </button>

                            <div class="image-preview-name" id="imagePreviewName"></div>
                        </div>
                    </div>

                    <small class="upload-help">
                        Kamu dapat memilih gambar, drag & drop,
                        atau menggunakan <strong>Ctrl + V</strong>.
                    </small>
                </div>

                <div class="admin-form-group">
                    <label for="deskripsi">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="6" placeholder="Tulis deskripsi produk..."><?= old('deskripsi') ?></textarea>
                </div>

                <div class="admin-form-actions">
                    <a href="<?= base_url('admin') ?>" class="admin-secondary-button">
                        Batal
                    </a>

                    <button type="submit" class="admin-primary-button">
                        Simpan Produk →
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('imageDropzone');
    const input = document.getElementById('gambarInput');
    const content = document.getElementById('dropzoneContent');
    const previewWrapper =
        document.getElementById('imagePreviewWrapper');
    const preview =
        document.getElementById('imagePreview');
    const previewName =
        document.getElementById('imagePreviewName');
    const removeButton =
        document.getElementById('removeImage');

    dropzone.addEventListener('click', function (event) {
        if (event.target === removeButton) {
            return;
        }
        input.click();
    });

    input.addEventListener('change', function () {
        if (this.files.length > 0) {
            setFile(this.files[0]);
        }
    });
    dropzone.addEventListener('dragover', function (event) {
        event.preventDefault();
        dropzone.classList.add('dragover');
    });
    dropzone.addEventListener('dragleave', function () {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', function (event) {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            setFile(files[0]);
        }
    });

    document.addEventListener('paste', function (event) {
        const items = event.clipboardData.items;
        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            if (item.type.indexOf('image') !== -1) {
                const file = item.getAsFile();
                if (file) {
                    setFile(file);
                }

                break;
            }
        }
    });

    removeButton.addEventListener('click', function (event) {
        event.stopPropagation();
        input.value = '';
        preview.src = '';
        previewWrapper.style.display = 'none';
        content.style.display = 'block';
    });

    function setFile(file) {
        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert(
                'Format gambar tidak didukung.\n\n' +
                'Gunakan JPG, JPEG, PNG atau WEBP.'
            );
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert(
                'Ukuran gambar terlalu besar.\n\n' +
                'Maksimal ukuran gambar adalah 5 MB.'
            );
            return;
        }

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
        showPreview(file);
    }

    // PREVIEW
    function showPreview(file) {
        const reader = new FileReader();

        reader.onload = function (event) {
            preview.src = event.target.result;
            previewName.textContent = file.name;
            content.style.display = 'none';
            previewWrapper.style.display = 'flex';
        };

        reader.readAsDataURL(file);
    }
});
</script>

<?= $this->include('layout/footer') ?>
