<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>About Us</title>
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_nav.php';?>

    <section id="about" class="about">
        <div class="container">
            <div class="section-title">
                <h2>About Us</h2>
                <p>Get to know us better</p>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <img src="assets/img/partials/about.jpg" class="img-fluid" style="width: 80%; margin-left: 100px; margin-top: -70px;" alt="About Us Image">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content">
                    <h3>Who We Are</h3>
                    <p class="font-italic">
                        Elvi Bouquet is a leading provider of creative floral arrangements and event decorations.
                    </p>
                    <ul>
                        <li><i class="icofont-check-circled"></i> We specialize in weddings, birthdays, and corporate events.</li>
                        <li><i class="icofont-check-circled"></i> Our team of skilled florists ensures top-quality designs.</li>
                        <li><i class="icofont-check-circled"></i> Located in a prime location, we serve clients across the region.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/_footer.php';?> 

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
