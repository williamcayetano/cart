<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {
	public function index($id)
	{
		$this->view();
	}
	
	public function view($id)
	{
		$this->load->model('products_model');
		$this->load->model('product_images_model');
		
		if(!$this->user)
			redirect('/', 'refresh');
		
		if (empty($id) || !is_numeric($id))
			redirect('/', 'refresh');
			
		$order = $this->user_model->order($id, $this->user);
		
		$order_id = $order['id'];
		$page_title = "Order $order_id";
		$product_id = $order['product_id'];
		$stmt_product_image = $this->product_images_model->product_image($product_id);
		$num_product_image = count($stmt_product_image);
		
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
			
		$data = array('page_title' => $page_title, 
					  'num_product_image' => $num_product_image, 
					  'stmt_product_image' => $stmt_product_image, 
					  'order' => $order, 
					  'id' => $id, 
					  'template' => $template, 
					  'mobile' => $mobile,
					  'user_show' => $this->user_show
		);
		$this->load->view('order_view', $data);
		
	}
}