<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cart</title>

    <!-- SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <!-- Your PHP code and HTML content here -->
    <?php
    include '_dbconnect.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_SESSION['userId'];

        // Adding item to cart
        if (isset($_POST['addToCart'])) {
            $itemId = $_POST["itemId"];
            $existSql = "SELECT * FROM `viewcart` WHERE pizzaId = '$itemId' AND `userId`='$userId'";
            $result = mysqli_query($conn, $existSql);
            $numExistRows = mysqli_num_rows($result);
            if ($numExistRows > 0) {
                echo "<script>alert('Item Already Added.'); window.history.back(1); </script>";
            } else {
                $sql = "INSERT INTO `viewcart` (`pizzaId`, `itemQuantity`, `userId`, `addedDate`) 
                        VALUES ('$itemId', '1', '$userId', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>window.history.back(1); </script>";
                }
            }
        }

        // Removing item from cart
        if (isset($_POST['removeItem'])) {
            $itemId = $_POST["itemId"];
            $sql = "DELETE FROM `viewcart` WHERE `pizzaId`='$itemId' AND `userId`='$userId'";
            $result = mysqli_query($conn, $sql);
            echo "<script>alert('Removed'); window.history.back(1); </script>";
        }

        // Removing all items from cart
        if (isset($_POST['removeAllItem'])) {
            $sql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
            $result = mysqli_query($conn, $sql);
            echo "<script>alert('Removed All'); window.history.back(1); </script>";
        }

        // Checkout process
        if (isset($_POST['checkout'])) {
            // Process checkout
            $amount = $_POST["amount"];
            $address1 = $_POST["address"];
            $phone = $_POST["phone"];
            $zipcode = $_POST["zipcode"];
            $password = $_POST["password"];
            $message = $_POST["message"];
            $deliveryDate = $_POST["deliveryDate"];
            $deliveryTime = $_POST["deliveryTime"];
            $deliveryMethod = $_POST["deliveryMethod"];
            $paymentMethod = $_POST["paymentMethod"];

            // Concatenate address and zipcode
            $address = $address1 . "," . $zipcode;

            // Verify password
            $passSql = "SELECT * FROM users WHERE id='$userId'";
            $passResult = mysqli_query($conn, $passSql);
            $passRow = mysqli_fetch_assoc($passResult);
            if (password_verify($password, $passRow['password'])) {
                // Insert order details into orders table
                $sql = "INSERT INTO `orders` (`userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMethod`, `orderStatus`, `orderDate`, `message`, `deliveryDate`, `deliveryTime`, `deliveryMethod`) 
                        VALUES ('$userId', '$address', '$zipcode', '$phone', '$amount', '$paymentMethod', '0', current_timestamp(), '$message', '$deliveryDate', '$deliveryTime', '$deliveryMethod')";
                $result = mysqli_query($conn, $sql);
                $orderId = $conn->insert_id;
                if ($result) {
                    // Insert order items into orderitems table
                    $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'";
                    $addResult = mysqli_query($conn, $addSql);
                    while ($addrow = mysqli_fetch_assoc($addResult)) {
                        $pizzaId = $addrow['pizzaId'];
                        $itemQuantity = $addrow['itemQuantity'];
                        $itemSql = "INSERT INTO `orderitems` (`orderId`, `pizzaId`, `itemQuantity`) 
                                    VALUES ('$orderId', '$pizzaId', '$itemQuantity')";
                        $itemResult = mysqli_query($conn, $itemSql);
                    }

                    // Empty cart after checkout
                    $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
                    $deleteresult = mysqli_query($conn, $deletesql);

                    // Display SweetAlert notification
                    echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: "Thanks for ordering with us. Your order id is ' . $orderId . '"
                            }).then(function() {
                                window.location.href = "http://localhost/OnlinePizzaDelivery/index.php";
                            });
                        </script>';
                    exit();
                } else {
                    echo "<script>alert('Failed to place order.'); window.history.back(1); </script>";
                    exit();
                }
            } else {
                echo '<script>alert("Incorrect Password! Please enter correct Password."); window.history.back(1); </script>';
                exit();
            }
        }

        // Update item quantity in cart via AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $pizzaId = $_POST['pizzaId'];
            $qty = $_POST['quantity'];
            $updatesql = "UPDATE `viewcart` SET `itemQuantity`='$qty' WHERE `pizzaId`='$pizzaId' AND `userId`='$userId'";
            $updateresult = mysqli_query($conn, $updatesql);
        }
    }
    ?>
</body>
</html>
