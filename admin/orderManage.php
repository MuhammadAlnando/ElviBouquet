<div class="container" style="margin-top: 98px; background: white;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px; background-color: #2A403D;">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Order <b>Details</b></h2>
                </div>
                
                <div class="col-sm-8">
                    <a href="" class="btn btn-primary" style="background-color: #748B6F; color: white;"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <form action="print_transactions.php" method="get">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <button type="submit" name="period" value="week" class="btn btn-warning btn-block" style="background-color: #748B6F; border: none; color:white">Print This Week's</button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="submit" name="period" value="month" class="btn btn-primary btn-block" style="background-color: #748B6F; border: none; color: white;">Print This Month's</button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="submit" name="period" value="year" class="btn btn-success btn-block" style="background-color: #748B6F; border: none; color: white;">Print This Year's</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-hover text-center" id="NoOrder">
                <thead style="background-color: #2A403D; color: white;">
                    <tr>
                        <th>Order Id</th>
                        
                        <th>Address</th>
                        
                        <th>Amount</th>
                        <th>Delivery Date</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$sql = "SELECT * FROM `orders` ORDER BY `orderId` DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $orderId = $row['orderId'];
    $orderStatus = $row['orderStatus'];
    $deliveryMethod = $row['deliveryMethod'];
    $amount = $row['amount'];
    $proofFile = $row['proofFile']; // Mengambil nilai proofFile dari database
    $statusOptions = [
        0 => 'Order Placed',
        1 => 'Order Confirmed',
        2 => 'Preparing your Order',
        3 => 'Your order is on the way!',
        4 => 'Order Delivered',
        5 => 'Order Denied',
        6 => 'Order Cancelled'
    ];

    // Calculate additional fee based on delivery method
    $deliveryCharges = [
        'deliverybatamkota' => 20000,
        'deliverybatuaji' => 20000,
        'deliverybatuampar' => 15000,
        'deliverybengkong' => 15000,
        'deliverylubukbaja' => 15000,
        'deliverynongsa' => 25000,
        'deliverysagulung' => 20000,
        'deliveryseibeduk' => 20000,
        'deliverysekupang' => 10000
    ];
    $amount += isset($deliveryCharges[$deliveryMethod]) ? $deliveryCharges[$deliveryMethod] : 0;

    echo '<tr>
        <td>' . $orderId . '</td>
        <td>' . $row['address'] . '</td>
        <td>' . $amount . '</td>
        <td>' . $row['deliveryDate'] . ' ' . $row['deliveryTime'] . '</td>
        <td>';
    if ($proofFile != '') {
        echo '<img src="../' . $proofFile . '" alt="Proof Image" style="max-width: 100px; max-height: 100px;">';
    } else {
        echo 'No Proof Image';
    }
    echo '</td>
        <td>';
    if ($proofFile != '') {
        // Jika bukti pembayaran ada, tampilkan dropdown perubahan status
        echo '<form action="partials/_orderManage.php" method="post" style="margin: 0;">
            <input type="hidden" name="orderId" value="' . $orderId . '">
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="" disabled selected>Change Status</option>';
        foreach ($statusOptions as $value => $text) {
            $selected = $value == $orderStatus ? 'selected' : '';
            echo '<option value="' . $value . '" ' . $selected . '>' . $text . '</option>';
        }
        echo '</select>
            <input type="hidden" name="updateStatus" value="1">
        </form>';
    } else {
        // Jika bukti pembayaran belum ada, tampilkan pesan
        echo '<span class="text-danger">Upload payment proof to change status</span>';
    }
    echo '</td>
        <td><a href="#" data-toggle="modal" data-target="#orderDetailModal' . $orderId . '" class="view" style="color:#2A403D;"><i class="material-icons">&#xE5C8;</i></a></td>
    </tr>';
}
?>

                    <!-- Modal -->
                    <?php
                    // Ensure that the modal HTML is correctly placed outside the loop
                    $result->data_seek(0); // Reset the result pointer
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderId = $row['orderId'];
                        $proofFile = $row['proofFile'];
                        $Id = $row['userId'];
                        $address = $row['address'];
                        $message = $row['message'];
                        $phoneNo = $row['phoneNo'];
                        $amount = $row['amount'];
                        $paymentMethod = $row['paymentMethod'];
                        $orderDate = $row['orderDate'];
                        $deliveryDate = $row['deliveryDate'];
                        $deliveryTime = $row['deliveryTime'];
                        $deliveryMethod = $row['deliveryMethod'];
                        $orderStatus = $row['orderStatus'];
                    ?>
                    <div id="orderDetailModal<?php echo $orderId; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color: #f0f0f0;">
                                <div class="modal-header" style="background-color: #2A403D; color: white; border-bottom: none;">
                                    <h4 class="modal-title">Order Detail</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Customer Details</h5>
                                                <p><strong>Name:</strong> <?php echo $Id; ?></p>
                                                <p><strong>Address:</strong> <?php echo $address; ?></p>
                                                <p><strong>Phone No:</strong> <?php echo $phoneNo; ?></p>
                                                <p><strong>Message:</strong> <?php echo $message; ?></p>
                                                <p><strong>Order Date:</strong> <?php echo $orderDate; ?></p>
                                                <p><strong>Delivery Date:</strong> <?php echo $deliveryDate; ?></p>
                                                <p><strong>Delivery Time:</strong> <?php echo $deliveryTime; ?></p>
                                                <p><strong>Delivery Method:</strong> <?php echo $deliveryMethod; ?></p>
                                                <p><strong>Payment Method:</strong> <?php echo $paymentMethod; ?></p>
                                                <p><strong>Amount:</strong> Rp. <?php echo $amount; ?></p>
                                                <p><strong>Status:</strong> <?php echo $statusOptions[$orderStatus]; ?></p>
                                                <?php if ($proofFile != '') { ?>
                                                    <p><strong>Proof of Payment:</strong><br><img src="../<?php echo $proofFile; ?>" alt="Proof Image" style="max-width: 100px; max-height: 100px;"></p>
                                                <?php } else { ?>
                                                    <p><strong>Proof of Payment:</strong> No proof available</p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Order Items</h5>
                                                <?php
                                                $itemsSql = "SELECT * FROM `orderitems` WHERE orderId = $orderId";
                                                $itemsResult = mysqli_query($conn, $itemsSql);
                                                while ($item = mysqli_fetch_assoc($itemsResult)) {
                                                    $bouquetId = $item['bouquetId'];
                                                    $itemQuantity = $item['itemQuantity'];
                                                    
                                                    $bouquetSql = "SELECT * FROM `bouquet` WHERE bouquetId = $bouquetId";
                                                    $bouquetResult = mysqli_query($conn, $bouquetSql);
                                                    $bouquet = mysqli_fetch_assoc($bouquetResult);
                                                    $bouquetName = $bouquet['bouquetName'];
                                                    $bouquetPrice = $bouquet['bouquetPrice'];
                                                
                                                    echo '<div><img src="/bouquetElviOnline/img/bouquet-' . $bouquetId . '.jpg" alt="" width="50" class="img-fluid rounded shadow-sm"> ' . $bouquetName . ' (Qty: ' . $itemQuantity . ') - Rp. ' . $bouquetPrice . '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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