<div class="container" style="margin-top: 98px; background: white;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px;">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Order <b>Details</b></h2>
                </div>
                <div class="col-sm-8">
                    <a href="" class="btn btn-primary" style=" background-color: #2A403D; color: white;"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                   </div>
            </div>
        </div>

        <table class="table table-striped table-hover text-center" id="NoOrder">
            <thead style="background-color: #2A403D; color: white;">
                <tr>
                    <th>Order Id</th>
                    <th>User Id</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    
                    <th>Delivery Date</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Items</th>
                    <th>Action</th>
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
                    $paymentMethod = $row['paymentMethod'];
                    $deliveryMethod = $row['deliveryMethod'];
                    $proofFile = $row['proofFile']; // Added proofFile

                    // Check delivery method and add additional fee if applicable
                    if ($deliveryMethod == 'delivery') {
                        $amount += 15000;
                    }

                    $orderStatus = $row['orderStatus'];
                    $counter++;

                    // Modal Detail Order
                    ?>
                    <div id="orderDetailModal<?php echo $orderId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color: #f0f0f0;">
                                <div class="modal-header" style="background-color: #4b5366; color: #fff; border-bottom: none;">
                                    <h4 class="modal-title">Order Detail</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Order ID:</strong> <?php echo $orderId; ?></p>
                                    <p><strong>User ID:</strong> <?php echo $Id; ?></p>
                                    <p><strong>Address:</strong> <?php echo $address; ?></p>
                                    <p><strong>Message:</strong> <?php echo $message; ?></p>
                                    <p><strong>Phone Number:</strong> <?php echo $phoneNo; ?></p>
                                    <p><strong>Amount:</strong> <?php echo $amount; ?></p>
                                    <p><strong>Payment Method:</strong> <?php echo $paymentMethod; ?></p>
                                    <p><strong>Order Date:</strong> <?php echo $orderDate; ?></p>
                                    <p><strong>Delivery Date:</strong> <?php echo $deliveryDate; ?></p>
                                    <p><strong>Delivery Time:</strong> <?php echo $deliveryTime; ?></p>
                                    <p><strong>Delivery Method:</strong> <?php echo $deliveryMethod; ?></p>
                                    <p><strong>Status:</strong> <?php echo $orderStatus; ?></p>
                                    <p><strong>Proof:</strong></p>
                                    <?php if ($proofFile != ''): ?>
                                        <img src="../<?php echo $proofFile; ?>" alt="Proof Image" style="max-width: 100%; max-height: 200px;">
                                    <?php else: ?>
                                        <p>No Proof Image</p>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    echo '<tr>
                        <td>' . $orderId . '</td>
                        <td>' . $Id . '</td>
                        <td>' . $address . '</td>
                        <td>' . $phoneNo . '</td>
                        <td>' . $amount . '</td>
                        
    <td>' . $deliveryDate . ' ' . $deliveryTime . '</td>
                        <td>';
                    if ($proofFile != '') {
                        echo '<img src="../' . $proofFile . '" alt="Proof Image" style="max-width: 100px; max-height: 100px;">';
                    } else {
                        echo 'No Proof Image';
                    }
                    echo '</td>
                        <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view" style="color:#2A403D;"><i class="material-icons">&#xE5C8;</i></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" style="color:#2A403D;" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#orderDetailModal' . $orderId . '" class="view" style="color:#2A403D;"><i class="material-icons">&#xE5C8;</i></a></td>
                    </tr>';
                }

                if ($counter == 0) {
                    ?>
                    <script>document.getElementById("NoOrder").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%; background-color: #2A403D; border: none;"> You have not received any Order! </div>';</script>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="container mt-4">
    <form action="print_transactions.php" method="get">
        <div class="row">
            <div class="col-md-3 mb-2">
                <button type="submit" name="period" value="today" class="btn btn-danger btn-block">Print Today's Transactions</button>
            </div>
            <div class="col-md-3 mb-2">
                <button type="submit" name="period" value="week" class="btn btn-warning btn-block">Print This Week's Transactions</button>
            </div>
            <div class="col-md-3 mb-2">
                <button type="submit" name="period" value="month" class="btn btn-primary btn-block">Print This Month's Transactions</button>
            </div>
            <div class="col-md-3 mb-2">
                <button type="submit" name="period" value="year" class="btn btn-success btn-block">Print This Year's Transactions</button>
            </div>
        </div>
    </form>
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
