<H3 style="margin-bottom: -70px; margin-top: 90px;">Notification</H3>
<div class="container" style="margin-top: 98px; background: white;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px; background-color: #2A403D;">
            <div class="row">
                
                
              
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
                $orderStatus = $row['orderStatus'];
                $deliveryMethod = $row['deliveryMethod'];
                $amount = $row['amount'];
                $proofFile = $row['proofFile'];
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

                echo '<div class="order">
                   You have new order
                    Address: ' . $row['address'] . '
                    dengan nominal Rp. ' . $amount . '
                    dan pengantaran Delivery Date pada ' . $row['deliveryDate'] . ' ' . $row['deliveryTime'] . '
                  
                
                    Status order kini ' . $statusOptions[$orderStatus] . '<br>
                    
                    <hr>


                      </div>';
            }
            ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'partials/_orderItemModal.php';
include 'partials/_orderStatusModal.php';
?>


<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
   .order {
    
    border-radius: 5px;
    padding: 15px;
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
    });
</script>