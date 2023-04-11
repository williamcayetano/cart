<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove_from_cart extends CI_Controller {
	public function index($id)
	{
		$this->load->library('session');
		//echo "ID: " . $id;
		if (!is_numeric($id))
			redirect('/', 'refresh');
			
		//print_r($_SESSION['cart']);
		//exit();
			
		if (isset($_SESSION['cart'])) {
			//$this->session->unset_userdata($_SESSION['cart'][$id]);
			unset($_SESSION['cart'][$id]);
			redirect('/cart/index/action/removed', 'refresh');
		} else {
			redirect('/', 'refresh');
		}
	}
}