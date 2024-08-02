<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>About Us</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .btn-how-to-order, .btn-delivery, .btn-cancel-refund {
            background-color: #2A403D;
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

            <div class="row" style="display: flex;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.2998538167944!2d103.97047168391533!3d1.1048967870438695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98b84292219d7%3A0xf60567f26b182ad4!2sCluster%20Melati%20Residence!5e0!3m2!1sid!2sid!4v1722177100505!5m2!1sid!2sid" width="600" height="300" style="border:0; flex: 2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div style="flex: 1; padding-left: 20px;">
    <h5 class="card-title">Informasi Kontak</h5>
                    <ul class="list-unstyled">
                        <li style="margin: 10px 0;"><i class="fas fa-map-marker-alt"></i> Perumahan Cluster Melati Recidence, Blok F #11. Tiban - Sekupang. Kota Batam</li>
                        <li style="margin: 10px 0;"><i class="fas fa-envelope"></i> elvibouquet@gmail.com</li>
                        <li style="margin: 10px 0;"><i class="fas fa-phone"></i> +62-812-7712-4001</li>
                        <li style="margin: 10px 0;"><i class="fa fa-credit-card"></i> BCA: 0613285439 a/n Elvi</li>
                        <li>Work Hours:<br>
                            <b>Monday - Saturday <br>
                            8am - 5pm</b></li>
              
    </ul>
    </div>
</div>

            <br>
            <div class="section-title">
                <h2>FAQs</h2>
            </div?
            <div class="row">
                <div class="col-lg-12 text-center" style="margin-bottom: -30px;">
                    <button class="btn btn-how-to-order collapsed" style="color: white; width:40rem;" type="button" data-toggle="collapse" data-target="#howToOrder" aria-expanded="false" aria-controls="howToOrder">
                        Order
                    </button>
                    <div class="collapse" id="howToOrder">
                        <div class="card card-body">
                            <ul>
                                <p><H5><strong>We deliver bouquets all over Batam, starting from Rp 50.000 each.</strong></H5></p>
                                <strong>Will my bouquet look like the one in the catalogue?</strong>
                                <p>The arrangement will be the same as in catalogue.</p><br>
                                <strong>Can I request for specific bouquet to be / not to be in my bouquet?</strong>
                                <p>If you have specific flowers you would like us to include in your bouquet, do reach out to us or leave a remark on the check out page! However, please note that as much as we’ll try our best to fulfill them, we are unable to guarantee they will be included. If you have specific bouquets you would like us to avoid, do also leave a remark on the checkout page!</p><br>
                                <strong>What is included in my order?</strong>
                                <p>Your order will include your bouquet and a message card. Fret not - invoices / receipts are not included in the delivery to the recipient</p><br>
                                <strong>Are the prices on the website nett?</strong>
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
                            <strong>Do you accept walk-in purchases?</strong>
                            <p>Strictly no walk-in purchase allowed. Please place an order in advance through the website.</p>

                            <strong>Delivery time-slots & Order cut-off time</strong>
                            <p>All orders comes with complimentary standard delivery. Standard delivery time-slots are as below:<br>
                                    Delivery Slot 1: 9:00 AM - 12:00 PM<br>
                                    Delivery Slot 2: 1:00 PM - 5:00 PM<br
                                <em>*Note: Minimum order one day before</em></p>

                            <strong>Do you provide same-day delivery?</strong>
                            <p>We are no longer providing same-day delivery.</p>

                            <strong>Can I specify a delivery time?</strong>
                            <p>Unfortunately, we’re not able to do timed deliveries as our couriers go by the most efficient route of the day.</p>

                            <strong>Delivery Areas</strong>
                            <p>We deliver throughout Batam to homes, businesses, schools, etc. Please ensure your delivery address can be reached.</p>

                            <strong>How do I know my flowers have been delivered?</strong>
                            <p>You will receive an update on the 'orders' page. Please check your order status for confirmation.</p>

                            <strong>What happens if nobody is home to receive the bouquets?</strong>
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
                            <strong>Help! There’s a problem with my order! What can I do?</strong>
                            <p>OK, don’t panic. First, contact us as soon as you can with your order number.</p>

                            <strong>What if I'd like to cancel my order?</strong>
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
