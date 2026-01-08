<?php
class Barang {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    public function getAll($keyword = null, $start = 0, $limit = 5) {
        $sql = "SELECT * FROM data_barang";
        if ($keyword) {
            $sql .= " WHERE nama LIKE '%$keyword%'";
        }
        $sql .= " LIMIT $start, $limit";
        return mysqli_query($this->db, $sql);
    }

    public function countAll($keyword = null) {
        $sql = "SELECT COUNT(*) as total FROM data_barang";
        if ($keyword) {
            $sql .= " WHERE nama LIKE '%$keyword%'";
        }
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    // --- FUNGSI BARU DI BAWAH INI ---

    // 1. Ambil 1 data berdasarkan ID (Untuk Edit)
    public function getById($id) {
        $query = mysqli_query($this->db, "SELECT * FROM data_barang WHERE id_barang='$id'");
        return mysqli_fetch_assoc($query);
    }

    // 2. Simpan Data Baru
    public function tambah($data) {
        $nama = $data['nama'];
        $kategori = $data['kategori'];
        $jual = $data['harga_jual'];
        $beli = $data['harga_beli'];
        $stok = $data['stok'];

        $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok) 
                VALUES ('$nama', '$kategori', '$jual', '$beli', '$stok')";
        return mysqli_query($this->db, $sql);
    }

    // 3. Update Data Lama
    public function ubah($data, $id) {
        $nama = $data['nama'];
        $kategori = $data['kategori'];
        $jual = $data['harga_jual'];
        $beli = $data['harga_beli'];
        $stok = $data['stok'];

        $sql = "UPDATE data_barang SET 
                nama='$nama', kategori='$kategori', 
                harga_jual='$jual', harga_beli='$beli', stok='$stok' 
                WHERE id_barang='$id'";
        return mysqli_query($this->db, $sql);
    }

    // 4. Hapus Data
    public function hapus($id) {
        $sql = "DELETE FROM data_barang WHERE id_barang='$id'";
        return mysqli_query($this->db, $sql);
    }
}
?>