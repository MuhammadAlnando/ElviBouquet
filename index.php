<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <title>Home</title>
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <style>
    .card-img-top {
      object-fit: cover;
      height: 250px;
      /* Set the height of the image */
    }
  </style>
</head>

<body>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php require 'partials/_nav.php' ?>

  <!-- Category container starts here -->
  <div class="container my-3 mb-5">
    <!-- Image section -->
    <div class="row my-4">
      <div class="col-md-12 text-center">
        <img src="img/backgroundhome.jpg" alt="Description of image" class="img-fluid"
          style="max-width: 100%; border-radius: 10px 500px 50px 500px;">
      </div>
    </div>
    <!-- Reasons section starts here -->
    <div class="row mt-5">
      <div class="col-md-12 text-center">
        <h2 style="color:#2A403D;">Why Choose Us?</h2>
        <p>Here are three compelling reasons:</p>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-4 text-center">
        <i class="fas fa-heart fa-3x mb-3" style="color: #2A403D;"></i>
        <h5 style="color:#2A403D;">Quality Products</h5>
        <p>We use only high-quality artificial flowers that look just like real ones, ensuring each bouquet is beautiful and long-lasting.</p>
      </div>
      <div class="col-md-4 text-center">
         <i class="fas fa-seedling fa-3x mb-3" style="color: #2A403D;"></i>
         <h5 style="color:#2A403D;">Personalized Arrangements</h5>
          <p>Our skilled florists craft each bouquet with meticulous attention to detail, tailoring each arrangement to your specific needs and preferences.</p>
      </div>
      <div class="col-md-4 text-center">
        <i class="fas fa-truck fa-3x mb-3" style="color: #2A403D;"></i>
        <h5 style="color:#2A403D;">Reliable Delivery</h5>
        <p>We offer prompt and reliable delivery services, ensuring your bouquet arrives in perfect condition</p>
      </div>
      

    </div>
    <div class="row mt-5">
      <div class="col-md-12 text-center">
        <h2>Bouquet Category</h2>
        <hr>
      </div>
    </div>

    <!-- Card deck for categories -->
    <div class="row">
      <!-- Fetch all the categories and use a loop to iterate through categories -->
      <?php
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['categorieId'];
        $cat = $row['categorieName'];
        $desc = $row['categorieDesc'];
        echo '<div class="col-md-3 mb-4">
                <div class="card">
                  <img src="img/category/card-' . $id . '.jpg" class="card-img-top" alt="image for this category">
                  <div class="card-body">
                    <h5 class="card-title"><a href="viewBouquetList.php?catid=' . $id . '" style="color: black;">' . $cat . '</a></h5>
                    <p class="card-text">' . substr($desc, 0, 50) . '...</p>
                    <a href="viewBouquetList.php?catid=' . $id . '" class="btn btn-primary btn-sm" style="background-color: #2A403D; border: none; color: white;">View All</a>
                  </div>
                </div>
              </div>';
      }
      ?>
    </div>

    

  </div>

  <?php require 'partials/_footer.php' ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
</body>

</html>