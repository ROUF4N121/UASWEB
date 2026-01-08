<?php
session_start();

// Aktifkan Error Reporting untuk memudahkan debugging jika ada masalah
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Panggil File Konfigurasi dan Model
require_once 'config/database.php';
require_once 'models/Barang.php';
require_once 'models/Transaksi.php';

// Inisialisasi Objek Database dan Model
$db = new Database();
$barangModel = new Barang($db->conn);
$transaksiModel = new Transaksi($db->conn);

// Routing Sederhana (Default ke halaman 'home')
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// --- CEK LOGIN ---
// Jika user belum login dan mencoba akses halaman selain 'login', paksa ke login.
if ($url != 'login' && !isset($_SESSION['user_session'])) {
    header('Location: login');
    exit;
}

// --- SWITCH CASE CONTROLLER ---
switch ($url) {

    // 1. LOGIKA LOGIN
    case 'login':
        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($db->conn, $_POST['username']);
            $password = md5($_POST['password']); 

            $query = mysqli_query($db->conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
            if (mysqli_num_rows($query) > 0) {
                $data = mysqli_fetch_assoc($query);
                // Simpan data penting ke SESSION
                $_SESSION['user_session'] = $data['username'];
                $_SESSION['user_id'] = $data['id']; 
                $_SESSION['role'] = $data['role']; 
                header('Location: home');
            } else {
                $error = "Username atau Password salah!";
            }
        }
        include 'views/login.php';
        break;

    // 2. LOGIKA LOGOUT
    case 'logout':
        session_destroy();
        header('Location: login');
        exit;

    // 3. LOGIKA TAMBAH BARANG (KHUSUS ADMIN)
    case 'tambah':
        if ($_SESSION['role'] != 'admin') { header('Location: home'); exit; }

        if (isset($_POST['simpan'])) {
            if ($barangModel->tambah($_POST)) {
                echo "<script>alert('Barang berhasil ditambahkan!'); window.location='home';</script>";
            } else {
                echo "<script>alert('Gagal menambah barang!');</script>";
            }
        }
        include 'views/header.php';
        include 'views/tambah.php';
        include 'views/footer.php';
        break;

    // 4. LOGIKA EDIT BARANG (KHUSUS ADMIN)
    case 'edit':
        if ($_SESSION['role'] != 'admin') { header('Location: home'); exit; }

        $id = $_GET['id'];
        $data_barang = $barangModel->getById($id); // Ambil data lama untuk ditampilkan di form

        if (isset($_POST['update'])) {
            if ($barangModel->ubah($_POST, $id)) {
                echo "<script>alert('Data berhasil diupdate!'); window.location='home';</script>";
            } else {
                echo "<script>alert('Gagal update data!');</script>";
            }
        }
        include 'views/header.php';
        include 'views/edit.php';
        include 'views/footer.php';
        break;

    // 5. LOGIKA HAPUS BARANG (KHUSUS ADMIN)
    case 'hapus':
        if ($_SESSION['role'] != 'admin') { header('Location: home'); exit; }

        $id = $_GET['id'];
        if ($barangModel->hapus($id)) {
            echo "<script>alert('Data berhasil dihapus!'); window.location='home';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!'); window.location='home';</script>";
        }
        break;

    // 6. LOGIKA BELI BARANG (KHUSUS USER)
    case 'beli':
        if ($_SESSION['role'] != 'user') { 
            echo "<script>alert('Hanya User yang bisa membeli!'); window.location='home';</script>";
            exit;
        }

        $id_barang = $_GET['id'];
        $barang = $barangModel->getById($id_barang); // Ambil info barang

        if (isset($_POST['proses_beli'])) {
            $jumlah = $_POST['jumlah'];
            $total_harga = $barang['harga_jual'] * $jumlah;
            $id_user = $_SESSION['user_id'];

            // Validasi Stok
            if ($jumlah <= $barang['stok']) {
                if ($transaksiModel->beliBarang($id_user, $id_barang, $jumlah, $total_harga)) {
                    echo "<script>alert('Pembelian Berhasil!'); window.location='riwayat';</script>";
                } else {
                    echo "<script>alert('Transaksi Gagal!');</script>";
                }
            } else {
                echo "<script>alert('Stok tidak mencukupi!');</script>";
            }
        }
        include 'views/header.php';
        include 'views/beli.php';
        include 'views/footer.php';
        break;

    // 7. LOGIKA RIWAYAT TRANSAKSI
    case 'riwayat':
        // Admin lihat semua, User lihat punya sendiri
        if ($_SESSION['role'] == 'admin') {
            $data_transaksi = $transaksiModel->getAllHistory(); 
        } else {
            $id_user = $_SESSION['user_id'];
            $data_transaksi = $transaksiModel->getHistory($id_user); 
        }
        include 'views/header.php';
        include 'views/riwayat.php';
        include 'views/footer.php';
        break;

    // 8. LOGIKA HOME (UTAMA)
    case 'home':
    default:
        // Ambil parameter page dan search
        $keyword = isset($_GET['q']) ? $_GET['q'] : null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // --- PENGATURAN LIMIT ---
        // Biarkan 2 agar pagination muncul saat data sedikit. Ubah ke 5 atau 10 nanti.
        $limit = 2; 
        
        $start = ($page > 1) ? ($page * $limit) - $limit : 0;

        // Panggil Model
        $data_barang = $barangModel->getAll($keyword, $start, $limit);
        $total_data = $barangModel->countAll($keyword);
        $total_halaman = ceil($total_data / $limit);

        include 'views/header.php';
        include 'views/home.php';
        include 'views/footer.php';
        break;
}
?>