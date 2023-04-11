<div class='col-md-12'>
	<?php if(!empty($action)): ?>
    	<?php if($action=='added'): ?>
        	<div class='alert alert-info'>
            	Product was added to your cart!
        	</div>
    	<?php elseif($action=='exists'): ?>
        	<div class='alert alert-info'>
            	Product already exists in your cart!
        	</div>
		<?php endif; ?>

	<?php endif; ?>
</div>
<?php if(!empty($products)):
  		foreach ($products as $product):
            	$product_id = $product['product']->id; 
            	$product_image_name = $product['images'][0]->name; ?>
  				<div class='col-md-4 m-b-20px'>
        			<div class='product-id display-none'><?php echo $product_id; ?></div>
        			<a href="<?php echo base_url(); ?>product/view/<?php echo $product_id; ?>" class='product-link'>
                		<div class='m-b-10px'>
                    		<img src="<?php echo base_url(); ?>uploads/images/<?php echo $product_image_name; ?>" class='w-100-pct' />
                		</div>
                	
            			<div class='product-name m-b-10px'><?php echo $product['product']->name; ?></div>
            			
            			<div class='m-b-10px'>
        					<?php if(array_key_exists($product_id, $_SESSION['cart'])): ?>
                				<a href='<?php echo base_url(); ?>cart' class='btn btn-success w-100-pct'>
                    				Update Cart
                				</a>
            				<?php else: ?>
            					<a href='<?php echo base_url(); ?>add_to_cart/process/id/<?php echo $product_id; ?>/segment/<?php echo $segment; ?>' class='btn btn-primary w-100-pct'>
            						Add to Cart
            					</a>
            				<?php endif; ?>
        				</div>
        			</a>
   				</div>
  	<?php endforeach; ?>
	<p><?php echo $links; ?></p>
<?php else: ?>
  <div class='col-md-12'>
    <div class='alert alert-danger'>No products found.</div>
  </div>
<?php endif; ?> 