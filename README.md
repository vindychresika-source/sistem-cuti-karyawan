# Sistem Cuti Karyawan

## Identitas

**Nama:** Vindy Chresika
**NIM:** 14022400041
**Mata Kuliah:** Konsep dan Perancangan E-Business (4A-INF)
**Dosen Pengampu:** Gagah Dwiki Putra Aryono, S.Kom, M.T.I

---

## Deskripsi Project

Sistem Cuti Karyawan merupakan aplikasi berbasis web yang digunakan untuk mengelola pengajuan cuti karyawan secara digital. Aplikasi ini memungkinkan karyawan mengajukan cuti, melihat status pengajuan, serta membantu admin dalam melakukan pengelolaan data dan persetujuan cuti.

---

## Fitur Utama

### Admin

* Login admin
* Melihat daftar pengajuan cuti
* Menyetujui pengajuan cuti
* Menolak pengajuan cuti
* Mengelola data karyawan
* Dashboard admin

### Karyawan

* Login karyawan
* Mengajukan cuti
* Melihat riwayat pengajuan cuti
* Melihat status pengajuan cuti
* Dashboard karyawan

---

## Teknologi yang Digunakan

* PHP
* HTML
* CSS
* JavaScript
* SQLite Database

---

## Struktur Project

```text
sistem-cuti/
│
├── admin_dashboard.php
├── karyawan_dashboard.php
├── login.php
├── config.php
├── database.db
├── package.json
├── uploads/
└── file lainnya
```

---

## Cara Menjalankan Project

### Persyaratan

* PHP 8.x atau versi yang kompatibel
* Web Browser (Chrome, Edge, Firefox)
* SQLite

### Menjalankan Menggunakan PHP Built-in Server

Buka terminal atau command prompt pada folder project, kemudian jalankan:

```bash
php -S localhost:8000
```

Setelah server berjalan, buka browser dan akses:

```text
http://localhost:8000
```

### Menjalankan Menggunakan XAMPP

1. Install XAMPP.
2. Jalankan Apache.
3. Letakkan folder project di lokasi yang diinginkan.
4. Buka terminal pada folder project.
5. Jalankan server PHP:

```bash
php -S localhost:8000
```

6. Buka browser dan akses:

```text
http://localhost:8000
```

---

## Database

Project menggunakan database SQLite dengan file:

```text
database.db
```

Pastikan file database berada pada folder utama project agar aplikasi dapat berjalan dengan baik.

---

## Cara Mengakses Sistem

1. Jalankan aplikasi.
2. Buka halaman login.
3. Login menggunakan akun yang telah tersedia pada database.
4. Gunakan fitur sesuai hak akses (Admin atau Karyawan).

---

## Repository GitHub

Repository GitHub digunakan untuk menyimpan source code project dan memudahkan proses pengumpulan tugas serta evaluasi oleh dosen.

---

## Lisensi

Project ini dibuat untuk keperluan pembelajaran dan tugas perkuliahan.
