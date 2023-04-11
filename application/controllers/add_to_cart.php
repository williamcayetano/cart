<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_to_cart extends CI_Controller {


	public function index() 
	{
		$this->process();
	}
	
	public function process()
	{
		$this->load->library('session');
		// get the product id
		$id = $this->uri->segment(4);
		$segment = $this->uri->segment(6);
		$quantity = $this->uri->segment(8);
		$location = $this->uri->segment(10);
		
		$quantity = is_numeric($quantity) ? $quantity : 1;
		$segment = is_numeric($segment) ? $segment : 0;
		
		
		if (!is_numeric($id) || !is_numeric($quantity))
			redirect('/', 'refresh');
 
 
		// add new item on array
		$cart_item = array(
    		'quantity'=>$quantity
		);
 
		/*
 		 * check if the 'cart' session array was created
 		 * if it is NOT, create the 'cart' session array
 		 */
		if(!isset($_SESSION['cart'])){
    		$_SESSION['cart'] = array();
		}
		
		//echo "ID: " . $id;
		
		//print_r($_SESSION['cart']);
		//exit();
 
		// check if the item is in the array, if it is, do not add
		if (strcmp($location,"product") == 0) {
			if(array_key_exists($id, $_SESSION['cart'])) {
				redirect('/cart/index/action/quantity_updated', 'refresh');
			} else {
				$_SESSION['cart'][$id]=$cart_item;
    			// redirect to product list and tell the user it was added to cart
    			//header('Location: products.php?action=added&page=' . $page);
    			redirect('product/view/' . $id);
			}
			//exit();
		} else if(array_key_exists($id, $_SESSION['cart'])){
    		// redirect to product list and tell the user it was added to cart
    		//header('Location: products.php?action=exists&id=' . $id . '&page=' . $page);
    		redirect('products/index/action/exists/id/' . $id);
		} else {
    		$_SESSION['cart'][$id]=$cart_item;
    		// redirect to product list and tell the user it was added to cart
    		//header('Location: products.php?action=added&page=' . $page);
    		redirect('products/index/' . $segment . '/action/added');
		}
	}
}
?>