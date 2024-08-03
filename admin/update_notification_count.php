<?php
require 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'reset') {
        // Debugging output
        error_log('Reset action received');

        // Update the status of orders where orderStatus = 1 to 0
        $sql = "UPDATE orders SET orderStatus = 0 WHERE orderStatus = 1";
        if (mysqli_query($conn, $sql)) {
            error_log('Notification count reset in database');
            echo 'Notification count reset';
        } else {
            error_log('Error: ' . mysqli_error($conn));
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        error_log('Invalid action');
        echo 'Invalid action';
    }
} else {
    error_log('Invalid request method');
    echo 'Invalid request method';
}
?>
