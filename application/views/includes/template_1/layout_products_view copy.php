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
<?php if(!empty($products)): /*print_r($products);*/ ?>
  <?php foreach ($products as $product): ?>
  
  
  <?php foreach ($media as $media_item):
            	$product_id = $product['id']; 
            	echo "PRODUCT ID: $product_id, MEDIA ID: $media_item->product_id\n";
 				if($product_id == $media_item->product_id): ?>
 				<?php echo "PRODUCT ID: $product_id, MEDIA ID: $media_item->product_id\n"; ?>
  
  	<div class='col-md-4 m-b-20px'>
        <div class='product-id display-none'><?php echo $product['id']; ?></div>
        <a href="<?php echo base_url(); ?>product/<?php echo $product['id']; ?>" class='product-link'>
        	
        	
        	
                	<div class='m-b-10px'>
                    	<img src="<?php echo base_url(); ?>uploads/images/<?php echo $media_item->name; ?>" class='w-100-pct' />
                	</div>
                	
            		<div class='product-name m-b-10px'><?php echo $product['name']; ?></div>
            			
            		<div class='m-b-10px'>
        				<?php if(array_key_exists($product_id, $_SESSION['cart'])): ?>
                			<a href='<?php echo base_url(); ?>cart' class='btn btn-success w-100-pct'>
                    			Update Cart
                			</a>
            			<?php else: ?>
            				<a href='<?php echo base_url(); ?>add_to_cart/id/<?php echo $product_id . 'page/' . $page; ?>' class='btn btn-primary w-100-pct'>
            					Add to Cart
            				</a>
            			<?php endif; ?>
        			</div>
            	
           
           
           
        </a>
 
   	</div>
   			<?php endif; ?>
   	 <?php endforeach; ?>
   	 
   	 
  <?php endforeach; ?>
   <!--<p><?php echo $links; ?></p>-->
<?php else: ?>
  <div class='col-md-12'>
    <div class='alert alert-danger'>No products found.</div>
  </div>
<?php endif; ?> 