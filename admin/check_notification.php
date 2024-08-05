<?php
require 'partials/_dbconnect.php';

// Query to get the total number of orders with status >= 1 and isRead = FALSE
$sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE orderStatus >= 1 AND isRead = FALSE";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total_orders);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    echo $total_orders;
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
