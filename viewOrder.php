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
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">
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
    <!-- <div class="text" style="margin-top:20px; margin-left:80px;">
        <h6>only accepts payment via bank transfer</h6>
    </div>-->
    <?php if ($loggedin): ?>
    <div class="container">
        <div class="table-wrapper" id="empty">
            <div class="table-title" style="background-color: #2A403D; margin-top:-40px;">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>History Order</h2>
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
                        <th>Amount</th>
                        
                        <th>Delivery Date</th> 
                        <th>Status</th>      
                        <th>Payment</th>
                                            
                        <th>Items</th>
                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
// Pastikan sudah ada session atau cara lain untuk mengambil ID pengguna yang terautentikasi
$userId = $_SESSION['userId']; // Ubah sesuai dengan cara Anda mengambil ID pengguna

$sql = "SELECT * FROM `orders` WHERE `userId` = $userId ORDER BY `orderId` DESC";
$result = mysqli_query($conn, $sql);
$counter = 0;

while ($row = mysqli_fetch_assoc($result)) {
    // Ambil data order seperti yang sudah Anda lakukan sebelumnya
    $orderId = $row['orderId'];
    $address = $row['address'];
    $amount = $row['amount'];
 
    $orderDate = $row['orderDate'];
    $deliveryDate = $row['deliveryDate'];
    $deliveryTime = $row['deliveryTime'];
    $paymentMethod = $row['paymentMethod'];
    $deliveryMethod = $row['deliveryMethod'];
    $orderStatus = $row['orderStatus'];
    // Define status descriptions
    $statusDescriptions = array(
        0 => 'Order Placed',
        1 => 'Order Confirmed',
        2 => 'Preparing your Order',
        3 => 'Your order is on the way!',
        4 => 'Order Delivered',
        5 => 'Order Denied',
        6 => 'Order Cancelled'
    );

      // Get the description for the current order status
      $statusDescription = isset($statusDescriptions[$orderStatus]) ? $statusDescriptions[$orderStatus] : 'Please Upload Payment First';
   
// Define an associative array with delivery methods and their corresponding fees
$deliveryFees = array(
    'deliverybatamkota' => 20000,
    'deliverybatuaji' => 20000,
    'deliverybatuampar' => 15000,
    'deliverybengkong' => 15000,
    'deliverylubukbaja' => 15000,
    'deliverynongsa' => 25000,
    'deliverysagulung' => 20000,
    'deliveryseibeduk' => 20000,
    'deliverysekupang' => 10000
);

// Check if the selected delivery method exists in the array and add the corresponding fee
if (array_key_exists($deliveryMethod, $deliveryFees)) {
    $amount += $deliveryFees[$deliveryMethod];
} else {
    // Handle the case where no valid delivery method is selected or default option
    $amount += 0; // No additional charge for unspecified or default delivery methods
}
    // ...

    // Tampilkan data order dalam tabel seperti yang sudah Anda implementasikan sebelumnya
// Tampilkan data order dalam tabel seperti yang sudah Anda implementasikan sebelumnya
echo '<tr>
    <td>' . $orderId . '</td>
    <td>' . substr($address, 0, 20) . '</td>
    <td>' . $amount . '</td>
    <td>' . $deliveryDate . ' ' . $deliveryTime . '</td>
    <td>' . $statusDescription . '</td>
    <td>';

// Display payment proof or upload form based on the status
if ($orderStatus != 5 && $orderStatus != 6) {
    if (!empty($row['proofFile'])) {
        echo '<img src="' . $row['proofFile'] . '" width="100" height="100" alt="Proof Image">';
    } else {
        // Display upload form if payment proof is not available
        echo '<form id="uploadForm' . $orderId . '" class="uploadForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="proofFile"></label>
                    <input type="file" class="form-control-file" id="proofFile' . $orderId . '" name="proofFile">
                </div>
                <input type="hidden" name="orderId" value="' . $orderId . '">
                <button type="submit" class="btn btn-primary uploadProofBtn" style="background-color: #2A403D; margin-right:70px;" disabled>Upload Payment</button>
            </form>';
    }
}

echo '</td>
    <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" style="color:#2A403D;" title="View Details"><i class="material-icons" style="color:#2A403D;">&#xE5C8;</i></a></td>
    <td><a href="#" data-toggle="modal" data-target="#orderDetailModal' . $orderId . '" class="btn btn-primary" style="background-color: #2A403D; color:white; margin-bottom: 5px; width: 73px;">Detail</a>';

// Only display the "Delete" button if the status is 0
if ($orderStatus == 0 && empty($row['proofFile'])) {
    echo '<a href="javascript:void(0);" class="btn btn-danger deleteOrder" style="background-color: #E44E5D; color: white;" data-id="' . $orderId . '">Cancel</a></td>';
} else {
    echo '</td>'; // Empty cell if no delete button is displayed
}

echo '</tr>';


// Modal Detail Pesanan
echo '<div id="orderDetailModal' . $orderId . '" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Detail</h5>                 
                   
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p><strong>Order ID:</strong> ' . $orderId . '</p>
                 
                    <p><strong>Address:</strong> ' . $address . '</p>
                
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
                        <button type="submit" class="btn btn-primary">Upload</button>
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
            <div class="alert alert-danger" style="background-color:#E44E5D; color:white;" role="alert">
            You must login to view this page <a href="login.php" class="alert-link" style="color:white;">Login Here</a>
            </div>
        </div>
    <?php endif; ?>
  

    <!-- <?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php';?> 
    <?php require 'partials/_footer.php';?>  -->
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-oP2lDJ3neGNoFZXyec3HGn/O/7tf8F0uGvtz/r/oZ0I=" crossorigin="anonymous"></script>

    <script>
$(document).ready(function() {
    $('.uploadForm').on('change', '.form-control-file', function() {
        var fileInput = $(this);
        var file = fileInput[0].files[0]; // Ambil file pertama dari input

        var uploadButton = fileInput.closest('.uploadForm').find('.uploadProofBtn');
        if (file) {
            uploadButton.prop('disabled', false); // Aktifkan tombol jika ada file yang dipilih
        } else {
            uploadButton.prop('disabled', true); // Nonaktifkan tombol jika tidak ada file yang dipilih
        }
    });

    $('.uploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData($(this)[0]); // Ambil data form sebagai FormData
        var orderId = $(this).find('input[name="orderId"]').val(); // Ambil orderId dari form
        
        $.ajax({
            url: 'upload_proof.php', // URL endpoint untuk upload
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle response dari server setelah upload berhasil
                console.log('Upload berhasil:', response);
                // Tambahkan notifikasi
                $('#notifContainer').html('<div class="alert alert-success" role="alert">File berhasil diupload.</div>');
                // Tambahkan logika untuk menampilkan notifikasi atau melakukan update halaman
            },
            error: function(xhr, status, error) {
                // Handle error saat upload gagal
                console.error('Upload gagal:', error);
                // Tambahkan notifikasi error jika perlu
                $('#notifContainer').html('<div class="alert alert-danger" role="alert">Upload gagal. Silakan coba lagi.</div>');
                // Tambahkan logika untuk menampilkan pesan error kepada pengguna
            }
        });
    });
    // Handle delete action
    $('.deleteOrder').on('click', function() {
    const orderId = $(this).data('id');
    if (confirm('Are you sure you want to delete this order?')) {
        $.ajax({
            url: 'delete_order.php',
            type: 'POST',
            data: { orderId: orderId },
            dataType: 'json', // Pastikan format respons diharapkan JSON
            success: function(response) {
                if (response.success) {
                    location.reload(); // Refresh halaman setelah penghapusan sukses
                } else {
                    $('#notifContainer').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                $('#notifContainer').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
            }
        });
    }
});

});


</script>

</body>
</html>