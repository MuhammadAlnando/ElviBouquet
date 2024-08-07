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

    // Query to get the total number of orders
    $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE orderStatus >= 1";
    $result_orders = mysqli_query($conn, $sql_orders);
    if (!$result_orders) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_orders = mysqli_fetch_assoc($result_orders);
    $total_orders = $row_orders['total_orders'] ?? 0;

    // Query to get the total number of users
    $sql_users = "SELECT COUNT(*) AS total_users FROM users";
    $result_users = mysqli_query($conn, $sql_users);
    if (!$result_users) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_users = mysqli_fetch_assoc($result_users);
    $total_users = $row_users['total_users'] ?? 0;

    // Query to get the total number of items
    $sql_bouquet = "SELECT COUNT(*) AS total_bouquet FROM bouquet";
    $result_bouquet = mysqli_query($conn, $sql_bouquet);
    if (!$result_bouquet) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_bouquet = mysqli_fetch_assoc($result_bouquet);
    $total_bouquet = $row_bouquet['total_bouquet'] ?? 0;

    // Query to get the total number of categories
    $sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
    $result_categories = mysqli_query($conn, $sql_categories);
    if (!$result_categories) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_categories = mysqli_fetch_assoc($result_categories);
    $total_categories = $row_categories['total_categories'] ?? 0;

    // Query to get the total number of contacts
    $sql_contact = "SELECT COUNT(*) AS total_contact FROM contact";
    $result_contact = mysqli_query($conn, $sql_contact);
    if (!$result_contact) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_contact = mysqli_fetch_assoc($result_contact);
    $total_contact = $row_contact['total_contact'] ?? 0;

    $today = date('Y-m-d'); // Get today's date
    $sql_daily_sales = "
        SELECT SUM(amount + 
            CASE
                WHEN deliveryMethod = 'deliverybatamkota' THEN 20000
                WHEN deliveryMethod = 'deliverybatuaji' THEN 20000
                WHEN deliveryMethod = 'deliverybatuampar' THEN 15000
                WHEN deliveryMethod = 'deliverybengkong' THEN 15000
                WHEN deliveryMethod = 'deliverylubukbaja' THEN 15000
                WHEN deliveryMethod = 'deliverynongsa' THEN 25000
                WHEN deliveryMethod = 'deliverysagulung' THEN 20000
                WHEN deliveryMethod = 'deliveryseibeduk' THEN 20000
                WHEN deliveryMethod = 'deliverysekupang' THEN 10000
                ELSE 0
            END
        ) AS daily_sales 
        FROM orders 
        WHERE DATE(orderDate) = '$today' 
        AND orderStatus IN (2, 3, 4, 5)";
    $result_daily_sales = mysqli_query($conn, $sql_daily_sales);
    if (!$result_daily_sales) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_daily_sales = mysqli_fetch_assoc($result_daily_sales);
    $daily_sales = $row_daily_sales['daily_sales'] ?? 0;

    $month = date('Y-m'); // Get current month and year
    $sql_monthly_sales = "
        SELECT SUM(amount + 
            CASE
                WHEN deliveryMethod = 'deliverybatamkota' THEN 20000
                WHEN deliveryMethod = 'deliverybatuaji' THEN 20000
                WHEN deliveryMethod = 'deliverybatuampar' THEN 15000
                WHEN deliveryMethod = 'deliverybengkong' THEN 15000
                WHEN deliveryMethod = 'deliverylubukbaja' THEN 15000
                WHEN deliveryMethod = 'deliverynongsa' THEN 25000
                WHEN deliveryMethod = 'deliverysagulung' THEN 20000
                WHEN deliveryMethod = 'deliveryseibeduk' THEN 20000
                WHEN deliveryMethod = 'deliverysekupang' THEN 10000
                ELSE 0
            END
        ) AS monthly_sales 
        FROM orders 
        WHERE DATE_FORMAT(orderDate, '%Y-%m') = '$month' 
        AND orderStatus IN (2, 3, 4, 5)";
    $result_monthly_sales = mysqli_query($conn, $sql_monthly_sales);
    if (!$result_monthly_sales) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_monthly_sales = mysqli_fetch_assoc($result_monthly_sales);
    $monthly_sales = $row_monthly_sales['monthly_sales'] ?? 0;

    $year = date('Y'); // Get current year
    $sql_yearly_sales = "
        SELECT SUM(amount + 
            CASE
                WHEN deliveryMethod = 'deliverybatamkota' THEN 20000
                WHEN deliveryMethod = 'deliverybatuaji' THEN 20000
                WHEN deliveryMethod = 'deliverybatuampar' THEN 15000
                WHEN deliveryMethod = 'deliverybengkong' THEN 15000
                WHEN deliveryMethod = 'deliverylubukbaja' THEN 15000
                WHEN deliveryMethod = 'deliverynongsa' THEN 25000
                WHEN deliveryMethod = 'deliverysagulung' THEN 20000
                WHEN deliveryMethod = 'deliveryseibeduk' THEN 20000
                WHEN deliveryMethod = 'deliverysekupang' THEN 10000
                ELSE 0
            END
        ) AS yearly_sales 
        FROM orders 
        WHERE DATE_FORMAT(orderDate, '%Y') = '$year' 
        AND orderStatus IN (2, 3, 4, 5)";
    $result_yearly_sales = mysqli_query($conn, $sql_yearly_sales);
    if (!$result_yearly_sales) {
        die('Error: ' . mysqli_error($conn));
    }
    $row_yearly_sales = mysqli_fetch_assoc($result_yearly_sales);
    $yearly_sales = $row_yearly_sales['yearly_sales'] ?? 0;

    // Check if sales data is null and set to zero if true
    $daily_sales = $daily_sales ?: 0;
    $monthly_sales = $monthly_sales ?: 0;
    $yearly_sales = $yearly_sales ?: 0;
}
?>

<div class="container" style="margin-top: 98px; background: white;">
    <div class="container-fluid mt-4" style="padding-top:20px;">
        <div class="row" style="margin-top: 10px;">
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
                        <h5 class="card-title">Total Messages</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text"><?php echo $total_contact; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
?>
