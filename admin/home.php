<?php
if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true) {
    $adminloggedin = true;
    $userId = $_SESSION['adminuserId'];
} else {
    $adminloggedin = false;
    $userId = 0;
}

if ($adminloggedin) {
    require 'partials/_dbconnect.php';

    // Query untuk mengambil jumlah total pesanan
    $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE orderStatus >= 1";
    $result_orders = mysqli_query($conn, $sql_orders);
    if (!$result_orders) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_orders = mysqli_fetch_assoc($result_orders);
    $total_orders = $row_orders['total_orders'];

    // Query untuk mengambil jumlah total pengguna
    $sql_users = "SELECT COUNT(*) AS total_users FROM users";
    $result_users = mysqli_query($conn, $sql_users);
    if (!$result_users) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_users = mysqli_fetch_assoc($result_users);
    $total_users = $row_users['total_users'];

    // Query untuk mengambil jumlah total item
    $sql_bouquet = "SELECT COUNT(*) AS total_bouquet FROM bouquet";
    $result_bouquet = mysqli_query($conn, $sql_bouquet);
    if (!$result_bouquet) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_bouquet = mysqli_fetch_assoc($result_bouquet);
    $total_bouquet = $row_bouquet['total_bouquet'];

    // Query untuk mengambil jumlah total kategori
    $sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
    $result_categories = mysqli_query($conn, $sql_categories);
    if (!$result_categories) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_categories = mysqli_fetch_assoc($result_categories);
    $total_categories = $row_categories['total_categories'];

    // Query untuk mengambil jumlah total kontak
    $sql_contact = "SELECT COUNT(*) AS total_contact FROM contact";
    $result_contact = mysqli_query($conn, $sql_contact);
    if (!$result_contact) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_contact = mysqli_fetch_assoc($result_contact);
    $total_contact = $row_contact['total_contact'];

    $today = date('Y-m-d'); // Mendapatkan tanggal hari ini
    $sql_daily_sales = "
        SELECT SUM(amount + IF(deliveryMethod = 'delivery', 15000, 0)) AS daily_sales 
        FROM orders 
        WHERE DATE(orderDate) = '$today' AND orderStatus >= 1";
    $result_daily_sales = mysqli_query($conn, $sql_daily_sales);
    if (!$result_daily_sales) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_daily_sales = mysqli_fetch_assoc($result_daily_sales);
    $daily_sales = $row_daily_sales['daily_sales'];

    $month = date('Y-m'); // Mendapatkan bulan dan tahun bulan ini
    $sql_monthly_sales = "
        SELECT SUM(amount + IF(deliveryMethod = 'delivery', 15000, 0)) AS monthly_sales 
        FROM orders 
        WHERE DATE_FORMAT(orderDate, '%Y-%m') = '$month' AND orderStatus >= 1";
    $result_monthly_sales = mysqli_query($conn, $sql_monthly_sales);
    if (!$result_monthly_sales) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_monthly_sales = mysqli_fetch_assoc($result_monthly_sales);
    $monthly_sales = $row_monthly_sales['monthly_sales'];

    $year = date('Y'); // Mendapatkan tahun ini
    $sql_yearly_sales = "
        SELECT SUM(amount + IF(deliveryMethod = 'delivery', 15000, 0)) AS yearly_sales 
        FROM orders 
        WHERE DATE_FORMAT(orderDate, '%Y') = '$year' AND orderStatus >= 1";
    $result_yearly_sales = mysqli_query($conn, $sql_yearly_sales);
    if (!$result_yearly_sales) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_yearly_sales = mysqli_fetch_assoc($result_yearly_sales);
    $yearly_sales = $row_yearly_sales['yearly_sales'];
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Page</title>
    <link rel="icon" href="/bouquetElviOnline/img/logo.png" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assetsForSideBar/css/styles.css">
</head>
<body id="body-pd" style="background: #80808045;">

    <?php
        require 'partials/_nav.php';
    ?>

    <div class="container-fluid mt-4">
        <div class="row" style="margin-top: 100px;">
            <div class="container-fluid mt-4">
                <div class="row" style="margin-top: 100px;">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-danger text-white">
                            <div class="card-header">
                                <h5 class="card-title">Daily Sales</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-text">Rp.<?php echo number_format($daily_sales, 2); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Sales</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-text">Rp.<?php echo number_format($monthly_sales, 2); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-header">
                                <h5 class="card-title">Yearly Sales</h5>
                            </div>
                            <div class="card-body">
                                <h3 class="card-text">Rp.<?php echo number_format($yearly_sales, 2); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-header">
                        <h5 class="card-title">Total Orders</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text"><?php echo $total_orders; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-header">
                        <h5 class="card-title">Total Users</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text"><?php echo $total_users; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-header">
                        <h5 class="card-title">Total Items</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text"><?php echo $total_bouquet; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-warning text-dark">
                    <div class="card-header">
                        <h5 class="card-title">Total Categories</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text"><?php echo $total_categories; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-white">
                    <div class="card-header">
                        <h5 class="card-title">Total Message</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text"><?php echo $total_contact; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="assetsForSideBar/js/main.js"></script>

</body>
</html>

<?php
} else {
    header("location: /bouquetElviOnline/admin/login.php");
}
?>
