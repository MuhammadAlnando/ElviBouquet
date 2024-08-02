<?php
include 'partials/_dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Cart</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <style>
        #cont {
            min-height: 626px;
        }
    </style>
</head>

<body>
    <?php require 'partials/_nav.php'; ?>

    <?php
    if ($loggedin) {
        // Fetch user ID from session
        $userId = $_SESSION['userId'];

        // Query to fetch cart items
        $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
        $result = mysqli_query($conn, $sql);
        $counter = 0;
        $totalPrice = 0;

        // Variable to disable checkout button if cart is empty
        $checkoutDisabled = false;

        ?>
        <div class="container" id="cont">
            <div class="row">
                <div class="col-lg-12 text-left border rounded bg-light my-3">
                    <h3>My Cart</h3>
                </div>
                <div class="col-lg-8">
                    <div class="card wish-list mb-3">
                        <table class="table text-center">
                            <thead class="thead" style="background-color: #2A403D; color:white">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $bouquetId = $row['bouquetId'];
                                    $Quantity = $row['itemQuantity'];
                                    $mysql = "SELECT * FROM `bouquet` WHERE bouquetId = $bouquetId";
                                    $myresult = mysqli_query($conn, $mysql);
                                    $myrow = mysqli_fetch_assoc($myresult);
                                    $bouquetName = $myrow['bouquetName'];
                                    $bouquetPrice = $myrow['bouquetPrice'];
                                    $total = $bouquetPrice * $Quantity;
                                    $counter++;
                                    $totalPrice += $total;

                                    echo '<tr>
                                            <td>' . $counter . '</td>
                                            <td>' . $bouquetName . '</td>
                                            <td>' . $bouquetPrice . '</td>
                                            <td>
                                                <form id="frm' . $bouquetId . '">
                                                    <input type="hidden" name="bouquetId" value="' . $bouquetId . '">
                                                    <input type="number" name="quantity" value="' . $Quantity . '" class="text-center" onchange="updateCart(' . $bouquetId . ')" style="width:60px" min="1" oninput="check(this)">
                                                </form>
                                            </td>
                                            <td>' . $total . '</td>
                                            <td>
                                                <form action="partials/_manageCart.php" method="POST">
                                                    <button name="removeItem" class="btn btn-sm btn-outline-danger">Remove</button>
                                                    <input type="hidden" name="itemId" value="' . $bouquetId . '">
                                                </form>
                                            </td>
                                        </tr>';
                                }

                                // Display message if cart is empty
                                if ($counter == 0) {
                                    echo '<tr><td colspan="6" class="text-center">Your cart is empty</td></tr>';
                                    $checkoutDisabled = true;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card wish-list mb-3">
                        <div class="pt-4 border bg-light rounded p-3">
                        <h5 class="mb-3 text-uppercase font-weight-bold text-center">Order summary</h5>
<ul class="list-group list-group-flush">
    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-light">
        Total Price<span id="totalPriceDisplay">Rp. <?php echo $totalPrice ?></span>
    </li>
    <!-- <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">
        Shipping<span id="shippingCharge">+Rp. 0</span>
    </li> -->
    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
        <div>
            <strong>The total amount of</strong>
            <strong>
                <!-- <p class="mb-0">(including delivery)</p> -->
            </strong>
        </div>
        <span><strong id="totalAmountDisplay">Rp. <?php echo $totalPrice?></strong></span>
    </li>
</ul>
<!-- <div class="form-group">
    <label for="deliveryOption">Delivery Option</label>
    <select class="form-control" id="deliveryOption" name="deliveryOption">
        <option value="pickup" selected>Pickup (Free)</option>
        <option value="deliverybatamkota">Batam Kota (+Rp. 20,000)</option>
        <option value="deliverybatuaji">Batu Aji (+Rp. 20,000)</option>
        <option value="deliverybatuampar">Batu Ampar (+Rp. 15,000)</option>
        <option value="deliverybengkong">Bengkong (+Rp. 15,000)</option>
        <option value="deliverylubukbaja">Lubuk Baja (+Rp. 15,000)</option>
        <option value="deliverynongsa">Nongsa (+Rp. 25,000)</option>
        <option value="deliverysagulung">Sagulung (+Rp. 20,000)</option>
        <option value="deliveryseibeduk">Sei Beduk (+Rp. 20,000)</option>
        <option value="deliverysekupang">Sekupang (+Rp. 10,000)</option>
    </select>
</div> -->

<br>
<button type="button" class="btn btn-primary btn-block" style="background-color: #2A403D; border:none; color: white;" data-toggle="modal" data-target="#checkoutModal" onclick="setDeliveryMethod();" <?php if ($checkoutDisabled) echo 'disabled'; ?>>Go to Checkout</button>

                            <?php
                            // JavaScript to display alert if cart is empty
                            if ($checkoutDisabled) {
                                echo '<script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            Swal.fire({
                                                icon: "warning",
                                                title: "Your cart is empty",
                                                text: "Please add items to your cart before proceeding to checkout.",
                                                showConfirmButton: false,
                                                timer: 3000
                                            });
                                        });
                                    </script>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
        echo '<div class="container">
        <div class="alert alert-danger" style="background-color:#E44E5D; color:white;" role="alert">
        
            <font style="font-size:15px">Before checkout you need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal" style="color: white;">Login</a></strong></font>
            </div></div>';
    }
    ?>
    <?php require 'partials/_checkoutModal.php'; ?>
    <?php require 'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function check(input) {
            if (input.value <= 0) {
                input.value = 1;
            }
        }

        function updateCart(id) {
            $.ajax({
                url: 'partials/_manageCart.php',
                type: 'POST',
                data: $("#frm" + id).serialize(),
                success: function (res) {
                    location.reload();
                }
            })
        }

        function setDeliveryMethod() {
    var deliveryOption = $('input[name=deliveryOption]:checked').val();
    $('#deliveryMethod').val(deliveryOption);
}

$(document).ready(function () {
    // Function to update total price and total amount based on delivery option
    $('#deliveryOption').change(function () {
        var deliveryCharge = 0;
        switch (this.value) {
            case 'deliverybatamkota':
                deliveryCharge = 20000;
                break;
            case 'deliverybatuaji':
                deliveryCharge = 20000;
                break;
            case 'deliverybatuampar':
                deliveryCharge = 15000;
                break;
            case 'deliverybengkong':
                deliveryCharge = 15000;
                break;
            case 'deliverylubukbaja':
                deliveryCharge = 15000;
                break;
            case 'deliverynongsa':
                deliveryCharge = 25000;
                break;
            case 'deliverysagulung':
                deliveryCharge = 20000;
                break;
            case 'deliveryseibeduk':
                deliveryCharge = 20000;
                break;
            case 'deliverysekupang':
                deliveryCharge = 10000;
                break;
            default:
                deliveryCharge = 0; // Assume 'pickup' or any other value has no charge
                break;
        }

        var totalPrice = <?php echo $totalPrice; ?>; // Previous total price from PHP
        var newTotalAmount = totalPrice + deliveryCharge;

        $('#totalPriceDisplay').text('Rp. ' + totalPrice.toLocaleString());
        $('#shippingCharge').text(deliveryCharge > 0 ? '+Rp. ' + deliveryCharge.toLocaleString() : 'Free');
        $('#totalAmountDisplay').text('Rp. ' + newTotalAmount.toLocaleString());
    });
});


    
    </script>
</body>

</html>
