<?php
include '_dbconnect.php'; // Ensure this file is correctly included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contactReply'])) {
    $contactId = $_POST['contactId'];
    $message = $_POST['message'];
    $userId = $_POST['userId'];

    $sql = "INSERT INTO `contactreply` (`contactId`, `userId`, `message`, `datetime`) 
            VALUES ('$contactId', '$userId', '$message', current_timestamp())";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Reply sent successfully.');
              window.location=document.referrer;
              </script>";
    } else {
        echo "<script>alert('Failed to send reply.');
              window.location=document.referrer;
              </script>";
    }
}
?>
