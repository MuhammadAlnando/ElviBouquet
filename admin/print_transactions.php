<?php
require 'partials/_dbconnect.php';

$period = isset($_GET['period']) ? $_GET['period'] : 'today';

// Mendapatkan tanggal untuk periode yang dipilih
switch ($period) {
    case 'week':
        $start_date = date('Y-m-d', strtotime('monday this week'));
        $end_date = date('Y-m-d', strtotime('sunday this week'));
        break;
    case 'month':
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        break;
    case 'year':
        $start_date = date('Y-01-01');
        $end_date = date('Y-12-31');
        break;
    case 'today':
    default:
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        break;
}

$sql = "
    SELECT * FROM orders 
    WHERE orderDate BETWEEN '$start_date' AND '$end_date' 
    AND orderStatus != 0
";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Menyiapkan output HTML
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Print Transactions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">Transactions from <?php echo $start_date; ?> to <?php echo $end_date; ?></h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Amount</th>
                <th>Order Date</th>
                <th>Delivery Method</th>
                <th>Order Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                // Pastikan data sesuai
                if ($row['orderStatus'] != 0) {
                    $amount = $row['amount'];
                    if ($row['deliveryMethod'] == 'delivery') {
                        $amount += 15000; // Tambahkan biaya pengiriman
                    }
                    echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['orderId']}</td>
                        <td>{$row['userId']}</td>
                        <td>Rp. " . number_format($amount, 2) . "</td>
                        <td>{$row['orderDate']}</td>
                        <td>{$row['deliveryMethod']}</td>
                        <td>{$row['orderStatus']}</td>
                    </tr>";
                    $count++;
                }
            }
            ?>
        </tbody>
    </table>
    <div class="text-center no-print">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
        <a href="index.php" class="btn btn-secondary">Back to Admin Page</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
