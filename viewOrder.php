<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Your Order</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
<style>
    .footer {
      position: fixed;
      bottom: 0;
    }
    .table-wrapper {
    background: #fff;
    padding: 20px 25px;
    margin: 30px auto;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
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
    table.table tr th, table.table tr td {
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
        background-color: #fcfcfc;
    }
    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
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

</head>
<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_nav.php'; ?>
    
    <?php if ($loggedin): ?>
    <div class="container">
        <div class="table-wrapper" id="empty">
            <div class="table-title" style="background-color: #6F42C1;">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Order <b>Details</b></h2>
                    </div>
                    <div class="col-sm-8"></div>
                </div>
            </div>
            <div id="notifContainer"></div>
            <!-- Tabel -->
            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Address</th>
                        <th>Phone No</th>
                        <th>Amount</th>   
                        <th>Delivery Date</th>     
                        <th>Proof Upload</th>
                        <th>Status</th>                      
                        <th>Items</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `orders` ORDER BY `orderId` DESC";
                    $result = mysqli_query($conn, $sql);
                    $counter = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderId = $row['orderId'];
                        $address = $row['address'];
                        $phoneNo = $row['phoneNo'];
                        $amount = $row['amount'];
                        $orderDate = $row['orderDate'];
                        $deliveryDate = $row['deliveryDate'];
                        $deliveryTime = $row['deliveryTime'];
                        $paymentMethod = $row['paymentMethod'];
                        $deliveryMethod = $row['deliveryMethod'];

                        // Example code to define $Id and $message (modify according to your data structure)
                        $Id = isset($row['userId']) ? $row['userId'] : ''; // Example variable, modify as per your database structure
                        $message = isset($row['message']) ? $row['message'] : ''; // Example variable, modify as per your database structure

                        if ($deliveryMethod === 'delivery') {
                            $amount += 15000; // Additional delivery fee
                        }

                        $counter++;

                        echo '<tr>
                            <td>' . $orderId . '</td>
                            <td>' . substr($address, 0, 20) . '</td>
                            <td>' . $phoneNo . '</td>
                            <td>' . $amount . '</td>
                            
    <td>' . $deliveryDate . ' ' . $deliveryTime . '</td>
                            <td>';

                        // Di dalam loop while untuk menampilkan data order
                        if (!empty($row['proofFile'])) {
                            echo '<img src="' . $row['proofFile'] . '" width="100" height="100" alt="Proof Image">';
                        } else {
                            // Tampilkan form upload jika belum ada bukti pembayaran
                            echo '<form id="uploadForm' . $orderId . '" class="uploadForm" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="proofFile">Select Proof Image:</label>
                                        <input type="file" class="form-control-file" id="proofFile' . $orderId . '" name="proofFile">
                                    </div>
                                    <input type="hidden" name="orderId" value="' . $orderId . '">
                                    <button type="submit" class="btn btn-primary uploadProofBtn">Upload Proof</button>
                                </form>';
                        }

                        echo '</td>
                            <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view" style="color:#6F42C1;"><i class="material-icons" style="color:#6F42C1;">&#xE5C8;</i></a></td>
                            <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" style="color:#6F42C1;" title="View Details"><i class="material-icons" style="color:#6F42C1;">&#xE5C8;</i></a></td>
                            <td><a href="#" data-toggle="modal" data-target="#orderDetailModal' . $orderId . '" class="view" style="color:#6F42C1;"><i class="material-icons" style="color:#6F42C1;">&#xE5C8;</i> View</a></td>
                        </tr>';

                        // Modal Detail Pesanan
                        echo '<div id="orderDetailModal' . $orderId . '" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Order Detail</h5>                 
                                            <a href="#" onclick="window.print()" class="btn btn-info"><i class="material-icons">&#xE24D;</i> <span>Print</span></a>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Order ID:</strong> ' . $orderId . '</p>
                                            <p><strong>User ID:</strong> ' . $Id . '</p>
                                            <p><strong>Address:</strong> ' . $address . '</p>
                                            <p><strong>Message:</strong> ' . $message . '</p>
                                            <p><strong>Phone Number:</strong> ' . $phoneNo . '</p>
                                            <p><strong>Amount:</strong> ' . $amount . '</p>
                                            <p><strong>Payment Method:</strong> ' . $paymentMethod . '</p>
                                            <p><strong>Order Date:</strong> ' . $orderDate . '</p>
                                            <p><strong>Delivery Date:</strong> ' . $deliveryDate . '</p>
                                            <p><strong>Delivery Time:</strong> ' . $deliveryTime . '</p>
                                            <p><strong>Delivery Method:</strong> ' . $deliveryMethod . '</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                        // Modal Upload Proof
                        echo '<div id="uploadProofModal' . $orderId . '" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload Proof for Order ID: ' . $orderId . '</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form upload proof here -->
                                            <form action="upload_proof.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="proofFile">Select Proof Image:</label>
                                                    <input type="file" class="form-control-file" id="proofFile" name="proofFile">
                                                </div>
                                                <input type="hidden" name="orderId" value="' . $orderId . '">
                                                <button type="submit" class="btn btn-primary">Upload Proof</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <!-- Tampilkan pesan jika belum login -->
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Anda harus login untuk melihat halaman ini. <a href="login.php" class="alert-link">Login disini.</a>
            </div>
        </div>
    <?php endif; ?>

    <?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php';
    require 'partials/_footer.php';?> 
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('.uploadForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'upload_proof.php', // Ganti dengan URL yang sesuai
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#notifContainer').html('<div class="alert alert-success">Bukti pembayaran berhasil diunggah. Silahkan refresh halaman.</div>');
                // Tambahkan kode untuk update UI lainnya jika diperlukan
            },
            error: function(xhr, status, error) {
                $('#notifContainer').html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                // Tambahkan kode untuk menangani error lainnya jika diperlukan
            }
        });
    });
});
</script>

</body>
</html>