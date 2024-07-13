<?php
include 'partials/_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    $targetDir = "img/proofs/";
    $proofFile = basename($_FILES["proofFile"]["name"]);
    $targetFilePath = $targetDir . $proofFile;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Mengizinkan format file tertentu
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Unggah file ke server
        if (move_uploaded_file($_FILES["proofFile"]["tmp_name"], $targetFilePath)) {
            // Update kolom proofFile di tabel orders
            $sql = "UPDATE orders SET proofFile='$targetFilePath' WHERE orderId='$orderId'";
            if (mysqli_query($conn, $sql)) {
                echo "Bukti pembayaran berhasil diunggah.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo 'Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan untuk diunggah.';
    }
}
?>
