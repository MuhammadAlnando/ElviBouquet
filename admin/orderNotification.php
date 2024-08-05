<div class="container" style="margin-top: 98px; background: white;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px; background-color: #2A403D;">
            <div class="row">
                <!-- Title or any other header content can go here -->
            </div>
        </div>
        <div class="container mt-4">
            <div id="orders">
            <?php
// Ubah status order yang sudah lebih dari 1 jam dengan status 'Order Placed' menjadi 'Order Cancelled'
$sqlUpdate = "UPDATE `orders` SET `orderStatus` = 6 
              WHERE `orderStatus` = 0 
              AND `orderDate` < (NOW() - INTERVAL 1 HOUR)";
mysqli_query($conn, $sqlUpdate);

$sql = "SELECT * FROM `orders` ORDER BY `orderId` DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $orderId = $row['orderId'];
    $orderStatus = isset($row['orderStatus']) ? $row['orderStatus'] : 0;
    $deliveryMethod = isset($row['deliveryMethod']) ? $row['deliveryMethod'] : '';
    $amount = isset($row['amount']) ? $row['amount'] : 0;
    $address = isset($row['address']) ? $row['address'] : '';
    $phoneNo = isset($row['phoneNo']) ? $row['phoneNo'] : '';
    $message = isset($row['message']) ? $row['message'] : '';
    $orderDate = isset($row['orderDate']) ? $row['orderDate'] : '';
    $deliveryDate = isset($row['deliveryDate']) ? $row['deliveryDate'] : '';
    $deliveryTime = isset($row['deliveryTime']) ? $row['deliveryTime'] : '';
    $paymentMethod = isset($row['paymentMethod']) ? $row['paymentMethod'] : '';
    $proofFile = isset($row['proofFile']) ? $row['proofFile'] : '';

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
    $statusText = isset($statusOptions[$orderStatus]) ? $statusOptions[$orderStatus] : 'Pending payment upload/check';
    
    echo '<div class="order" data-toggle="modal" data-target="#orderDetailModal' . $orderId . '" style="cursor: pointer;">
        <strong>You have a new order.</strong> Address at ' . $address . '
        with an amount of Rp. ' . $amount . '
        and delivery scheduled for ' . $deliveryDate . ' at ' . $deliveryTime . '
        The order status is ' . $statusText . '
        <hr>
    </div>';

    echo '<div id="orderDetailModal' . $orderId . '" class="modal fade" role="dialog">
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
                                <p><strong>Name:</strong> ' . $orderId . '</p>
                                <p><strong>Address:</strong> ' . $address . '</p>
                                <p><strong>Phone No:</strong> ' . $phoneNo . '</p>
                                <p><strong>Message:</strong> ' . $message . '</p>
                                <p><strong>Order Date:</strong> ' . $orderDate . '</p>
                                <p><strong>Delivery Date:</strong> ' . $deliveryDate . '</p>
                                <p><strong>Delivery Time:</strong> ' . $deliveryTime . '</p>
                                <p><strong>Delivery Method:</strong> ' . $deliveryMethod . '</p>
                                <p><strong>Payment Method:</strong> ' . $paymentMethod . '</p>
                                <p><strong>Amount:</strong> Rp. ' . $amount . '</p>
                                <p><strong>Status:</strong> ' . $statusText . '</p>';
                                if ($proofFile != '') {
                                    echo '<p><strong>Proof of Payment:</strong><br><img src="../' . $proofFile . '" alt="Proof Image" style="max-width: 100px; max-height: 100px;"></p>';
                                } else {
                                    echo '<p><strong>Proof of Payment:</strong> No proof available</p>';
                                }
                                echo '</div>
                            <div class="col-md-6">
                                <h5>Order Items</h5>';
                                $itemsSql = "SELECT * FROM `orderitems` WHERE orderId = $orderId";
                                $itemsResult = mysqli_query($conn, $itemsSql);
                                while ($item = mysqli_fetch_assoc($itemsResult)) {
                                    $bouquetId = isset($item['bouquetId']) ? $item['bouquetId'] : 0;
                                    $itemQuantity = isset($item['itemQuantity']) ? $item['itemQuantity'] : 0;
                                    
                                    $bouquetSql = "SELECT * FROM `bouquet` WHERE bouquetId = $bouquetId";
                                    $bouquetResult = mysqli_fetch_assoc(mysqli_query($conn, $bouquetSql));
                                    $bouquetName = isset($bouquetResult['bouquetName']) ? $bouquetResult['bouquetName'] : 'Unknown Bouquet';
                                    $bouquetPrice = isset($bouquetResult['bouquetPrice']) ? $bouquetResult['bouquetPrice'] : 'Unknown Price';
                                
                                    echo '<div><img src="/bouquetElviOnline/img/bouquet-' . $bouquetId . '.jpg" alt="" width="50" class="img-fluid rounded shadow-sm"> ' . $bouquetName . ' (Qty: ' . $itemQuantity . ') - Rp. ' . $bouquetPrice . '</div>';
                                }
                            echo '</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>';
}
?>
</div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    .order {
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .order h4 {
        margin-top: 0;
    }

    .order p {
        margin: 5px 0;
    }

    .order img {
        max-width: 100px;
        max-height: 100px;
        display: block;
    }

    .order a.view {
        text-decoration: none;
        color: #2A403D;
    }

    .order a.view:hover {
        text-decoration: underline;
    }
</style>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $('.order').on('click', function() {
            var orderId = $(this).data('order-id');
            $('#orderDetailModal' + orderId).modal('show');
        });
    });
</script>
