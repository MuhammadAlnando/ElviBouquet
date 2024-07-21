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
        body, html {
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }
        .content {
            text-align: center;
            max-width: 700px;
            padding: 20px;
        }
        .login-form {
            width: 100%;
            padding: 30px;
            border-radius: 8px;
            background: white;
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 50px;
        }
        .btn-primary {
            height: 50px;
            background-color: #2A403D;
            border: none;
            color: white;
            width:350px;
            margin-right: 10px;
        }
        .btn-primary:hover {
           
            background-color: #2A403D;
         
            color: white;
        }
        .btn-admin {
            height: 50px;
            background-color: white;
            border: 1px solid #2A403D;
            color: #2A403D;
            
            
        }
        .btn-admin:hover {
            background-color: #2A403D;
            color: white;
        }
        .login-link {
            color: #2A403D;
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
                        
                    </div>
                    <div class="d-flex">
                    <div class="form-group mt-3">
    <button type="submit" class="btn btn-primary">Login</button>
    </div>
    <div class="form-group mt-3 me-2">
        <a href="admin/login.php" class="btn btn-admin">
            <i class="fa fa-user-shield" style="margin-top: 10px;"></i>
        </a>
    </div>
    
</div>

                </form>
                <p class="text-center mb-0">Don't have an account? <a href="signup.php" class="login-link">Sign up now</a>.</p>
                
            </div>
        </div>
        
    </div>

    <?php require 'partials/_footer.php'; ?>
</body>
</html>
