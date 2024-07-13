<!-- Checkout Modal -->
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
                <form action="partials/_manageCart.php" method="post">
                    <div class="form-group">
                        <label for="address"><b>Address:</b></label>
                        <input class="form-control" id="address" name="address" placeholder="1234 Main St" type="text" required minlength="3" maxlength="500">
                    </div>
                    <div class="form-group">
                        <label for="message"><b>Kartu Ucapan:</b></label>
                        <input class="form-control" id="message" name="message" placeholder="near st, Surat, Gujarat" type="text">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone"><b>Phone No:</b></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon">+62</span>
                                </div>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx" required pattern="[0-9]{10}" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zipcode"><b>Zip Code:</b></label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="xxxxxx" required pattern="[0-9]{6}" maxlength="6">
                        </div>
                    </div>
                    
                    <div class="form-group">
    <label for="deliveryMethod"><b>Delivery Method:</b></label>
    <select class="form-control" id="deliveryMethod" name="deliveryMethod" required>
        <?php
        $deliveryMethod = isset($_SESSION['deliveryMethod']) ? $_SESSION['deliveryMethod'] : 'pickup';
        ?>
        <option value="pickup" <?php echo ($deliveryMethod === 'pickup') ? 'selected' : ''; ?>>Pickup</option>
        <option value="delivery" <?php echo ($deliveryMethod === 'delivery') ? 'selected' : ''; ?>>Delivery (+Rp. 15,000)</option>
    </select>
</div>




<div class="form-group">
    <label for="deliveryDate"><b>Delivery/Pickup Date:</b></label>
    <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" required min="<?php echo date('Y-m-d'); ?>">
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
    <label for="paymentMethod"><b>Payment Method:</b></label>
    <select class="form-control" id="paymentMethod" name="paymentMethod" required>
        <option value="cash">Cash on Delivery</option>
        <option value="transfer">Bank Transfer</option>
    </select>
</div>
<div class="form-group">
                        <label for="password"><b>Password:</b></label>
                        <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                        <button type="submit" name="checkout" class="btn btn-success">Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
