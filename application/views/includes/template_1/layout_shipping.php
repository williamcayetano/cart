<a href="<?php echo base_url(); ?>cart"><-Back To Cart</a>
<div class="row">
	<div class='col-md-6'>
		<h4>Shipping</h4> <br />
		<h4><?php echo $first_name . " " . $last_name; ?></h4>
		<?php if(!empty($company)): ?>
			<h4><?php echo $company; ?></h4>
		<?php endif; ?>
		<h4><?php echo $address1; ?></h4>
		<?php if(!empty($address2)): ?>
			<h4><?php echo $address2; ?></h4>
		<?php endif; ?>
		<h4><?php echo $city . ", " . $state . " " . $zip; ?></h4>
		<h4><?php echo $country; ?></h4>
		<br />
		<a href="<?php echo base_url(); ?>checkout">Change Shipping Address</a> 
		<br />
	</div>
	<div class='col-md-6'>
		<h4>Billing</h4> <br />
		<h4><?php echo $first_name_billing . " " . $last_name_billing; ?></h4>
		<?php if(!empty($company_billing)): ?>
			<h4><?php echo $company_billing; ?></h4>
		<?php endif; ?>
		<?php if(!empty($phone)): ?>
			<h4><?php echo $phone; ?></h4>
		<?php endif; ?>
		<h4><?php echo $address1_billing; ?></h4>
		<?php if(!empty($address2_billing)): ?>
			<h4><?php echo $address2_billing; ?></h4>
		<?php endif; ?>
		<h4><?php echo $city_billing . ", " . $state_billing . " " . $zip_billing; ?></h4>
		<h4><?php echo $country_billing; ?></h4>
		<br />
		<a href="<?php echo base_url(); ?>checkout">Change Billing Address</a>
		<br />
	</div>
</div>
<br />
<div class="row">
	<div class='col-md-6'>
		<h4>Shipping Method</h4> <br />

		<h4>7-14 Business Days</h4>
		<!--<div class="radio">
			<form id="shipping_id">
			<?php 
				$i = 0;
				foreach($shipping as $shipping_options): 
					$optionsRadios = 'optionsRadios' . $i;
					$option = 'option' . $i; ?>
					<div class="radio">
  						<label>
    						<input type="radio" name="optionsRadios" id="<?php echo $optionsRadios; ?>" value="<?php echo $shipping_options[1]; ?>">
    						<?php echo $shipping_options[0]; ?>
    					</label>
					</div>
			<?php 
				$i++;
				endforeach; ?>
			</form>
		</div>-->
	</div>
	<div class='col-md-6'>
		<h4>Payment</h4> <br />
 		<h4>Credit Card</h4>
		<h4><span class="red">*</span> Please verify that the address above matches the address on file with the credit card you are using.</h4>
		<h4><span class="red">*</span> No credit card details are logged or stored on this website.</h4>
		<h4><?php echo "<div id=\"total\">$" . $total . "</div>"; ?></h4>
		<form action="your-server-side-code" method="POST">
  			<script
    			src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    			data-key="pk_test_g6do5S237ekq10r65BnxO6S0"
    			data-amount="<?php echo preg_replace("/[^0-9]/", "", $total); ?>"
    			data-name="Stripe.com"
    			data-description="Example charge"
    			data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    			data-locale="auto"
    			data-zip-code="true">
  			</script>
		</form>
 		PayPal Express Checkout <br />
		GIFT OR PROMO CODE <br />
<br />
		PURCHASE ORDER NUMBER <br />
	</div>
</div>