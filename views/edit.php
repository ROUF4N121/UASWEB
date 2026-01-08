<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Edit Data Barang</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data_barang['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="Elektronik" <?= ($data_barang['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                            <option value="Aksesoris" <?= ($data_barang['kategori'] == 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                            <option value="Pakaian" <?= ($data_barang['kategori'] == 'Pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                            <option value="Lainnya" <?= ($data_barang['kategori'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" value="<?= $data_barang['harga_beli']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" value="<?= $data_barang['harga_jual']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= $data_barang['stok']; ?>" required>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="home" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>