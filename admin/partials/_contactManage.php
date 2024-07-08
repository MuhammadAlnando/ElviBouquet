<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['contactReply'])) {
        $contactId = $_POST['contactId'];
        $message = $_POST['message'];
        $userId = $_POST['userId'];
        
        $sql = "INSERT INTO `contactreply` (`contactId`, `userId`, `message`, `image`, `datetime`) 
        VALUES ('$contactId', '$userId', '$message', '$image', current_timestamp())";

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
}
?>