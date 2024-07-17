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
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #748B6F;">
    <style>
        /* CSS untuk navbar */
        .navbar-dark .navbar-nav .nav-link:hover {
            background-color: #ffffff; /* Warna ungu yang lebih gelap */
        }
        .navbar-dark .navbar-nav .nav-link {
            color: white; /* Warna teks hitam */
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #748B6F; /* Warna teks putih saat hover */
        }
        .navbar-brand, .navbar-toggler-icon {
            color: white; /* Warna teks dan ikon navbar */
        }
        .navbar-toggler {
            border-color: white; /* Warna border toggler */
        }
        .navbar-dark .navbar-nav .nav-item.active .nav-link,
        .navbar-dark .navbar-nav .nav-link {
            color: white; /* Warna teks hitam */
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #748B6F; /* Warna teks putih saat hover */
            border-radius: 50px;
        }

        /* CSS untuk form pencarian */
        .btn-outline-success {
            color: #000000; /* Warna teks default */
            border-color: #C3CBD6; /* Warna border default */
        }
        .btn-outline-success:hover {
            color: #ffffff; /* Warna teks saat hover */
            background-color: #748B6F; /* Warna latar belakang saat hover */
            border-color: #748B6F; /* Warna border saat hover */
        }
        .btn-outline-success:focus {
            box-shadow: 0 0 0 0.2rem #2A403D; /* Efek focus saat tombol ditekan */
        }

        /* Penyesuaian dropdown */
        .dropdown-menu-right {
            right: 0;
            left: auto;
        }
        
    </style>
    <a class="navbar-brand" style="color: white" href="index.php"><b>Elvi Bouquet</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Bouquet</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php while($row = mysqli_fetch_assoc($categoriesResult)): ?>
                        <a class="dropdown-item" href="viewBouquetList.php?catid=<?= $row['categorieId'] ?>"><?= $row['categorieName'] ?></a>
                    <?php endwhile; ?>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="viewOrder.php">Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        </ul>
        <!-- Form pencarian dalam collapse navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form method="get" action="/bouquetElviOnline/search.php" class="form-inline my-2 my-lg-0 ml-auto">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" id="search" placeholder="Search" aria-label="Search" required>
                    <div class="input-group-append">
                        <button class="btn btn" type="submit">
                            <i class="fas fa-search"style="color: white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <a href="viewCart.php" class="text-decoration-none text-dark mx-2" style="color: white;">
    <i class="fas fa-shopping-cart" style="color: white; "> ( <?= $count ?> )</i> 
</a>


<!-- Tautan untuk Navbar -->
<?php if ($loggedin): ?>
    <!-- Jika sudah login, tampilkan dropdown menu profil -->
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                <!-- <img src="img/person-<?= $userId ?>.jpg" class="rounded-circle" onError="this.src = 'img/profilePic.jpg'" style="width:30px; height:30px; margin-right: 5px;"> -->
                <?= $username ?>
            </a>    
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="viewProfile.php">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <a class="dropdown-item text-danger" href="partials/_logout.php">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
<?php else: ?>
    <!-- Jika belum login, tampilkan tautan ke halaman login -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="login.php">
                <i class="fas fa-user mr-1"></i> Login
            </a>
        </li>
    </ul>
<?php endif; ?>

    </div>
</nav>

<?php include 'partials/_loginModal.php'; ?>
<?php include 'partials/_signupModal.php'; ?>
