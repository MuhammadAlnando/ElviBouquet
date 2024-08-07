<?php
require 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reset') {
    $sql_update = "UPDATE orders SET isRead = TRUE WHERE orderStatus >= 1 AND isRead = FALSE";
    if (mysqli_query($conn, $sql_update)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
}
?>
