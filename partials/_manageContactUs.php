<?php
include '_dbconnect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $orderId = $_POST["orderId"];
    $message = $_POST["message"];
    $password = $_POST["password"];

    // Check user password is match or not
    $passSql = "SELECT * FROM users WHERE id='$userId'"; 
    $passResult = mysqli_query($conn, $passSql);
    $passRow = mysqli_fetch_assoc($passResult);
    
    if (password_verify($password, $passRow['password'])){
        // Handle file upload
        $targetDir = "../assets/img/contact/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg','jpeg','png');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                // Insert data into database
                $sql = "INSERT INTO `contact` (`userId`, `email`, `phoneNo`, `orderId`, `message`, `image`, `time`) VALUES ('$userId', '$email', '$phone', '$orderId', '$message', '$fileName', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                $contactId = $conn->insert_id;
                
                echo '<script>alert("Thanks for Contact us. Your contact id is ' .$contactId. '. We will contact you very soon.");
                            window.location.href="http://localhost/bouquetElviOnline/index.php";  
                            </script>';
                exit();
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');
                        window.history.back(1);
                        </script>";
            }
        } else {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.');
                    window.history.back(1);
                    </script>";
        }
    } else {
        echo "<script>alert('Password incorrect!!');
                window.history.back(1);
                </script>";
    }
}
?>
