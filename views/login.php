<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f0f2f5; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            margin: 0;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 15px;
        }
        .login-header {
            background: #0d6efd;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="card shadow-lg login-card">
        <div class="login-header">
            <h4 class="mb-0 fw-bold">Login</h4>
            <small>NiceDeals Store</small>
        </div>
        
        <div class="card-body p-4">
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="login">
                <div class="mb-3">
                    <label for="username" class="form-label text-muted">Username</label>
                    <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Masukkan username" required autofocus>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label text-muted">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" name="login" class="btn btn-primary btn-lg fw-bold">Masuk</button>
                </div>
            </form>

            <hr class="my-4">

            <div class="alert alert-info text-center mb-0" style="font-size: 0.9rem;">
                <strong>Info Akun Demo:</strong><br>
                <div class="mt-2">
                    <span class="badge bg-primary">Admin</span> : <code>admin</code> / <code>admin123</code>
                </div>
                <div class="mt-1">
                    <span class="badge bg-success">User</span> : <code>user</code> / <code>user123</code>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>