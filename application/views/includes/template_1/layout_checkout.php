<div class='col-md-6'>
	<?php echo validation_errors('<span color="red">*</span>'); ?>
	<form action="<?php echo base_url(); ?>confirm/process" method="post" accept-charset="utf-8" enctype="multipart/form-data" name="Form">
		<h4>First Name: <input type="text" name="first" value="<?php echo !empty($first) ? $first : set_value('first'); ?>" size="10" maxlength="20"></h4>
		<h4>Last Name: <input type="text" name="last" value="<?php echo !empty($last) ? $last : set_value('last'); ?>" size="20" maxlength="30"></h4>
		<h4><span style="color:#DCDCDC">Company / Care Of / Building / Other:</span> <input type="text" name="company" value="<?php echo !empty($company) ? $company : set_value('company'); ?>" size="20" maxlength="40"></h4>
		<h4>Email Address: <input type="text" name="email" value="<?php echo !empty($email) ? $email : set_value('email'); ?>" size="30" maxlength="50"></h4>
		<h4><span style="color:#DCDCDC">Phone:</span> <input type="text" name="phone" value="<?php echo !empty($phone) ? $phone : set_value('phone'); ?>" size="30" maxlength="30"></h4>
		<h4>Address 1: <input type="text" name="address1" value="<?php echo !empty($address1) ? $address1 : set_value('address1'); ?>" size="30" maxlength="60"></h4>
		<h4><span style="color:#DCDCDC">Address 2:</span> <input type="text" name="address2" value="<?php echo !empty($address2) ? $address2 : set_value('address2'); ?>" size="30" maxlength="60"></h4>
		<h4>Town/City: <input type="text" name="city" value="<?php echo !empty($city) ? $city : set_value('city'); ?>" size="30" maxlength="60"></h4>
		<h4>State/County: <input type="text" name="state" value="<?php echo !empty($state) ? $state : set_value('state'); ?>" size="10" maxlength="20">
		Country <select name="country" selected="<?php echo !empty($country) ? $country : set_value('country'); ?>"><?php echo $country_array; ?></select></h4>
		<h4>Postcode/Zip: <input type="text" name="zip" value="<?php echo !empty($zip) ? $zip : set_value('zip'); ?>" size="20" maxlength="20"></h4>
		<br />
		<h4>Ship to a different address?<input type="checkbox" id="different" name="different" value="y" <?php echo !empty($different) ? $different : set_value('different'); ?>></h4>
		<br />
		<div id="slide-down">
			<h4>First Name:</strong> <input type="text" name="first_2" value="<?php echo !empty($first_2) ? $first_2 : set_value('first_2'); ?>" size="10" maxlength="20">
			<h4>Last Name:</strong> <input type="text" name="last_2" value="<?php echo !empty($last_2) ? $last_2 : set_value('last_2'); ?>" size="20" maxlength="30"></h4>
			<h4>Address 1:</strong> <input type="text" name="address1_2" value="<?php echo !empty($address1_2) ? $address1_2 : set_value('address1_2'); ?>" size="30" maxlength="60"></h4>
			<h4><span style="color:#DCDCDC">Address 2:</span></strong> <input type="text" name="address2_2" value="<?php echo !empty($address2_2) ? $address2_2 : set_value('address2_2'); ?>" size="30" maxlength="60"></h4>
			<h4>Town/City:</strong> <input type="text" name="city_2" value="<?php echo !empty($city_2) ? $city_2 : set_value('city_2'); ?>" size="30" maxlength="60"></h4>
			<h4>State/County:</strong> <input type="text" name="state_2" value="<?php echo !empty($state_2) ? $state_2 : set_value('state_2'); ?>" size="10" maxlength="20">
			Country</strong> <select name="country_2" selected="<?php echo !empty($country_2) ? $country_2 : set_value('country_2'); ?>"><?php echo $country_array_2; ?></select></h4>
			<h4>Postcode/Zip:</strong> <input type="text" name="zip_2" value="<?php echo !empty($zip_2) ? $zip_2 : set_value('zip_2'); ?>" size="20" maxlength="20"></h4>
		</div>
		<br />
		<strong>Order Notes:</strong><br /><textarea name="notes" cols="69" rows="5"><?php echo !empty($notes) ? $notes : set_value('notes'); ?></textarea><br /><br />
		<span class='glyphicon glyphicon-shopping-cart btn btn-lg btn-success m-b-10px'><input type="submit" name="submit" value="Submit"></span>
