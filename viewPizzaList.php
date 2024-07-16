<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />

    <title id="title">Category</title>
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <style>
    .jumbotron {
        padding: 2rem 1rem;
    }
    #cont {
        min-height: 570px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php require 'partials/_nav.php'; ?>

    <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE categorieId = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $catname = $row['categorieName'];
            $catdesc = $row['categorieDesc'];
        }
    ?>

    <!-- Pizza container starts here -->
    <div class="container my-3" id="cont">
        <div class="row">
            <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `pizza` WHERE pizzaCategorieId = $id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $pizzaId = $row['pizzaId'];
                $pizzaName = $row['pizzaName'];
                $pizzaPrice = $row['pizzaPrice'];
                $pizzaDesc = $row['pizzaDesc'];

                echo '<div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="img/pizza-' . $pizzaId . '.jpg" class="card-img-top" alt="image for this pizza" width="249px" height="270px">
                            <div class="card-body">
                                <h5 class="card-title">' . substr($pizzaName, 0, 20) . '</h5>
                                <h6 style="color: #ff0000">Rp. ' . $pizzaPrice . '</h6>
                                <p class="card-text">' . substr($pizzaDesc, 0, 29) . '</p>
                                <div class="row justify-content-center">';

                if ($loggedin) {
                    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
                    $quaresult = mysqli_query($conn, $quaSql);
                    $quaExistRows = mysqli_num_rows($quaresult);
                    if ($quaExistRows == 0) {
                        echo '<button type="button" class="btn btn-primary mx-2" style="background-color: #DCC0FF; border:none; color: black;" data-toggle="modal" data-target="#quickViewModal"
                              data-id="' . $pizzaId . '"
                              data-name="' . $pizzaName . '"
                              data-price="Rp. ' . $pizzaPrice . '"
                              data-desc="' . $pizzaDesc . '"
                              data-img="img/pizza-' . $pizzaId . '.jpg">
                                Add to Cart
                              </button>';
                    } else {
                        // Already in cart
                        echo '<span class="text-success mx-2">Added to Cart</span>';
                    }
                } else {
                    echo '<button type="button" class="btn btn-primary mx-2" style="background-color: #DCC0FF; border:none; color: black;" data-toggle="modal" data-target="#loginModal">
                            Add to Cart
                          </button>';
                }

                echo '<button type="button" class="btn btn-primary quick-view-btn mx-2" 
                        style="background-color: #DCC0FF; border:none; color: black;"
                        data-toggle="modal" 
                        data-target="#quickViewModal"
                        data-id="' . $pizzaId . '"
                        data-name="' . $pizzaName . '"
                        data-price="Rp. ' . $pizzaPrice . '"
                        data-desc="' . $pizzaDesc . '"
                        data-img="img/pizza-' . $pizzaId . '.jpg">
                          Detail
                      </button>
                    </div>
                  </div>
                </div>
              </div>';

            }
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">Sorry In this category No items available.</p>
                            <p class="lead"> We will update Soon.</p>
                        </div>
                      </div> ';
            }
            ?>
        </div>
    </div>

    <?php require 'partials/_footer.php'; ?>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quickViewName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <a id="quickViewLinkImg" href="" data-lightbox="image-1">
                                    <img id="quickViewImage" src="" class="img-fluid" alt="Product Image">
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h5 id="quickViewPrice" style="color: #ff0000;"></h5>
                                <p id="quickViewDesc"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <?php
                            if ($loggedin) {
                                // Check if item is already in cart
                                if ($quaExistRows == 0) {
                                    echo '<button id="addToCartBtn" type="button" class="btn btn-primary mx-2" style="background-color: #DCC0FF; border:none; color: black;">
                                            Add to Cart
                                          </button>';
                                } else {
                                    echo '<a href="viewCart.php"><button class="btn btn-primary mx-2" style="background-color: #DCC0FF; border:none; color: black;">
                                            Go to Cart
                                          </button></a>';
                                }
                            } else {
                                echo '<button type="button" class="btn btn-primary mx-2" style="background-color: #DCC0FF; border:none; color: black;" data-toggle="modal" data-target="#loginModal">
                                        Add to Cart
                                      </button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        $('.quick-view-btn').on('click', function() {
            var pizzaId = $(this).data('id');
            var pizzaName = $(this).data('name');
            var pizzaPrice = $(this).data('price');
            var pizzaDesc = $(this).data('desc');
            var pizzaImg = $(this).data('img');

            // Set data to modal fields
            $('#quickViewImage').attr('src', pizzaImg);
            $('#quickViewLinkImg').attr('href', pizzaImg);
            $('#quickViewName').text(pizzaName);
            $('#quickViewPrice').text(pizzaPrice);
            $('#quickViewDesc').text(pizzaDesc);
            $('#quickViewModal').modal('show');

            // Handle Add to Cart button click
            $('#addToCartBtn').off('click').on('click', function(e) {
                e.preventDefault(); // Prevent default form submit
                // AJAX request to add item to cart
                $.ajax({
                    type: 'POST',
                    url: 'partials/_manageCart.php',
                    data: { addToCart: true, itemId: pizzaId },
                    success: function(response) {
                        // Handle success, e.g., show message or update UI
                        alert('Item added to cart successfully!');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
