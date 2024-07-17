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
    <style>
        .btn-how-to-order, .btn-delivery, .btn-cancel-refund {
            background-color: #748B6F;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            display: inline-block;
            margin: 10px auto;
            transition: background-color 0.3s ease;
        }

        .btn-how-to-order:hover, .btn-delivery:hover, .btn-cancel-refund:hover {
            background-color: #C3CBD6;
        }

        .btn-how-to-order.collapsed:before, .btn-delivery.collapsed:before, .btn-cancel-refund.collapsed:before {
            content: '+ ';
        }

        .btn-how-to-order:not(.collapsed):before, .btn-delivery:not(.collapsed):before, .btn-cancel-refund:not(.collapsed):before {
            content: '- ';
        }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_nav.php';?>

    <section id="about" class="about">
        <div class="container">
            <div class="section-title">
                <h2>About Us</h2>
                
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <img src="assets/img/partials/about.jpg" class="img-fluid" style="width: 80%; margin-left: 100px; margin-top: -70px;" alt="About Us Image">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content">

                    <h3>Vision</h3>
                    <p class="font-italic">
                        To inspire and delight our customers with the beauty of flowers, creating a joyful and uplifting experience through our expertly crafted bouquets and exceptional service.
                    </p>

                    <h3>Mission</h3>
                    <ul>
                        <li><i class="icofont-check-circled"></i> To provide expert advice and creative solutions for all needs, from everyday bouquets to bespoke arrangements for special events.</li>
                        <li><i class="icofont-check-circled"></i> To foster a culture of excellence and creativity within our team, encouraging continuous learning and professional growth.</li>
                        <li><i class="icofont-check-circled"></i> To engage with our community through events.</li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="section-title">
                <h2>FAQs</h2>
                
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="btn btn-how-to-order collapsed" style="color: white; width:40rem;" type="button" data-toggle="collapse" data-target="#howToOrder" aria-expanded="false" aria-controls="howToOrder">
                        How To Order
                    </button>
                    <div class="collapse" id="howToOrder">
                        <div class="card card-body">
                            <h4>How does it all work?</h4>
                            <ul>
                                <li><strong>We deliver bouquets all over Batam, starting from Rp 50.000 each.</strong></li>
                                <li><strong>Will my bouquet look like the one in the catalogue?</strong></li>
                                <p>The arrangement will be the same as in catalogue.</p>
                                <li><strong>Can I request for specific bouquet to be / not to be in my bouquet?</strong></li>
                                <p>If you have specific flowers you would like us to include in your bouquet, do reach out to us or leave a remark on the check out page! However, please note that as much as we’ll try our best to fulfill them, we are unable to guarantee they will be included. If you have specific bouquets you would like us to avoid, do also leave a remark on the checkout page! </p>
                                <li><strong>What is included in my order?</strong></li>
                                <p>Your order will include your bouquet and a message card. Fret not - invoices / receipts are not included in the delivery to the recipient. </p>
                                <li><strong>Are the prices on the website nett?</strong></li>
                                <p> Yes, the prices on the website are nett. </p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="btn btn-delivery collapsed" style="color: white; width:40rem;" type="button" data-toggle="collapse" data-target="#delivery" aria-expanded="false" aria-controls="delivery">
                        Delivery
                    </button>
                    <div class="collapse" id="delivery">
                        <div class="card card-body">
                            <h4>Do you accept walk-in purchases?</h4>
                            <p>Strictly no walk-in purchase allowed. Please place an order in advance through the website.</p>

                            <h4>Delivery time-slots & Order cut-off time</h4>
                            <p>All orders comes with complimentary standard delivery. Standard delivery time-slots are as below:</p>
                            <p><em>*Note: Minimum order one day before</em></p>
                            <ul>
                                <li>Delivery Slot 1: 9:00 AM - 12:00 PM</li>
                                <li>Delivery Slot 2: 1:00 PM - 5:00 PM</li>
                                <li>Delivery Slot 3: 6:00 PM - 9:00 PM</li>
                            </ul>

                            <h4>Do you provide same-day delivery?</h4>
                            <p>We are no longer providing same-day delivery.</p>

                            <h4>Can I specify a delivery time?</h4>
                            <p>Unfortunately, we’re not able to do timed deliveries as our couriers go by the most efficient route of the day.</p>

                            <h4>Delivery Areas</h4>
                            <p>We deliver throughout Batam to homes, businesses, schools, etc. Please ensure your delivery address can be reached.</p>

                            <h4>How do I know my flowers have been delivered?</h4>
                            <p>You will receive an update on the 'orders' page. Please check your order status for confirmation.</p>

                            <h4>What happens if nobody is home to receive the bouquets?</h4>
                            <p>It is your responsibility to ensure the recipient or someone is available to receive the bouquet on the selected delivery date and time-slot (include the phone number). We will not be liable for any losses or damages to the arrangements if they were delivered intact.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="btn btn-cancel-refund collapsed" style="color: white; width:40rem;" type="button" data-toggle="collapse" data-target="#cancelRefund" aria-expanded="false" aria-controls="cancelRefund">
                        Cancel & Refund
                    </button>
                    <div class="collapse" id="cancelRefund">
                        <div class="card card-body">
                            <h4>Help! There’s a problem with my order! What can I do?</h4>
                            <p>OK, don’t panic. First, contact us as soon as you can with your order number.</p>

                            <h4>What if I'd like to cancel my order?</h4>
                            <p>To make a cancellation, kindly contact us with your order number. All cancellations / refunds are subjected to a 20% administrative fee. Cancellations made less than 24 hours in advance will be subjected to a 50%.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php include 'partials/_footer.php';?> 

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.collapse').on('shown.bs.collapse', function(){
                $(this).parent().find(".btn").removeClass("collapsed");
            }).on('hidden.bs.collapse', function(){
                $(this).parent().find(".btn").addClass("collapsed");
            });
        });
    </script>
</body>
</html>
