<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {


	public function index($id)
	{
		$this->load->library('session');
		$this->load->model('products_model');
		$this->load->model('product_images_model');
		
		$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
		
		if (!empty($id) || !is_numeric($id))
			redirect('/', 'refresh');
			
		$product = $this->products_model->product($id);
		$page_title = $product['name'];
		$stmt_product_image = $this->product_images_model->product_image($id);
		$num_product_image =  count($stmt_product_image);
			
		$data = array('page_title' => $page_title, 'num_product_image' => $num_product_image, 'stmt_product_image' => $stmt_product_image, 'product' => $product, 'id' => $id);
		$this->load->view('product_view', $data);
		
	}
}