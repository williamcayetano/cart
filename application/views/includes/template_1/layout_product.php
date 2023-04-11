<div class='col-md-1'>
    <?php if($num_product_image > 0): 
        foreach ($stmt_product_image as $row):
            $product_image_name = $row['name'];
            $source = base_url() . "uploads/images/{$product_image_name}"; ?>
            <img src='<?php echo $source; ?>' class='product-img-thumb' data-img-id='<?php echo $row['id']; ?>' />
        <?php endforeach; ?>
    <?php else: ?>
    	 No images
    <?php endif; ?>
</div>
<div class='col-md-4' id='product-img'>
    <?php if($num_product_image > 0):
        $x=0;
        foreach ($stmt_product_image as $row):
            $product_image_name = $row['name'];
            $source =  base_url() . "uploads/images/{$product_image_name}";
            $show_product_img = $x == 0 ? "display-block" : "display-none"; ?>
            <a href='<?php echo $source; ?>' target='_blank' id='product-img-<?php echo $row['id']; ?>' class='product-img <?php echo $show_product_img; ?>'>
                <img src='<?php echo $source; ?>' style='width:100%;' />
            </a>
    <?php $x++;
        endforeach; ?>
    <?php else: ?>
    	No images
    <?php endif; ?>
</div>
<div class='col-md-5'>
    <div class='product-detail'>Price:</div>
    <h4 class='m-b-10px price-description'>&#36;<?php echo number_format($product->price, 2, '.', ','); ?></h4>
    <div class='product-detail'>Product description:</div>
    <div class='m-b-10px'>
        
    	<?php $page_description = htmlspecialchars_decode(htmlspecialchars_decode($product->cart_desc));
        		echo $page_description; ?>
    </div>
</div>
<div class='col-md-2'>
	<?php if(!empty($_SESSION['cart'])): ?>
    	<?php if(array_key_exists($id, $_SESSION['cart'])): ?>
        	<div class='m-b-10px'>This product is in your cart.</div>
        	<a href='<?php echo base_url(); ?>cart' class='btn btn-success w-100-pct'>
            	Update Cart
        	</a>
    	<?php endif; ?>
 	<?php else: ?>
        <form class='add-to-cart-form'>
            <div class='product-id display-none'><?php echo $id; ?></div>
 			<div class='m-b-10px f-w-b'>Quantity:</div>
            <input type='number' name='quantity' value='1' class='form-control m-b-10px cart-quantity' min='1' />
            <button style='width:100%;' type='submit' class='btn btn-primary add-to-cart m-b-10px'>
                <span class='glyphicon glyphicon-shopping-cart'></span> Add to cart
            </button>
        </form>
    <?php endif; ?>
</div>
</div>
<div class="container-fluid reviews">
	<?php if (!empty($reviews['ordered'])): ?>
		<?php if (empty($reviews['reviewed'])): ?>
			<?php echo validation_errors('<div class="red">', '</div>'); ?>
			<form action="<?php echo base_url(); ?>product/process_review" method="post">
				<input type="hidden" name="product_id" value="<?php echo $id; ?>">
      			Rating<br />
      			<select name="rating">
  					<option value="5">5</option>
  					<option value="4">4</option>
  					<option value="3">3</option>
  					<option value="2">2</option>
  					<option value="1">1</option>
				</select><br />
      			Review:<br /><textarea name="review" cols="68" rows="7"><?php echo !empty($review) ? $review : ''; ?></textarea><br />
      			<input type="submit" name="submit" value="Submit Review">
    		</form><br />
		<?php endif; ?>
	<?php endif; ?>
	<?php if(!empty($reviews['reviews'])): ?>
		<?php foreach($reviews['reviews'] as $review): ?>
			<?php echo '<strong>Username: </strong>' . $review['username'] . '<br />'; ?>
			<?php echo '<strong>Rating: </strong>' . $review['rating'] . '<br />'; ?>
			<?php echo $review['review'] . '<br />'; ?>
			<?php echo '<strong>Posted: </strong>' . $review['created'] . '<br /><br />'; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>