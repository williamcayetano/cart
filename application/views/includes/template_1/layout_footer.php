        </div>
        <!-- /row -->
 
    </div>
    <!-- /container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
// update quantity button listener
$(document).ready(function(){
// add to cart button listener
    $('.add-to-cart-form').on('submit', function(){
 
        // info is in the table / single product layout
        var id = $(this).find('.product-id').text();
        var quantity = $(this).find('.cart-quantity').val();
        // redirect to add_to_cart.php, with parameter values to process the request
        window.location.href = "<?php echo base_url(); ?>add_to_cart/process/id/" + id + "/segment/0/quantity/" + quantity + "/loc/product";
        return false;
    });
    
	$('.update-quantity-form').on('submit', function(){
 
    	// get basic information for updating the cart
    	var id = $(this).find('.product-id').text();
    	var quantity = $(this).find('.cart-quantity').val();
 
    	// redirect to update_quantity.php, with parameter values to process the request
    	window.location.href = "<?php echo base_url(); ?>update_quantity/index/id/" + id + "/quantity/" + quantity;
    	return false;
	});

	// change product image on hover
	$(document).on('mouseenter', '.product-img-thumb', function(){
    	var data_img_id = $(this).attr('data-img-id');
    	$('.product-img').hide();
    	$('#product-img-'+data_img_id).show();
	});
	
	$("#slide-down").hide();
	$("#different").click(function() {
        $("#slide-down").slideToggle();
    });
    
    var a = document.forms["Form"]["first_2"].value;
    //alert(a);
    
    if (a) {
    	//alert(a);
    	$("#slide-down").slideToggle();
    }
    /*
    var checkBoxes = $("input[name=recipients\\[\\]]");
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
	
	$(function() {
      $("#slide-down").hide();
      //var sel_payment = $('#payment :selected').text();
      var sel = $('#different :checked');
      if (sel) {
        $("#slide-down").show();
      }
    });

    function payment_slide() {
      var sel = $('#different :checked')
      if (!sel) {
        $("#slide-down").hide();
      } else {
        $("#slide-down").slideToggle();
      }
    }*/
});
</script>
</body>
</html>