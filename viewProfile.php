<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="htmlcss bootstrap menu, navbar, mega menu examples" />
    <meta name="description" content="Bootstrap navbar examples for any type of project, Bootstrap 4" />

    <title>Profile</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php require 'partials/_nav.php' ?>
    <?php

    if ($loggedin) {
        $sql = "SELECT * FROM users WHERE id='$userId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $phone = $row['phone'];
        $userType = $row['userType']; // Pastikan variabel $userType didefinisikan di sini

        // Periksa dan inisialisasi $userType jika belum ada
        if (!isset($userType)) {
            $userType = ""; // Atau tetapkan nilai default lainnya
        }

        // Konversi nilai userType jika perlu
        if ($userType == 0) {
            $userType = "User";
        } else {
            $userType = "Admin";
        }
    ?>

    <div class="container mt-5"> <!-- Tambahkan class mt-5 untuk margin atas -->
        <div class="row justify-content-center">
            <!-- <div class="col-md-4">
                <div class="content-panel mb-3 text-center">
                    <img class="rounded-circle mb-3 bg-dark" src="img/person-<?php echo $userId; ?>.jpg"
                        onError="this.src = 'img/profilePic.jpg'" style="width: 215px; height: 215px; padding: 1px;">
                    <form action="partials/_manageProfile.php" method="POST">
                        <small>Remove Image: </small><button type="submit" class="btn btn-primary"
                            name="removeProfilePic"
                            style="font-size: 12px; padding: 3px 8px; border-radius: 9px; background-color:#2A403D; color:C3CBD6; border: none;">remove</button>
                    </form>
                    <form action="partials/_manageProfile.php" method="POST" enctype="multipart/form-data">
                        <div class="upload-btn-wrapper">
                            <small>Change Image:</small>
                            <button class="btn upload">choose</button>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>
                        <button type="submit" name="updateProfilePic" class="btn btn-primary"
                            style="font-size: 15px; padding: 3px 8px; background-color:#2A403D; color:C3CBD6; border: none;">Update</button>
                    </form>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="content-panel mb-3">
                    <h2 class="title text-center">Profile <span
                            class="pro-label label label-warning">(<?php echo $userType ?>)</span></h2>
                    <form action="partials/_manageProfile.php" method="post">
                        <div class="form-group">
                            <b><label for="username">Username:</label></b>
                            <input class="form-control" id="username" name="username" type="text" disabled
                                value="<?php echo $username ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <b><label for="firstName">First Name:</label></b>
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="First Name" required value="<?php echo $firstName ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <b><label for="lastName">Last Name:</label></b>
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="Last name" required value="<?php echo $lastName ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <b><label for="email">Email:</label></b>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Your Email" required value="<?php echo $email ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <b><label for="phone">Phone No:</label></b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon">+62</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="Enter Your Phone Number" required pattern="[0-9]{12}"
                                        maxlength="10" value="<?php echo $phone ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <b><label for="password">Password:</label></b>
                                <input class="form-control" id="password" name="password" placeholder="Enter Password"
                                    type="password" required minlength="4" maxlength="21" data-toggle="password">
                            </div>
                        </div>
                        <button type="submit" name="updateProfileDetail" class="btn btn-primary" style="background-color:#2A403D; color:C3CBD6; border:none;">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    } else {
        echo '<div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <h1>Oops!</h1>
                    </div>
                    <h2>404 - Page not found</h2>
                    <a href="index.php">Go To Homepage</a>
                </div>
            </div>';
    }
    ?>
    <?php require 'partials/_footer.php' ?>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script>
        $('#image').change(function () {
            var i = $(this).prev('button').clone();
            var file = ($('#image')[0].files[0].name).substring(0, 5) + "..";
            $(this).prev('button').text(file);
        });
    </script>
</body>

</html>
