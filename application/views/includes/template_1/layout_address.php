<div class='col-md-6'>
	<?php echo validation_errors('<span class="red">*</span>'); ?>
	<form action="<?php echo base_url(); ?>confirm/process" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<strong>First Name:</strong> <input type="text" name="first" value="<?php echo !empty($first) ? $first : set_value('first'); ?>" size="10" maxlength="20">
		<strong>Last Name:</strong> <input type="text" name="last" value="<?php echo !empty($last) ? $last : set_value('last'); ?>" size="20" maxlength="30"><br /><br />
		<strong><span style="color:#DCDCDC">Company:</span></strong> <input type="text" name="company" value="<?php echo !empty($company) ? $company : set_value('company'); ?>" size="30" maxlength="40"><br /><br />
		<?php if (strcmp($type,'billing') == 0) : ?>
			<strong>Email Address:</strong> <input type="text" name="email" value="<?php echo !empty($email) ? $email : set_value('email'); ?>" size="30" maxlength="50"><br /><br />
			<strong><span style="color:#DCDCDC">Phone:</span></strong> <input type="text" name="phone" value="<?php echo !empty($phone) ? $phone : set_value('phone'); ?>" size="30" maxlength="30"><br /><br />
		<?php endif; ?>
		<strong>Address 1:</strong> <input type="text" name="address1" value="<?php echo !empty($address1) ? $address1 : set_value('address1'); ?>" size="30" maxlength="60"><br /><br />
		<strong><span style="color:#DCDCDC">Address 2:</span></strong> <input type="text" name="address2" value="<?php echo !empty($address2) ? $address2 : set_value('address2'); ?>" size="30" maxlength="60"><br /><br />
		<strong>Town/City:</strong> <input type="text" name="city" value="<?php echo !empty($city) ? $city : set_value('city'); ?>" size="30" maxlength="60"><br /><br />
		<strong>State/County:</strong> <input type="text" name="state" value="<?php echo !empty($state) ? $state : set_value('state'); ?>" size="10" maxlength="20">
		<strong>Country</strong> <select name="country" selected="<?php echo !empty($country) ? $country : set_value('country'); ?>"><?php echo $country_array; ?></select><br /><br />
		<strong>Postcode/Zip:</strong> <input type="text" name="zip" value="<?php echo !empty($zip) ? $zip : set_value('zip'); ?>" size="20" maxlength="30"><br /><br />
		<br />
		<span class='glyphicon glyphicon-shopping-cart btn btn-lg btn-success m-b-10px'><input type="submit" name="submit" value="Submit"></span>
	</form>
</div>