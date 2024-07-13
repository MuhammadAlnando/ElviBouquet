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
        .container {
            max-width: 1000px; /* Lebar maksimum container */
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-column-gap: 20px;
        }
        .login-form {
            background: #fff;
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
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>
    <div class="container">
        <div>
            <!-- Bagian kiri kosong -->
            <h2>Welcome to Elvi Bouquet!</h2>
            <p>Join us and start your floral journey with us today.</p>
        </div>
        <div class="login-form">
            <!-- Bagian kanan dengan form login -->
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
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
            <p class="text-center mb-0">Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </div>
    </div>
    <?php require 'partials/_footer.php' ?>
</body>
</html>
