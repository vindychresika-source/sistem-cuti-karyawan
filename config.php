<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    $db = new PDO('sqlite:' . __DIR__ . '/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Cek migrasi - jika tabel users masih menggunakan kolom 'username', hapus tabel lama dan buat ulang.
    $table_exists = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")->fetch();
    if ($table_exists) {
        $schema_check = $db->query("PRAGMA table_info(users)")->fetchAll();
        $has_email = false;
        foreach ($schema_check as $col) {
            if ($col['name'] === 'email') {
                $has_email = true;
                break;
            }
        }
        if (!$has_email) {
            $db->exec("DROP TABLE IF EXISTS cuti");
            $db->exec("DROP TABLE IF EXISTS users");
        }
    }

    // Buat Tabel Pengguna jika belum ada
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE,
        password TEXT,
        nama TEXT,
        role TEXT,
        jabatan TEXT,
        kuota_cuti INTEGER DEFAULT 12,
        foto TEXT DEFAULT ''
    )");

    // Buat Tabel Cuti jika belum ada
    $db->exec("CREATE TABLE IF NOT EXISTS cuti (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        jenis_cuti TEXT,
        tanggal_mulai TEXT,
        tanggal_selesai TEXT,
        jumlah_hari INTEGER,
        alasan TEXT,
        lampiran TEXT DEFAULT '',
        status TEXT DEFAULT 'Pending',
        catatan_admin TEXT DEFAULT '',
        tanggal_pengajuan TEXT,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");

    // Cek apakah data dummy sudah ada, jika kosong maka isi
    $check = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($check == 0) {
        // Password di-hash menggunakan PASSWORD_DEFAULT
        $passAdmin = password_hash('admin123', PASSWORD_DEFAULT);
        $passKaryawan = password_hash('karyawan123', PASSWORD_DEFAULT);

        // Tambah User Dummy dengan avatar inisial
        $db->exec("INSERT INTO users (email, password, nama, role, jabatan, kuota_cuti, foto) VALUES 
            ('admin@perusahaan.com', '$passAdmin', 'Praditya Admin Utama', 'Admin', 'HR Manager', 0, ''),
            ('budi@perusahaan.com', '$passKaryawan', 'Budi Setiawan', 'Karyawan', 'Software Engineer', 12, ''),
            ('siti@perusahaan.com', '$passKaryawan', 'Siti Rahma', 'Karyawan', 'UI/UX Designer', 12, '')");
            
        // Data dummy pengajuan cuti dengan format baru
        $db->exec("INSERT INTO cuti (user_id, jenis_cuti, tanggal_mulai, tanggal_selesai, jumlah_hari, alasan, lampiran, status, catatan_admin, tanggal_pengajuan) VALUES 
            (2, 'Cuti Tahunan', '2026-07-01', '2026-07-03', 3, 'Acara keluarga di luar kota', '', 'Pending', '', '2026-06-24'),
            (3, 'Sakit', '2026-06-10', '2026-06-11', 2, 'Demam tinggi disertai flu', 'surat_sakit_siti.pdf', 'Disetujui', 'Lekas sembuh', '2026-06-09'),
            (2, 'Izin Penting', '2026-06-15', '2026-06-15', 1, 'Mengurus administrasi kependudukan', '', 'Ditolak', 'Mohon diajukan di hari lain karena rilis penting', '2026-06-12')");
    }

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

function cekLogin($role_wajib) {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
    if ($_SESSION['user']['role'] !== $role_wajib) {
        die("Akses Ditolak: Anda tidak memiliki otoritas ke halaman ini.");
    }
}
?>