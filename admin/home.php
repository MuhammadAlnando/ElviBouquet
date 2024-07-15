<?php 
    
    if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
        $adminloggedin= true;
        $userId = $_SESSION['adminuserId'];
    }
    else{
        $adminloggedin = false;
        $userId = 0;
    }

    if($adminloggedin) {
        require 'partials/_dbconnect.php';
        
        // Query untuk mengambil jumlah total pesanan
        $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders";
        $result_orders = mysqli_query($conn, $sql_orders);
        $row_orders = mysqli_fetch_assoc($result_orders);
        $total_orders = $row_orders['total_orders'];

        // Query untuk mengambil jumlah total pengguna
        $sql_users = "SELECT COUNT(*) AS total_users FROM users";
        $result_users = mysqli_query($conn, $sql_users);
        $row_users = mysqli_fetch_assoc($result_users);
        $total_users = $row_users['total_users'];

        // Query untuk mengambil jumlah total item
$sql_pizza = "SELECT COUNT(*) AS total_pizza FROM pizza";
$result_pizza = mysqli_query($conn, $sql_pizza);
$row_pizza = mysqli_fetch_assoc($result_pizza);
$total_pizza = $row_pizza['total_pizza'];

// Query untuk mengambil jumlah total kategori
$sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
$result_categories = mysqli_query($conn, $sql_categories);
$row_categories = mysqli_fetch_assoc($result_categories);
$total_categories = $row_categories['total_categories'];

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Page</title>
    <link rel="icon" href="/OnlinePizzaDelivery/img/logo.jpg" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assetsForSideBar/css/styles.css">
</head>
<body id="body-pd" style="background: #80808045;">

    <?php
        require 'partials/_nav.php';

        if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%">
                    <strong>Success!</strong> You are logged in
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
                  </div>';
        }
    ?>

<div class="container-fluid mt-4">
    <div class="row" style="margin-top: 100px;">
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
                    <h3 class="card-text"><?php echo $total_pizza; ?></h3>
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
    }
    else{
        header("location: /OnlinePizzaDelivery/admin/login.php");
    }
?>
