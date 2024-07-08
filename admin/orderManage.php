<div class="container" style="margin-top: 98px; background: aliceblue;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px;">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Order <b>Details</b></h2>
                </div>
                <div class="col-sm-8">
                    <a href="" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                    <a href="#" onclick="window.print()" class="btn btn-info"><i class="material-icons">&#xE24D;</i> <span>Print</span></a>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover text-center" id="NoOrder">
            <thead style="background-color: rgb(111, 202, 203);">
                <tr>
                    <th>Order Id</th>
                    <th>User Id</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Delivery Method</th>
                    <th>Status</th>
                    <th>Items</th>
                    <th>Action</th> <!-- Added Action -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `orders` ORDER BY `orderId` DESC";
                $result = mysqli_query($conn, $sql);
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {                
                    $Id = $row['userId'];
                    $orderId = $row['orderId'];
                    $address = $row['address'];
                    $message = $row['message']; // Added message
                    $phoneNo = $row['phoneNo'];
                    $amount = $row['amount'];
                    $orderDate = $row['orderDate'];
                    $deliveryDate = $row['deliveryDate'];
                    $deliveryTime = $row['deliveryTime'];
                    $paymentMode = $row['paymentMode'];
                    $deliveryMethod = $row['deliveryMethod'];
                
                    // Check delivery method and add additional fee if applicable
                    if ($deliveryMethod == 'delivery') {
                        $amount += 15000;
                    }
                
                    if ($paymentMode == 0) {
                        $paymentMode = "Cash on Delivery";
                    } else {
                        $paymentMode = "Online";
                    }
                    $orderStatus = $row['orderStatus'];
                    $counter++;
                
                    // Modal Detail Order
                    echo '<div id="orderDetailModal' . $orderId . '" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #f0f0f0;">
                            <div class="modal-header" style="background-color: #4b5366; color: #fff; border-bottom: none;">
                                <h4 class="modal-title">Order Detail</h4>
                                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Order ID:</strong> ' . $orderId . '</p>
                                <p><strong>User ID:</strong> ' . $Id . '</p>
                                <p><strong>Address:</strong> ' . $address . '</p>
                                <p><strong>Message:</strong> ' . $message . '</p>
                                <p><strong>Phone Number:</strong> ' . $phoneNo . '</p>
                                <p><strong>Amount:</strong> ' . $amount . '</p>
                                <p><strong>Payment Mode:</strong> ' . $paymentMode . '</p>
                                <p><strong>Order Date:</strong> ' . $orderDate . '</p>
                                <p><strong>Delivery Date:</strong> ' . $deliveryDate . '</p>
                                <p><strong>Delivery Time:</strong> ' . $deliveryTime . '</p>
                                <p><strong>Delivery Method:</strong> ' . $deliveryMethod . '</p>
                                <p><strong>Status:</strong> ' . $orderStatus . '</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
                
                
                    echo '<tr>
                            <td>' . $orderId . '</td>
                            <td>' . $Id . '</td>
                            <td>' . $amount . '</td>
                            <td>' . $paymentMode . '</td>
                            <td>' . $orderDate . '</td>
                            <td>' . $deliveryDate . '</td>
                            <td>' . $deliveryTime . '</td>
                            <td>' . $deliveryMethod . '</td> <!-- Added delivery method -->
                            <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                            <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                            <td><a href="#" data-toggle="modal" data-target="#orderDetailModal' . $orderId . '" class="view"><i class="material-icons">&#xE5C8;</i> View</a></td>
                          </tr>';
                }
                
                if ($counter == 0) {
                    ?><script> document.getElementById("NoOrder").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> You have not received any Order! </div>';</script> <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'partials/_orderItemModal.php';
include 'partials/_orderStatusModal.php';
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    .tooltip.show {
        top: -62px !important;
    }

    .table-wrapper .btn {
        float: right;
        color: #333;
        background-color: #fff;
        border-radius: 3px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table-wrapper .btn:hover {
        color: #333;
        background: #f2f2f2;
    }

    .table-wrapper .btn.btn-primary {
        color: #fff;
        background: #03A9F4;
    }

    .table-wrapper .btn.btn-primary:hover {
        background: #03a3e7;
    }

    .table-title .btn {
        font-size: 13px;
        border: none;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    .table-title {
        color: #fff;
        background: #4b5366;
        padding: 16px 25px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 80px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        /* background-color: #fcfcfc; */
    }

    table.table-striped.table-hover tbody tr:hover {
        /* background: #f5f5f5; */
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.view {
        width: 30px;
        height: 30px;
        color: #2196F3;
        border: 2px solid;
        border-radius: 30px;
        text-align: center;
    }

    table.table td a.view i {
        font-size: 22px;
        margin: 2px 0 0 1px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }

    table {
        counter-reset: section;
    }

    .count:before {
        counter-increment: section;
        content: counter(section);
    }
</style>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
