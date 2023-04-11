<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo isset($page_title) ? $page_title : ""; ?></title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
   
    <!-- our custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/custom_back.css" />
 
</head>
<body>
 
    <div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>products">XYZ Webstore</a>
        </div>
 
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
 
                <!-- highlight if $page_title has 'Products' word. -->
                <li <?php echo $page_title=="Products" ? "class='active'" : ""; ?>>
                    <a href="<?php echo base_url(); ?>products" class="dropdown-toggle">Products</a>
                </li>
 
                <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                    <a href="<?php echo base_url(); ?>cart">
                        <?php
                        	$cart_count = 0;
                        	// count products in cart
                        	if (!empty($_SESSION['cart'])) {
                        		foreach($_SESSION['cart'] as $array_key => $array_val) {
									$quantity = $_SESSION['cart'][$array_key]['quantity'];
									$cart_count += $quantity;
								}
							}
                        	//$cart_count = count($_SESSION['cart']);
                        ?>
                        Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                    </a>
                </li>
                <li>
                	<a href="<?php echo base_url(); ?>clear">Clear Cart</a>
                </li>
                <li <?php echo $page_title=="Contact" ? "class='active'" : ""; ?> >
                	<a href="<?php echo base_url(); ?>contact">Contact</a>
                </li>
                <?php if(!$user_show) : ?>
                	<li <?php echo $page_title=="Login" ? "class='active'" : ""; ?> >
                		<a href="<?php echo base_url(); ?>login">Login</a>
                	</li>
                	<li <?php echo $page_title=="Register" ? "class='active'" : ""; ?> >
                		<a href="<?php echo base_url(); ?>register">Register</a>
                	</li>
                <?php else : ?>
                	<?php if(strcmp($page_title,"Profile") == 0): ?>
                		<li <?php echo $page_title=="User Edit" ? "class='active'" : ""; ?> >
                			<a href="<?php echo base_url(); ?>edit">Edit</a>
                		</li>
                	<?php else: ?>
                		<li <?php echo $page_title=="Profile" ? "class='active'" : ""; ?> >
                			<a href="<?php echo base_url(); ?>profile">Profile</a>
                		</li>
                	<?php endif; ?>
                	<li>
                		<a href="<?php echo base_url(); ?>logout">Logout</a>
                	</li>
                <?php endif; ?>
            </ul>
 
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->
 
    <!-- container -->
    <div class="container">
        <div class="row">
 
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo isset($page_title) ? $page_title : ""; ?></h1>
            </div>
        </div>