<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clear extends CI_Controller {
	public function index() {			
		if (isset($_SESSION['cart'])) {
				foreach($_SESSION['cart'] as $array_key => $array_val) {
					unset($_SESSION['cart'][$array_key]);
				}
		}
		//$this->session->sess_destroy();
		redirect('/', 'refresh');
	}
			
}