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
    <?php
    include '_dbconnect.php';
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['userId'])) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You must be logged in to perform this action."
                }).then(function() {
                    window.location.href = "login.php";
                });
              </script>';
        exit();
    }

    $userId = $_SESSION['userId'];

    // Add item to cart
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];

        // Check if item already exists in cart
        $existSql = "SELECT * FROM `viewcart` WHERE pizzaId = '$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $existSql);
        if (!$result) {
            die("Query Failed: " . mysqli_error($conn));
        }

        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            // Item already in cart
            echo '<script>
                    Swal.fire({
                        icon: "warning",
                        title: "Item Already Added",
                        text: "This item is already in your cart."
                    }).then(function() {
                        window.history.back();
                    });
                  </script>';
            exit();
        } else {
            // Add item to cart
            $sql = "INSERT INTO `viewcart` (`pizzaId`, `itemQuantity`, `userId`, `addedDate`) 
                    VALUES ('$itemId', '1', '$userId', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // Item successfully added to cart
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Item Added",
                            text: "Item added to your cart."
                        }).then(function() {
                            window.history.back();
                        });
                      </script>';
                exit();
            } else {
                // Error adding item to cart
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to add item to your cart."
                        }).then(function() {
                            window.history.back();
                        });
                      </script>';
                exit();
            }
        }
    }

    // Remove item from cart
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `viewcart` WHERE `pizzaId`='$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Item successfully removed from cart
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Removed",
                        text: "Item has been removed from your cart."
                    }).then(function() {
                        window.history.back();
                    });
                  </script>';
            exit();
        } else {
            // Error removing item from cart
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to remove item from your cart."
                    }).then(function() {
                        window.history.back();
                    });
                  </script>';
            exit();
        }
    }

    // Remove all items from cart
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // All items successfully removed from cart
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Removed All",
                        text: "All items have been removed from your cart."
                    }).then(function() {
                        window.history.back();
                    });
                  </script>';
            exit();
        } else {
            // Error removing all items from cart
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to remove all items from your cart."
                    }).then(function() {
                        window.history.back();
                    });
                  </script>';
            exit();
        }
    }

    // Checkout process
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
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
        if (!$passResult) {
            die("Query Failed: " . mysqli_error($conn));
        }
        $passRow = mysqli_fetch_assoc($passResult);
        if (password_verify($password, $passRow['password'])) {
            // Password verified, proceed with checkout
            $sql = "INSERT INTO `orders` (`userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMethod`, `orderStatus`, `orderDate`, `message`, `deliveryDate`, `deliveryTime`, `deliveryMethod`) 
                    VALUES ('$userId', '$address', '$zipcode', '$phone', '$amount', '$paymentMethod', '0', current_timestamp(), '$message', '$deliveryDate', '$deliveryTime', '$deliveryMethod')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // Order successfully placed
                $orderId = $conn->insert_id;
                $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'";
                $addResult = mysqli_query($conn, $addSql);
                while ($addrow = mysqli_fetch_assoc($addResult)) {
                    $pizzaId = $addrow['pizzaId'];
                    $itemQuantity = $addrow['itemQuantity'];
                    $itemSql = "INSERT INTO `orderitems` (`orderId`, `pizzaId`, `itemQuantity`) 
                                VALUES ('$orderId', '$pizzaId', '$itemQuantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                    if (!$itemResult) {
                        die("Query Failed: " . mysqli_error($conn));
                    }
                }

                // Clear cart after checkout
                $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
                $deleteresult = mysqli_query($conn, $deletesql);
                if (!$deleteresult) {
                    die("Query Failed: " . mysqli_error($conn));
                }

                // Redirect to view order page
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Thanks for ordering with us. Your order id is ' . $orderId . '. Please upload proof of payment soon."
                        }).then(function() {
                            window.location.href = "http://localhost/OnlinePizzaDelivery/viewOrder.php";
                        });
                      </script>';
                exit();
            } else {
                // Error placing order
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to place your order."
                        }).then(function() {
                            window.history.back();
                        });
                      </script>';
                exit();
            }
        } else {
            // Incorrect password
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Incorrect Password",
                        text: "Please enter the correct password."
                    }).then(function() {
                        window.history.back();
                    });
                  </script>';
            exit();
        }
    }

    // Update item quantity in cart via AJAX (if necessary)
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $pizzaId = $_POST['pizzaId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `viewcart` SET `itemQuantity`='$qty' WHERE `pizzaId`='$pizzaId' AND `userId`='$userId'";
        $updateresult = mysqli_query($conn, $updatesql);
        if (!$updateresult) {
            die("Query Failed: " . mysqli_error($conn));
        }
    }
    ?>
</body>
</html>
