<?php
// delete_order.php
include 'partials/_dbconnect.php';

$response = array('success' => false, 'message' => 'Unknown error');

// Pastikan ID pesanan dikirim dan valid
if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
    $orderId = intval($_POST['orderId']);
    
    // Siapkan dan eksekusi query penghapusan
    $stmt = $conn->prepare("DELETE FROM `orders` WHERE `orderId` = ?");
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Order successfully deleted.';
    } else {
        $response['message'] = 'Failed to delete order.';
    }
    
    $stmt->close();
} else {
    $response['message'] = 'Invalid order ID.';
}

echo json_encode($response);
?>
