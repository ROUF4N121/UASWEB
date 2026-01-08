<?php
class Transaksi {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    // Fungsi Pembelian: Simpan Transaksi & Kurangi Stok
    public function beliBarang($id_user, $id_barang, $jumlah, $total_harga) {
        // 1. Kurangi Stok Barang
        $updateStok = "UPDATE data_barang SET stok = stok - $jumlah WHERE id_barang = $id_barang";
        mysqli_query($this->db, $updateStok);

        // 2. Simpan Transaksi
        $sql = "INSERT INTO transaksi (id_user, id_barang, jumlah, total_harga) 
                VALUES ('$id_user', '$id_barang', '$jumlah', '$total_harga')";
        return mysqli_query($this->db, $sql);
    }

    // Fungsi Lihat Riwayat per User (Untuk User Biasa)
    public function getHistory($id_user) {
        $sql = "SELECT t.*, b.nama, b.harga_jual 
                FROM transaksi t 
                JOIN data_barang b ON t.id_barang = b.id_barang 
                WHERE t.id_user = '$id_user' 
                ORDER BY t.tanggal DESC";
        return mysqli_query($this->db, $sql);
    }

    // Fungsi Lihat Semua Transaksi (Untuk Admin)
    public function getAllHistory() {
        // PERBAIKAN DISINI: Mengganti u.nama_lengkap menjadi u.username
        $sql = "SELECT t.*, u.username, b.nama 
                FROM transaksi t 
                JOIN users u ON t.id_user = u.id 
                JOIN data_barang b ON t.id_barang = b.id_barang 
                ORDER BY t.tanggal DESC";
        return mysqli_query($this->db, $sql);
    }
}
?>