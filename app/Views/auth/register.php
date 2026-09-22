<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Register - Mielle Accessories' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="auth-body">
<div class="auth-page">
    <div class="auth-wrapper">
        <!-- BRAND -->

        <div class="auth-brand">
            <a href="<?= base_url('/') ?>">
                MIELLE
            </a>

            <span>
                ACCESSORIES
            </span>
        </div>

        <!-- REGISTER CARD -->

        <div class="auth-card">
            <div class="auth-header">
                <span class="section-label">
                    JOIN MIELLE
                </span>

                <h1>
                    Create <em>Account.</em>
                </h1>

                <p>
                    Buat akun Mielle kamu
                    dan mulai belanja sekarang.
                </p>
            </div>

            <!-- ERROR -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="auth-alert error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>

            <?php endif; ?>

            <!-- FORM -->

            <form action="<?= base_url('register/create') ?>" method="post">

                <?= csrf_field() ?>

                <!-- NAMA -->

                <div class="auth-form-group">
                    <label>
                        Nama
                    </label>
                    <input type="text" name="nama" value="<?= old('nama') ?>" placeholder="Nama lengkap" autocomplete="name" required>
                </div>

                <!-- EMAIL -->

                <div class="auth-form-group">
                    <label>
                        Email
                    </label>
                    <input type="email" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" autocomplete="email" required>
                </div>

                <!-- PASSWORD -->

                <div class="auth-form-group">
                    <label>
                        Password
                    </label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" autocomplete="new-password" minlength="6" required>
                </div>

                <!-- KONFIRMASI PASSWORD -->

                <div class="auth-form-group">
                    <label>
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirm" placeholder="Ulangi password" autocomplete="new-password" minlength="6" required>
                </div>

                <!-- BUTTON -->

                <button type="submit" class="auth-button">
                    Buat Akun

                    <span>→</span>
                </button>
            </form>

            <!-- LOGIN -->

            <div class="auth-register">
                <span>
                    Sudah punya akun?
                </span>

                <a href="<?= base_url('login') ?>">
                    Login
                </a>
            </div>

            <!-- BACK -->

            <a href="<?= base_url('/') ?>" class="auth-back">
                ← Kembali ke Mielle
            </a>
        </div>

        <!-- FOOTER -->

        <div class="auth-footer">
            Made with ♡ by Mielle Accessories
        </div>
    </div>
</div>
</body>
</html>
