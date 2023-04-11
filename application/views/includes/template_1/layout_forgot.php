<div class='col-md-6'>
	Forgot your password? We will send a password reset link to the email provided here.<br /><br />
	<?php echo validation_errors('<span color="red">*</span>'); ?>
    <form action="<?php echo base_url(); ?>login/process" method="post">
      Email<br />
      <input type="text" name="email" size="32" maxlength="50">
      <input type="submit" name="submit" value="Submit">
    </form>
</div>