<!--<div class='col-md-1'>-->
    <div class='col-md-4' id='product-img'>
    <?php if($num_product_image > 0):
    //var_dump($stmt_product_image);
            $product_image_name = $stmt_product_image[0]['name'];
            $source =  base_url() . "uploads/images/{$product_image_name}";
            //echo $source;
            $show_product_img = "display-block"; ?>
            <a href='<?php echo $source; ?>' target='_blank' id='product-img-<?php echo $row['id']; ?>' class='product-img <?php echo $show_product_img; ?>'>
                <img src='<?php echo $source; ?>' style='width:100%;' />
            </a>
    <?php endif; ?>
</div>
<!--<div class='col-md-5'>-->
    <div><strong>Product:</strong> <?php echo $order['product_name']; ?></div>
    <div><strong>Price:</strong> <?php echo number_format($order['product_price'], 2, '.', ','); ?></div>
    <div><strong>Quantity:</strong> <?php echo $order['quantity']; ?></div>
    <div><strong>Shipping First Name:</strong> <?php echo $order['ship_f_name']; ?></div>
    <div><strong>Shipping Last Name:</strong> <?php echo $order['ship_l_name']; ?></div>
    <div><strong>Deliver To Company Name:</strong> <?php echo $order['company']; ?></div>
    <div><strong>Shipping Address:</strong> <?php echo $order['ship_address']; ?></div>
    <div><strong>Shipping Address 2:</strong> <?php echo $order['ship_address_2']; ?></div>
    <div><strong>Shipping City:</strong> <?php echo $order['ship_city']; ?></div>
    <div><strong>Shipping State:</strong> <?php echo $order['ship_state']; ?></div>
    <div><strong>Shipping Zip:</strong> <?php echo $order['ship_zip']; ?></div>
    <div><strong>Shipping Country:</strong> <?php echo $order['ship_country']; ?></div>
    <div><strong>Phone:</strong> <?php echo $order['phone']; ?></div>
    <?php echo !empty($order['bill_f_name']) ? '<div><strong>Billing First Name:</strong> ' . $order['bill_f_name'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_l_name']) ? '<div><strong>Billing Last Name:</strong> ' . $order['bill_l_name'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_address']) ? '<div><strong>Billing Address:</strong> ' . $order['bill_address'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_address_2']) ? '<div><strong>Billing Address 2:</strong> ' . $order['bill_address_2'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_city']) ? '<div><strong>Billing City:</strong> ' . $order['bill_city'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_state']) ? '<div><strong>Billing State:</strong> ' . $order['bill_state'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_zip']) ? '<div><strong>Billing Zip:</strong> ' . $order['bill_zip'] . '</div>' : ''; ?>
    <?php echo !empty($order['bill_zip']) ? '<div><strong>Billing Country:</strong> ' . $order['bill_country'] . '</div>' : ''; ?>
    <div><strong>Shipped</strong> <?php echo strcmp($order['shipped'],'y') == 0 ? 'shipped' : 'not shipped'; ?></div>
    <?php echo strcmp($order['shipped'],'y') == 0 ? '<div><strong>Shipped Date:</strong> ' . $order['ship_date'] . '</div>' : ''; ?>
    <div class='product-detail'>Product description:</div>
    <div class='m-b-10px'>
        
    	<?php $page_description = htmlspecialchars_decode(htmlspecialchars_decode($order['product_cart_desc']));
        		echo $page_description; ?>
    </div>
<!--</div>-->