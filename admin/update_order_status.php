<?php
include 'config.php'; // Pastikan ini berisi konfigurasi koneksi database

// Mendapatkan waktu saat ini
$currentTime = new DateTime();
$currentTime->modify('-1 hour'); // Mengurangi 1 jam dari waktu sekarang
$formattedCurrentTime = $currentTime->format('Y-m-d H:i:s');

// Query untuk mendapatkan pesanan yang statusnya masih 'Order Placed' dan orderDate-nya melewati 1 jam
$sql = "UPDATE `orders`
        SET `orderStatus` = 6
        WHERE `orderStatus` = 0 AND `orderDate` <= '$formattedCurrentTime'";

if (mysqli_query($conn, $sql)) {
    echo "Status pesanan telah diperbarui.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
