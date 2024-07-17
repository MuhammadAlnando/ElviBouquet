<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Elvi Bouquet</title>
    <!-- Tambahkan link ke CSS framework (misalnya Bootstrap) atau tambahkan CSS kustom Anda -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan link ke Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Gaya kustom Anda -->
    <style>
        /* CSS untuk form login */
        body, html {
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Menggunakan viewport height untuk mengisi tinggi layar */
            background-color: #f8f9fa; /* Warna latar belakang untuk contoh */
        }
        .content {
            text-align: center;
            max-width: 600px; /* Lebar maksimum konten */
            padding: 20px;
        }
        .login-form {
            width: 400px;
            padding: 30px;
            border-radius: 8px;
        }
        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 50px; /* Tinggi input field */
        }
        .btn-primary {
            height: 50px; /* Tinggi tombol login */
        }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php require 'partials/_nav.php'; ?>
    
    <div class="container">
        <div class="content">
            <h2>Welcome to Elvi Bouquet!</h2>
            
            <div class="login-form">
                <h2>Login</h2>
            <?php if (isset($loginError)): ?>
                <div class="alert alert-danger"><?= $loginError ?></div>
            <?php endif; ?>
            <form action="partials/_handleLogin.php" method="post">
                <div class="form-group">
                    <input type="text" name="loginusername" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="loginpassword" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #748B6F; border:none; color: white;">Login</button>
                </div>
            </form>
            <p class="text-center mb-0">Don't have an account? <a href="signup.php" style="color: #748B6F;">Sign up now</a>.</p>
            </div>
        </div>
    </div>
    
    <?php require 'partials/_footer.php'; ?>
</body>
</html>
