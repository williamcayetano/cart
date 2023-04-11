<div class='col-md-6'>
	<?php echo validation_errors('<span class="red">*</span> '); ?>
		<form action="<?php echo base_url(); ?>contact/message" method="post" accept-charset="utf-8">
		<span style="color:black;">Email Address:</span><br />
		<input type="text" name="email" size="40" maxlength="50"/><br />
		<span style="color:black;">Subject:</span><br />
		<input type="text" name="subject" size="69" maxlength="100"/><br />
		<span style="color:black;">Body:</span><br /><textarea name="body" cols="68" rows="7"></textarea><br />
		<input type="submit" name="submit" value="Send Message" />
	</form> 
</div>