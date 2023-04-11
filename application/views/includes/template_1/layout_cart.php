<div class='col-md-12'>
    <?php if($action=='removed'): ?>
        <div class='alert alert-info'>
            Product was removed from your cart!
        </div>
    <?php elseif($action=='quantity_updated'): ?>
    	<div class='alert alert-info'>
            Product quantity was updated!
        </div>
    <?php endif; ?>
</div>

<?php if(count($_SESSION['cart']) > 0): 
	foreach ($stmts as $row):
		$id = $row->id;
		$price = $row->price;
		$name = $row->name;
        $quantity = $_SESSION['cart'][$id]['quantity'];
        $sub_total = $price * $quantity;
 ?>
    <div class='cart-row'>
        <div class='col-md-8'>
 
            <div class='product-name m-b-10px'><h4><?php echo $name; ?></h4></div>
            <form class='update-quantity-form'>
                <div class='product-id' style='display:none;'><?php echo $id; ?></div>
                <div class='input-group'>
                    <input type='number' name='quantity' value='<?php echo $quantity; ?>' class='form-control cart-quantity' min='1' />
                        <span class='input-group-btn'>
                            <button class='btn btn-default update-quantity' type='submit'>Update</button>
                        </span>
                </div>
            </form>
            <a href='<?php echo base_url(); ?>remove_from_cart/index/<?php echo $id; ?>' class='btn btn-default'>
                Delete
            </a>
        </div>
 
        <div class='col-md-4'>
            <h4>&#36;<?php echo number_format($sub_total, 2, '.', ','); ?></h4>
        </div>
    </div>
<?php
    $item_count += $quantity;
    $total += $sub_total;
    endforeach;
?>
 
    <div class='col-md-8'></div>
    <div class='col-md-4'>
        <div class='cart-row'>
            <h4 class='m-b-10px'>Total (<?php echo $item_count; ?> items)</h4>
            <h4>&#36;<?php echo number_format($total, 2, '.', ','); ?></h4>
            <a href='<?php echo base_url(); ?>checkout' class='btn btn-success m-b-10px'>
                <span class='glyphicon glyphicon-shopping-cart'></span> Proceed to Checkout
            </a>
        </div>
    </div>
<?php else: ?>
    <div class='col-md-12'>
        <div class='alert alert-danger'>
            No products found in your cart!
        </div>
    </div>
<?php endif; ?>