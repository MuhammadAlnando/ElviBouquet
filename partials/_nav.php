  <?php 
  session_start();
  $loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
  $userId = $loggedin ? $_SESSION['userId'] : 0;
  $username = $loggedin ? $_SESSION['username'] : '';

  $sql = "SELECT * FROM `sitedetail`";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $systemName = $row['systemName'];

  $categoriesSql = "SELECT categorieName, categorieId FROM `categories`"; 
  $categoriesResult = mysqli_query($conn, $categoriesSql);

  $countSql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
  $countResult = mysqli_query($conn, $countSql);
  $countRow = mysqli_fetch_assoc($countResult);      
  $count = $countRow['SUM(`itemQuantity`)'] ?? 0;

  ?>

  <!-- Tambahkan link ke Font Awesome di bagian <head> dokumen HTML Anda -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #DCC0FF;">
    <style>
        /* CSS untuk navbar */
        .navbar-dark .navbar-nav .nav-link:hover {
            background-color: #BAA8E0; /* Warna ungu yang lebih gelap */
        }
        .navbar-dark .navbar-nav .nav-link {
            color: #000000; /* Warna teks hitam */
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffffff; /* Warna teks putih saat hover */
        }
        .navbar-brand, .navbar-toggler-icon {
            color: #000000; /* Warna teks dan ikon navbar */
        }
        .navbar-toggler {
            border-color: #000000; /* Warna border toggler */
        }
        .navbar-dark .navbar-nav .nav-item.active .nav-link,
.navbar-dark .navbar-nav .nav-link {
    color: #000000; /* Warna teks hitam */
}

.navbar-dark .navbar-nav .nav-link:hover {
    color: #ffffff; /* Warna teks putih saat hover */
}

    </style>
    <a class="navbar-brand" href="index.php"><?= $systemName ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Bouquet</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php while($row = mysqli_fetch_assoc($categoriesResult)): ?>
                        <a class="dropdown-item" href="viewPizzaList.php?catid=<?= $row['categorieId'] ?>"><?= $row['categorieName'] ?></a>
                    <?php endwhile; ?>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="viewOrder.php">Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        </ul>
        <form method="get" action="/OnlinePizzaDelivery/search.php" class="form-inline my-2 my-lg-0 mx-3">
            <style>
                /* CSS untuk form pencarian */
                .btn-outline-success {
                    color: #000000; /* Warna teks default */
                    border-color: #BAA8E0; /* Warna border default */
                }
                .btn-outline-success:hover {
                    color: #ffffff; /* Warna teks saat hover */
                    background-color: #6F42C1; /* Warna latar belakang saat hover */
                    border-color: #6F42C1; /* Warna border saat hover */
                }
                .btn-outline-success:focus {
                    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.5); /* Efek focus saat tombol ditekan */
                }
            </style>
            <div class="input-group">
                <input class="form-control" type="search" name="search" id="search" placeholder="Search" aria-label="Search" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="viewCart.php">
            <button type="button" class="btn btn-secondary mx-2" title="MyCart">
                <i class="fas fa-shopping-cart"></i>(<?= $count ?>)
            </button>
        </a>

        <?php if ($loggedin): ?>
            <ul class="navbar-nav mr-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <img src="img/person-<?= $userId ?>.jpg" class="rounded-circle" onError="this.src = 'img/profilePic.jpg'" style="width:40px; height:40px">
                    </a>    
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="viewProfile.php">Profil  </a>
                        <a class="dropdown-item" href="partials/_logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="text-center image-size-small position-relative">
                <!-- Konten di sini -->
            </div>
        <?php else: ?>
            <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#loginModal">Login</button>
            <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#signupModal">SignUp</button>
        <?php endif; ?>
    </div>
</nav>


<?php include 'partials/_loginModal.php'; ?>
<?php include 'partials/_signupModal.php'; ?>

<?php if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You can now login.
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
    </div>
<?php elseif (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
    </div>
<?php elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
    </div>
<?php elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Invalid Credentials
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
    </div>
<?php endif; ?>
