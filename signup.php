<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Elvi Bouquet</title>
    <!-- Tambahkan link ke CSS framework (misalnya Bootstrap) atau tambahkan CSS kustom Anda -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan link ke Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Gaya kustom Anda -->
    <style>
        /* CSS untuk form sign-up */
        .container {
            
            margin: auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-column-gap: 20px;
        }
        .signup-form h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .left-content {
           
            padding: 20px;
        }
        .left-content h2 {
            color: #333;
        }
    </style>
</head>
<body>
<?php include 'partials/_dbconnect.php';?>
<?php require 'partials/_nav.php' ?>
    <div class="container">
        <div class="left-content">
            <!-- Isi dengan konten apa pun yang Anda inginkan di sebelah kiri -->
            <h2>Welcome to Elvi Bouquet!</h2>
            <p>Join us and start your floral journey with us today.</p>
        </div>
        <div>
            <h2 class="text-center">Sign Up</h2>
            <?php if (isset($signupError)): ?>
                <div class="alert alert-danger"><?= $signupError ?></div>
            <?php endif; ?>
            <form action="partials/_handleSignup.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username" class="font-weight-bold">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Choose a unique Username" required minlength="3" maxlength="11">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName" class="font-weight-bold">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName" class="font-weight-bold">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="font-weight-bold">Phone No</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">+62</span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{10}" maxlength="10">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required minlength="4" maxlength="21">
                </div>
                <div class="form-group">
                    <label for="cpassword" class="font-weight-bold">Re-enter Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter Password" required minlength="4" maxlength="21">
                </div>
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
            <p class="text-center mb-0 mt-3">Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </div>
<?php require 'partials/_footer.php' ?>
</body>
</html>
