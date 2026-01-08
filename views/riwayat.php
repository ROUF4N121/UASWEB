<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Riwayat Transaksi</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <th>User (Pembeli)</th>
                        <?php endif; ?>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if (isset($data_transaksi) && mysqli_num_rows($data_transaksi) > 0):
                        while($row = mysqli_fetch_assoc($data_transaksi)): 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
                        
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <td class="fw-bold text-primary"><?= $row['username']; ?></td>
                        <?php endif; ?>

                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jumlah']; ?> Unit</td>
                        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td><span class="badge bg-success">Berhasil</span></td>
                    </tr>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                    <tr>
                        <td colspan="<?= ($_SESSION['role'] == 'admin') ? 7 : 6; ?>" class="text-center py-4">
                            Belum ada riwayat transaksi.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <a href="home" class="btn btn-primary mt-3">Kembali ke Home</a>
    </div>
</div>