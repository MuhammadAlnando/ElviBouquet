<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Enter Your Details:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm" action="partials/_manageCart.php" method="post">
                    <div class="form-group">
                        <label for="address"><b>Address:</b></label>
                        <input class="form-control" id="address" name="address" placeholder="tiban mas blok x #1" type="text" required minlength="3" maxlength="500">
                    </div>
                    <div class="form-group">
                        <label for="message"><b>Message:</b></label>
                        <input class="form-control" id="message" name="message" placeholder="Greeting card or paper color request" type="text">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone"><b>Phone No:</b></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color:#C3CBD6;" id="basic-addon">+62</span>
                                </div>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx" required pattern="[0-9]{12}" maxlength="12">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zipcode"><b>Zip Code:</b></label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="xxxxxx" required pattern="[0-9]{6}" maxlength="6">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deliveryMethod"><b>Delivery:</b></label>
                        <select class="form-control" id="deliveryMethod" name="deliveryMethod" required>
                            <?php
                            $deliveryMethod = isset($_SESSION['deliveryMethod']) ? $_SESSION['deliveryMethod'] : 'pickup';
                            ?>
                            <option value="pickup" <?php echo ($deliveryMethod === 'pickup') ? 'selected' : ''; ?>>Pickup (Free)</option>
                            <option value="deliverybatamkota" <?php echo ($deliveryMethod === 'deliverybatamkota') ? 'selected' : ''; ?>>Batam Kota (+Rp. 20,000)</option>
                            <option value="deliverybatuaji" <?php echo ($deliveryMethod === 'deliverybatuaji') ? 'selected' : ''; ?>>Batu Aji (+Rp. 20,000)</option>
                            <option value="deliverybatuampar" <?php echo ($deliveryMethod === 'deliverybatuampar') ? 'selected' : ''; ?>>Batu Ampar (+Rp. 15,000)</option>
                            <option value="deliverybengkong" <?php echo ($deliveryMethod === 'deliverybengkong') ? 'selected' : ''; ?>>Bengkong (+Rp. 15,000)</option>
                            <option value="deliverylubukbaja" <?php echo ($deliveryMethod === 'deliverylubukbaja') ? 'selected' : ''; ?>>Lubuk Baja (+Rp. 15,000)</option>
                            <option value="deliverynongsa" <?php echo ($deliveryMethod === 'deliverynongsa') ? 'selected' : ''; ?>>Nongsa (+Rp. 25,000)</option>
                            <option value="deliverysagulung" <?php echo ($deliveryMethod === 'deliverysagulung') ? 'selected' : ''; ?>>Sagulung (+Rp. 20,000)</option>
                            <option value="deliveryseibeduk" <?php echo ($deliveryMethod === 'deliveryseibeduk') ? 'selected' : ''; ?>>Sei Beduk (+Rp. 20,000)</option>
                            <option value="deliverysekupang" <?php echo ($deliveryMethod === 'deliverysekupang') ? 'selected' : ''; ?>>Sekupang (+Rp. 10,000)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deliveryDate"><b>Delivery/Pickup Date:</b></label>
                        <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                    </div>

                    <div class="form-group">
                        <label for="deliveryTime"><b>Delivery Time:</b></label>
                        <select class="form-control" id="deliveryTime" name="deliveryTime" required>
                            <option value="">Select Delivery Time</option>
                            <option value="09:00 - 12.00">09:00 - 12.00</option>
                            <option value="14:00 - 17.00">14:00 - 17.00</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="paymentMethod"><b>Payment:</b></label>
                        <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                            <option value="transfer">BANK BCA = 32009324232 an/ Elvi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password"><b>Password:</b></label>
                        <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="background-color: #C3CBD6; color:black;" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                        <button type="submit" form="checkoutForm" name="checkout" class="btn btn-success" style="background-color:#2A403D; color:white;">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize min date for deliveryDate input to be one day in the future
        let today = new Date();
        today.setDate(today.getDate() + 1);
        let formattedDate = today.toISOString().split('T')[0];
        $('#deliveryDate').attr('min', formattedDate);

        $('#checkoutForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Submit the form using AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    // On success, redirect to the order view page
                    window.location.href = 'viewOrder.php';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors as needed
                }
            });
        });
    });
</script>
