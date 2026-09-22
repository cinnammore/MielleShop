# 🌸 MielleShop 🌸

> Toko kecil-kecilan yang dibuat pakai CodeIgniter 4 ✨
> Live di: [mielleshop.ifree.page/public](https://mielleshop.ifree.page/public/)

---

## 💌 Tentang MielleShop

Hai! MielleShop adalah project toko online sederhana yang aku bikin buat belajar CodeIgniter 4. Konsepnya simpel tapi tetap niat — mulai dari kelola produk, kategori, sampai catat transaksi biar rasanya kayak jualan beneran 🛍️

Dibuat dengan sepenuh hati (dan beberapa cangkir kopi/boba di sela-sela ngoding) 🧋

---

## 🎀 Fitur-fitur

- 🛒 Kelola produk — tambah, edit, hapus, cek stok
- 🏷️ Kelola kategori produk biar rapi
- 💰 Catat transaksi/penjualan
- 🔐 Login & register buat user
- 👑 Role admin & kasir, jadi ada bedanya siapa boleh apa
- 📊 Dashboard kecil buat lihat ringkasan penjualan

---

## 🧸 Dibangun pakai

| Bagian | Teknologi |
|--------|-----------|
| Framework | CodeIgniter 4 |
| Bahasa | PHP 8.1+ |
| Database | MySQL / MariaDB |
| Tampilan | Bootstrap 5 |

---

## 🌷 Cara jalanin di lokal

1. Clone dulu repo-nya
   ```bash
   git clone https://github.com/username/mielleshop.git
   cd mielleshop
   ```

2. Install semua dependency-nya
   ```bash
   composer install
   ```

3. Copy file env, terus ganti nama jadi `.env`
   ```bash
   cp env .env
   ```

4. Atur koneksi database di `App/Config/Database.php`
   ```Database.php
   
   database.default.hostname = localhost
   database.default.database = db_mielleshop
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   ```

5. Bikin database baru namanya `mielleshop`, terus migrasi
   ```bash
   php spark migrate
   ```

6. Kalau mau ada data contoh, jalanin seeder
   ```bash
   php spark db:seed DatabaseSeeder
   ```

7. Nyalain server-nya
   ```bash
   php spark serve
   ```

8. Buka deh di browser 🌐
   ```
   http://localhost:8080
   ```

---

## 📁 Struktur folder

```
mielleshop/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   └── Database/
│       ├── Migrations/
│       └── Seeds/
├── public/
├── writable/
├── .env
└── composer.json
```

---

## 🎈 Lisensi

Project ini pakai lisensi MIT — bebas dipakai, tinggal cek file `LICENSE` ya.

---

<p align="center">made with 🩷 by Tasya</p>
