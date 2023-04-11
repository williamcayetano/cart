<div class='col-md-6'>
	<?php echo validation_errors('<span color="red">*</span>'); ?>
    <form action="<?php echo base_url(); ?>edit/process" method="post">
      Username<br />
      <input type="text" name="username" value="<?php echo $username; ?>" size="32" maxlength="50">
      <br />First Name<br />
      <input type="text" name="first_name" value="<?php echo $first_name; ?>" size="32" maxlength="50">
      <br />Last Name<br />
      <input type="text" name="last_name" value="<?php echo $last_name; ?>" size="32" maxlength="50">
      <br />Phone<br />
      <input type="text" name="phone" value="<?php echo $phone; ?>" size="32" maxlength="20">
      <br />Address<br />
      <input type="text" name="address" value="<?php echo $address; ?>" size="32" maxlength="100">
      <br />Address 2<br />
      <input type="text" name="address2" value="<?php echo $address2; ?>" size="32" maxlength="100">
      <br />City<br />
      <input type="text" name="city" value="<?php echo $city; ?>" size="32" maxlength="50">
      <br />State/County<br />
      <input type="text" name="state" value="<?php echo $state; ?>" size="10" maxlength="50">
      <br />Zip<br />
      <input type="text" name="zip" value="<?php echo $zip; ?>" size="32" maxlength="20">
      <br />Country<br />
      <select name="country"><?php echo $country_array; ?></select><br /><br />
      <input type="submit" name="submit" value="Submit">
    </form>
</div>