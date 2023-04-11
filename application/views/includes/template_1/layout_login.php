<div class='col-md-6'>
	<?php echo validation_errors('<span color="red">*</span>'); ?>
    <form action="<?php echo base_url(); ?>login/process" method="post">
      Email<br />
      <input type="text" name="email" size="32" maxlength="50">
      <br />Password<br />
      <input type="password" name="pass" size="32" maxlength="255">
      <br />Remember Me
      <input name="remember" type="checkbox" value="yes" checked="yes" /><br />
      <input type="submit" name="submit" value="Submit">
    </form>
    <br /><br />
    Not a Member? Sign up <a href="<?php echo base_url(); ?>register">here</a>.
    <a href="<?php echo base_url(); ?>forgot">Forgot Password?</a>
</div>