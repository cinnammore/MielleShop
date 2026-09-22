<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Login - Mielle Accessories' ?></title>

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

        <!-- LOGIN CARD -->

        <div class="auth-card">
            <div class="auth-header">
                <span class="section-label">
                    WELCOME BACK
                </span>

                <h1>
                    Welcome <em>Back.</em>
                </h1>

                <p>
                    Masuk ke akun Mielle kamu
                    dan lanjutkan belanja.
                </p>
            </div>

            <!-- SUCCESS -->

            <?php if (session()->getFlashdata('success')): ?>

                <div class="auth-alert success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>

            <?php endif; ?>

            <!-- ERROR -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="auth-alert error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>

            <?php endif; ?>

            <!-- FORM -->

            <form action="<?= base_url('login/check') ?>" method="post">

                <?= csrf_field() ?>

                <div class="auth-form-group">
                    <label>
                        Email
                    </label>
                    <input type="email" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" required>
                </div>

                <div class="auth-form-group">
                    <label>
                        Password
                    </label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="auth-button">
                    Login

                    <span>→</span>
                </button>
            </form>

            <!-- REGISTER -->

            <div class="auth-register">
                <span>
                    Belum punya akun?
                </span>

                <a href="<?= base_url('register') ?>">
                    Buat Akun
                </a>
            </div>

            <!-- BACK -->

            <a href="<?= base_url('/') ?>" class="auth-back">
                ← Kembali ke Mielle
            </a>
        </div>

        <div class="auth-footer">
            Made with ♡ by Mielle Accessories
        </div>
    </div>
</div>
</body>
</html>
