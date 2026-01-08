<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card { border: none; border-radius: 10px; }
        .card-header { border-radius: 10px 10px 0 0 !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="home">
                <i class="bi bi-box-seam"></i> NiceDeals Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home">Home</a>
                    </li>
                    
                    <?php if(isset($_SESSION['user_session'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="riwayat">
                            Riwayat Transaksi
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if(isset($_SESSION['user_session'])): ?>
                        <span class="navbar-text text-white me-3 d-none d-lg-block">
                            Halo, <strong><?= $_SESSION['user_session']; ?></strong> 
                            (<?= ucfirst($_SESSION['role']); ?>)
                        </span>
                        <a href="logout" class="btn btn-danger btn-sm text-white border-0 shadow-sm">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="login" class="btn btn-light btn-sm fw-bold">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container pb-5">