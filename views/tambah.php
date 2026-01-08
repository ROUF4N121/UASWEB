<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Barang Baru</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Contoh: Laptop Asus">
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Aksesoris">Aksesoris</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Harga Beli (Rp)</label>
                            <input type="number" name="harga_beli" class="form-control" required placeholder="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Harga Jual (Rp)</label>
                            <input type="number" name="harga_jual" class="form-control" required placeholder="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Stok Awal</label>
                        <input type="number" name="stok" class="form-control" required placeholder="0">
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="home" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>