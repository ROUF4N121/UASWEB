<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Konfirmasi Pembelian</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Barang</label>
                        <input type="text" class="form-control" value="<?= $barang['nama']; ?>" readonly style="background-color: #f8f9fa;">
                    </div>
                    
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted">Harga Satuan</label>
                            <input type="text" class="form-control" value="Rp <?= number_format($barang['harga_jual'], 0, ',', '.'); ?>" readonly style="background-color: #f8f9fa;">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted">Stok Tersedia</label>
                            <input type="text" class="form-control" value="<?= $barang['stok']; ?>" readonly style="background-color: #f8f9fa;">
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Jumlah yang ingin dibeli</label>
                        <input type="number" name="jumlah" class="form-control form-control-lg" min="1" max="<?= $barang['stok']; ?>" required placeholder="Masukkan jumlah...">
                        <div class="form-text">Maksimal pembelian: <?= $barang['stok']; ?> item.</div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="proses_beli" class="btn btn-success btn-lg">Beli Sekarang</button>
                        <a href="home" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>