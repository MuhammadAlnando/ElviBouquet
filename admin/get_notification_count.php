<?php
require 'partials/_dbconnect.php';

if (!function_exists('getOrderCounts')) {
    function getOrderCounts($conn) {
        $orderCounts = ['total' => 0, 'new' => 0];

        $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE orderStatus >= 1 AND isRead = FALSE";
        if ($stmt = mysqli_prepare($conn, $sql_orders)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $orderCounts['total']);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        } else {
            die('Error: ' . mysqli_error($conn));
        }

        $sql_new_orders = "SELECT COUNT(*) AS new_orders FROM orders WHERE orderStatus = 1 AND isRead = FALSE";
        if ($stmt = mysqli_prepare($conn, $sql_new_orders)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $orderCounts['new']);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        } else {
            die('Error: ' . mysqli_error($conn));
        }

        return $orderCounts;
    }
}

$orderCounts = getOrderCounts($conn);
echo json_encode(['count' => $orderCounts['new']]);
?>
