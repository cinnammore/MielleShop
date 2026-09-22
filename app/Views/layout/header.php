<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Mielle Accessories' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg mielle-navbar">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand mielle-logo" href="<?= base_url('/') ?>">
            MIELLE
            <small>ACCESSORIES</small>
        </a>

        <!-- MOBILE BUTTON -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mielleNavbar" aria-controls="mielleNavbar" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVIGATION -->
        <div class="collapse navbar-collapse" id="mielleNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <!-- HOME -->
                <li class="nav-item">
                    <a class="nav-link mielle-nav-link" href="<?= base_url('/') ?>">
                        Home
                    </a>
                </li>

                <!-- PRODUK -->
                <li class="nav-item">
                    <a class="nav-link mielle-nav-link" href="<?= base_url('produk') ?>">
                        Produk
                    </a>
                </li>

                <li class="nav-item">
    <a class="nav-link mielle-nav-link" href="<?= base_url('keranjang') ?>">
        Keranjang
        <?php
        $cart = session()->get('cart') ?? [];
        $cartCount = array_sum($cart);
        ?>

        <?php if ($cartCount > 0): ?>

            <span class="cart-count">
                <?= $cartCount ?>
            </span>

        <?php endif; ?>
    </a>
</li>

<li class="nav-item">
                    <a class="nav-link mielle-nav-link" href="<?= base_url('histori') ?>">
                        Riwayat Pesanan
                    </a>
                </li>

 <?php if (session()->get('isLoggedIn')): ?>

    <?php if (session()->get('role') === 'admin'): ?>

        <li class="nav-item">
            <a class="nav-link mielle-nav-link" href="<?= base_url('admin') ?>">
                Produk
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link mielle-nav-link" href="<?= base_url('admin/pesanan') ?>">
                Pesanan
            </a>
        </li>

    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link mielle-nav-link" href="<?= base_url('logout') ?>">
            Logout
        </a>
    </li>

<?php else: ?>

    <li class="nav-item">
        <a class="nav-link mielle-nav-link" href="<?= base_url('login') ?>">
            Login
        </a>
    </li>

<?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
