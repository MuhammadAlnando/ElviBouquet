<style>
    .btn-danger-gradiant {
        background: linear-gradient(to right, #ff4d7e 0%, #ff6a5b 100%);
    }

    .btn-danger-gradiant:hover {
        background: linear-gradient(to right, #ff6a5b 0%, #ff4d7e 100%);
    }
</style>
<div>
<div class="modal-header" style="background-color: #4b5366; color: #fff; border-bottom: none; margin-top: 80px; border-radius: 10px;">

  </div>
    
</div>
<div class="container-fluid" id='empty'>	
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: #DCC0FF;">
                        <tr>
                            <th>Id</th>
                            <th>UserId</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Order Id</th>
                            <th>Message</th>
                            <th>Datetime</th>
                            <th>Image</th>
                            <th>Reply</th>
                            <th>Action</th> <!-- Kolom baru untuk tombol Lihat Pesan -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM contact"; 
                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)) {
                                $contactId = $row['contactId'];
                                $userId = $row['userId'];
                                $email = $row['email'];
                                $phoneNo = $row['phoneNo'];
                                $orderId = $row['orderId'];
                                $message = $row['message'];
                                $time = $row['time'];
                                $image = '../assets/img/contact/' . $row['image']; // Adjust path as per your project structure
                                $count++;

                                echo '<tr>
                                        <td>' . $contactId . '</td>
                                        <td>' . $userId . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $phoneNo . '</td>
                                        <td>' . $orderId . '</td>
                                        <td>' . $message . '</td>
                                        <td>' . $time . '</td>
                                        <td><a href="#" data-toggle="modal" data-target="#viewImage' . $contactId . '"><img src="' . $image . '" alt="contact image" style="width: 100px; height: auto;"></a></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#reply' . $contactId . '">Reply</button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#viewMessage' . $contactId . '">View Message</button>
                                        </td>
                                    </tr>';
                            }
                            if ($count == 0) {
                                echo '<script>
                                        document.getElementById("notempty").innerHTML = 
                                            \'<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> 
                                                You have not received any message!
                                            </div>\';
                                        document.getElementById("empty").innerHTML = "";
                                      </script>';
                            }
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-danger text-dark border-0 py-2 px-3" style="background-color: #DCC0FF;" data-toggle="modal" data-target="#history">
        <span> HISTORY <i class="ti-arrow-right"></i></span>
    </button>
            </div>
        </div>
    </div>
</div>

<?php 
    $contactsql = "SELECT * FROM `contact`";
    $contactResult = mysqli_query($conn, $contactsql);
    while ($contactRow = mysqli_fetch_assoc($contactResult)) {
        $contactId = $contactRow['contactId'];
        $Id = $contactRow['userId'];
        $email = $contactRow['email'];
        $phoneNo = $contactRow['phoneNo'];
        $orderId = $contactRow['orderId'];
        $message = $contactRow['message'];
        $time = $contactRow['time'];
        $image = '../assets/img/contact/' . $contactRow['image']; // Adjust path as per your project structure
?>

<!-- Reply Modal -->
<div class="modal fade" id="reply<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-labelledby="reply<?php echo $contactId; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC0FF;">
                <h5 class="modal-title" id="reply<?php echo $contactId; ?>">Reply (Contact Id: <?php echo $contactId; ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="partials/_contactManage.php" method="post">
                    <div class="text-left my-2">
                        <b><label for="message">Message: </label></b>
                        <textarea class="form-control" id="message" name="message" rows="2" required minlength="5"></textarea>
                    </div>
                    <input type="hidden" id="contactId" name="contactId" value="<?php echo $contactId; ?>">
                    <input type="hidden" id="userId" name="userId" value="<?php echo $Id; ?>">
                    <button type="submit" class="btn btn-success" name="contactReply">Reply</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="viewMessage<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-labelledby="viewMessage<?php echo $contactId; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC0FF;">
                <h5 class="modal-title" id="viewMessage<?php echo $contactId; ?>">View Message (Contact Id: <?php echo $contactId; ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $message; ?></p>
                <?php if (!empty($image)) : ?>
                            <p><strong>Image:</strong></p>
                            <a href="#" data-toggle="modal" data-target="#viewImage<?php echo $contactId; ?>">
                                <img src="<?php echo $image; ?>" alt="contact image" style="width: 100%; max-width: 300px; height: auto;">
                            </a>
                        <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Zoom -->
<div class="modal fade" id="viewImage<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-labelledby="viewImage<?php echo $contactId; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC0FF;">
                <h5 class="modal-title" id="viewImage<?php echo $contactId; ?>">Zoom Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo $image; ?>" alt="contact image" style="max-width: 100%; max-height: 80vh;">
            </div>
        </div>
    </div>
</div>

<?php
    }
?>

<!-- History Modal -->
<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(187 188 189);">
                <h5 class="modal-title" id="history">Your Sent Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="notReply">
                <table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: #DCC0FF;">
                        <tr>
                            <th>Contact Id</th>
                            <th>Reply Message</th>
                            <th>Datetime</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $sql = "SELECT * FROM `contactreply`"; 
                        $result = mysqli_query($conn, $sql);
                        $totalReply = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $contactId = $row['contactId'];
                            $message = $row['message'];
                            $datetime = $row['datetime'];
                            $totalReply++;

                            echo '<tr>
                                    <td>' . $contactId . '</td>
                                    <td>' . $message . '</td>
                                    <td>' . $datetime . '</td>
                                  </tr>';
                        }    

                        if ($totalReply == 0) {
                            echo '<script>
                                    document.getElementById("notReply").innerHTML = 
                                        \'<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> 
                                            You have not replied to any message!
                                        </div>\';
                                  </script>';
                        }   
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
