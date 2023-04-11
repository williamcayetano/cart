<div class='col-md-6'>
	<?php echo $message; ?>
    <form action="<?php echo base_url('register/process'); ?>" method="post">
		Email<br />
		<input type="text" name="email" size="50" class="shrink_input" maxlength="20">
     	<br>Password<br />
     	<input type="password" name="password" size="50" class="shrink_input">
     	<br />Confirm Password:<br />
     	<input type="password" name="confirm" size="50" class="shrink_input"><br/>
        <?php echo $recaptcha_html; ?><br />
        <input type = "submit" name = "submit" value = "submit">
     </form>
</div>	