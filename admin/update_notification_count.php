<?php
require 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'reset') {
        // Update the status of orders where orderStatus = 1 to 0 and set isRead to TRUE
        $sql = "UPDATE orders SET orderStatus = 0, isRead = TRUE WHERE orderStatus = 1";
        if (mysqli_query($conn, $sql)) {
            echo 'Notification count reset';
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        echo 'Invalid action';
    }
} else {
    echo 'Invalid request method';
}
?>
