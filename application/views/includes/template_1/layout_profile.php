<style type="text/css">
    
    table.foobar {
    	/*border: solid black 1px;*/
    	border-spacing: 10px;
    }
    table.foobar td {
    	#border: solid black 1px;
    }
</style>
<?php if(!empty($orders)):
		//echo var_dump($orders);
  		foreach ($orders as $order):
            	$order_id = $order['order']->id; 
            	$product_id = $order['order']->product_id;
            	$quantity = $order['order']->quantity;
            	$shipped = $order['order']->shipped;
            	$created = $order['order']->created;
            	$product_name = $order['product_name']; ?>
  					<table class="foobar" cellpadding="10" cellspacing="0" width="100%">
  						<th>Order Id</th>
  						<th>Product</th>
  						<th>Quantity</th>
  						<th>Shipped</th>
  						<th>Created</th>
  						<tr>
  							<td style="max-width:10px;"><a href="<?php echo base_url(); ?>order/view/<?php echo $order_id; ?>"><?php echo $order_id; ?></a></td>
  							<td style="max-width:400px;"><a href="<?php echo base_url(); ?>product/view/<?php echo $product_id; ?>"><?php echo $product_name; ?></a></td>
  							<td style="max-width:10px;"><?php echo $quantity; ?></td>
  							<td style="max-width:10px;"><?php echo $shipped; ?></td>
  							<td style="max-width:10px;"><?php echo $created; ?></td>
  						</tr>
  					</table>
  	<?php endforeach; ?>
	<p><?php echo $links; ?></p>
<?php else: ?>
  <div class='col-md-12'>
    <div class='alert alert-danger'>You haven't placed any orders yet.</div>
  </div>
<?php endif; ?> 