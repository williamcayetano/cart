<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_quantity extends CI_Controller {
	public function index()
	{
		$this->load->library('session');
		
		$id = $this->uri->segment(4);
		$quantity = $this->uri->segment(6);
		
		if (!is_numeric($id) || !is_numeric($quantity))
			redirect('/', 'refresh');
		
		if (isset($_SESSION['cart'][$id])) {
			//$this->session->unset_userdata($_SESSION['cart'][$id]);
			unset($_SESSION['cart'][$id]);
		}
		
		// add the item with updated quantity
		if ($quantity < 1000) {
			$_SESSION['cart'][$id]=array('quantity'=>$quantity);
			redirect('/cart/index/action/quantity_updated', 'refresh');
		}
	}
}