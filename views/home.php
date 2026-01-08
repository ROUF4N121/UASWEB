<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-primary">Daftar Barang</h5>
        
        <div class="d-flex gap-2">
            <a href="riwayat" class="btn btn-outline-info btn-sm">
                <i class="bi bi-clock-history"></i> Riwayat
            </a>

            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="tambah" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Barang
                </a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="card-body">
        <form action="home" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari nama barang..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = $start + 1;
                    if(isset($data_barang) && mysqli_num_rows($data_barang) > 0):
                        while($row = mysqli_fetch_assoc($data_barang)): 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= $row['nama']; ?></strong></td>
                        <td><span class="badge bg-secondary"><?= $row['kategori']; ?></span></td>
                        <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                        <td>
                            <?php if($row['stok'] > 0): ?>
                                <span class="badge bg-success"><?= $row['stok']; ?> unit</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                <a href="edit?id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus?id=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            
                            <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                                <?php if($row['stok'] > 0): ?>
                                    <a href="beli?id=<?= $row['id_barang']; ?>" class="btn btn-success btn-sm w-100">Beli</a>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm w-100" disabled>Habis</button>
                                <?php endif; ?>
                            <?php endif; ?>

                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <?php 
                $q = isset($_GET['q']) ? "&q=".$_GET['q'] : "";
                
                // Prev
                if($page > 1){
                    echo '<li class="page-item"><a class="page-link" href="home?page='.($page-1).$q.'">&laquo;</a></li>';
                } else {
                    echo '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
                }
                ?>

                <?php for($i = 1; $i <= $total_halaman; $i++): 
                    $active = ($page == $i) ? 'active' : '';
                ?>
                    <li class="page-item <?= $active; ?>">
                        <a class="page-link" href="home?page=<?= $i . $q; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php
                if($page < $total_halaman){
                    echo '<li class="page-item"><a class="page-link" href="home?page='.($page+1).$q.'">&raquo;</a></li>';
                } else {
                    echo '<li class="page-item disabled"><span class="page-link">&raquo;</span></li>';
                }
                ?>
            </ul>
        </nav>
        
        <div class="text-center text-muted" style="font-size: 12px;">
            Halaman <?= $page; ?> dari <?= $total_halaman; ?>
        </div>

    </div>
</div>