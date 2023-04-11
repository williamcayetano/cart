<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping_model extends CI_Model {
	
	public function shipping_quote($free_shipping = false) {
		$ids = array();
		$cart_quantity = 0;
    	foreach($_SESSION['cart'] as $id => $value){
    		if (is_numeric($id)) {
        		array_push($ids, $id);
        		$quantity = $_SESSION['cart'][$id]['quantity'];
        		$cart_quantity += $quantity;
        	}
    	}
    	
    	//$cart_quantity = count($ids);
    	if ($cart_quantity == 0 || $free_shipping == true) {
    		return 0;
    	} elseif ($cart_quantity == 1) {
    		return 5;
    	} elseif ($cart_quantity == 2) {
    		return 9;
    	} elseif ($cart_quantity == 3) {
    		return 14;
    	} elseif ($cart_quantity == 4) {
    		return 19;
    	} elseif ($cart_quantity == 5) {
    		return 24;
    	} elseif ($cart_quantity == 6) {
    		return 29;
    	} elseif ($cart_quantity == 7) {
    		return 34;
    	} elseif ($cart_quantity == 8) {
    		return 39;
    	} elseif ($cart_quantity == 9) {
    		return 44;
    	}  elseif ($cart_quantity == 10) {
    		return 49;
    	}
	}
	
	/*public function shipping_options() {
		//echo "Shipping Options";
		$shipping_options_array = array();
		$i = 0;
		//get items from cart
		foreach($_SESSION['cart'] as $id => $value){
    		if (is_numeric($id)) {
        		$sql = "SELECT id, name, price FROM products WHERE id=? LIMIT 1";
				$query = $this->db->query($sql, $id);
				
				$row = $query->row_array();
				if ($row) {
					$product_id = $row['id'];
					$sql_options = "SELECT * FROM shipping_options WHERE product_id=? LIMIT 1";
					$query_options = $this->db->query($sql_options, $product_id);
					$row_options = $query_options->row_array();
					if ($row_options) {
						$shipping_options_array[$product_id] = $row_options['cost'];
					}
				}
			}
    	}
    	
    	return $this->bulk_item_converter($shipping_options_array);
	}
	
	private function bulk_item_converter($options_array) {
		//simple algorithm to charge highest price in array,
		//regardless of items. This will be updated in the future
		//echo "Bulk Item Converter";
		if($options_array) {
			foreach($options_array as $option) {
				var_dump($option);
			}
		} else { //default
    		$seven_fourteen = "<h4>7-14 Business Days</h4>";
    		
    		$return_array = array(array($next,979), array($two,1503), array($two_six,962), array($three_eleven,615));
    		
    		return $return_array;
		}
	}*/
}