</div>
<div class='col-md-6'>
<?php if(count($_SESSION['cart']) > 0): 
	foreach ($stmts as $row):
		$id = $row->id;
		$price = $row->price;
		$name = $row->name;
        $quantity = $_SESSION['cart'][$id]['quantity'];
        $sub_total = $price * $quantity;
?>
 		<div class='cart-row'>
            <div class='col-md-8'>
 				<div class='product-name m-b-10px'><h4><?php echo $name; ?></h4></div>
                <?php echo $quantity > 1 ? "<div>{$quantity} items</div>" : "<div>{$quantity} item</div>"; ?>
 			</div>
 
            <div class='col-md-4'>
                <h4>&#36;<?php echo number_format($price, 2, '.', ','); ?></h4>
            </div>
        </div>
 	<?php
        $item_count += $quantity;
        $total += $sub_total;
    	endforeach;
    ?>
    <div class='cart-row'>
    <div class='col-md-8'>
    <h4>Shipping: &#36;<?php echo number_format($shipping, 2, '.', ','); ?></h4>
    </div>
    </div>
    <div class='col-md-12 text-align-center'>
        <div class='cart-row'>
            <?php if($item_count > 1): ?>
                <h4 class='m-b-10px'>Total (<?php echo $item_count; ?> items)</h4>
            <?php else: ?>
                <h4 class='m-b-10px'>Total (<?php echo $item_count; ?> item)</h4>
            <?php endif; ?>
            <h4>&#36;<?php 
            			$grand_total = $total + $shipping;
            			echo number_format($grand_total, 2, '.', ','); ?></h4>
    			<div class="radio">
  					<label>
    					<input type="radio" name="processor" id="optionsRadios1" value="stripe" checked>
    					<h4>Pay With Stripe <img src="<?php echo base_url(); ?>uploads/credit-cards/visa.svg" alt="Visa" width="32" style="margin-left: 0.3em">
    									<img src="<?php echo base_url(); ?>uploads/credit-cards/mastercard.svg" alt="Mastercard" width="32" style="margin-left: 0.3em">
    									<img src="<?php echo base_url(); ?>uploads/credit-cards/amex.svg" alt="Amex" width="32" style="margin-left: 0.3em">
    									<img src="<?php echo base_url(); ?>uploads/credit-cards/discover.svg" alt="Discover" width="32" style="margin-left: 0.3em">
    									<img src="<?php echo base_url(); ?>uploads/credit-cards/jcb.svg" alt="JCB" width="32" style="margin-left: 0.3em">
    									<img src="<?php echo base_url(); ?>uploads/credit-cards/diners.svg" alt="Diners" width="32" style="margin-left: 0.3em">
    					</h4>
    				</label>
				</div>
				<div class="radio">
  					<label>
    					<input type="radio" name="processor" id="optionsRadios2" value="paypal">
    					<!--<h4>Pay With Paypal <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" alt="PayPal Acceptance Mark" width="150px" height="55px"></h4>-->
    					<h4>PayPal <a href="https://www.paypal.com/us/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" title="What is PayPal?">What is PayPal?</a> <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" alt="PayPal Acceptance Mark" width="150px" height="55px"></h4>
  					</label>
				</div>
			</form>
        </div>
    </div>
<?php endif; ?>
</div