<div class='col-md-6'>
	<?php echo validation_errors('<span color="red">*</span>'); ?>
    <form action="<?php echo base_url(); ?>reset/process" method="post">
      <input type="hidden" name="id" value="<?php echo $url_tag; ?>">
      <br>Password<br />
     	<input type="password" name="password" size="50" class="shrink_input">
     	<br />Confirm Password:<br />
     	<input type="password" name="confirm" size="50" class="shrink_input"><br/>
        <input type = "submit" name = "submit" value = "submit">
    </form>
</div>