<?php
require 'partials/_dbconnect.php';

// Query to get the total number of orders with status >= 1 and isRead = FALSE
$sql_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE orderStatus >= 1 AND isRead = FALSE";
$result = mysqli_query($conn, $sql_orders);
$row = mysqli_fetch_assoc($result);
$total_orders = $row['total_orders'];

echo json_encode(['count' => $total_orders]);
?>
