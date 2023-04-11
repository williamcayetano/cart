<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {


	public function index()
	{
		$this->view();
	}
	
	public function view($id)
	{
		$this->load->model('products_model');
		$this->load->model('product_images_model');
		
		$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
		
		if (empty($id) || !is_numeric($id))
			redirect('/', 'refresh');
			
		$product = $this->products_model->product($id);
		$page_title = $product->name;
		$stmt_product_image = $this->product_images_model->product_images($id);
		$num_product_image =  count($stmt_product_image);
		$review_field = $this->user_model->review_template($id);
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
			
		$data = array('page_title' => $page_title, 
					  'num_product_image' => $num_product_image, 
					  'stmt_product_image' => $stmt_product_image, 
					  'product' => $product, 
					  'id' => $id,
					  'reviews' => $review_field,
					  'template' => $template, 
					  'mobile' => $mobile,
					  'user_show' => $this->user_show
			);
		$this->load->view('product_view', $data);
	}
	
	public function process_review() {
		$this->load->library('form_validation');
		$this->load->model('products_model');
		$this->load->model('product_images_model');
		
		if(!$this->user)
			redirect('/', 'refresh');
		
		
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
    	
		$product_id = $this->input->post("product_id");
		$rating = $this->input->post("rating");
		$review = $this->input->post("review");
    	$product = $this->products_model->product($product_id);
		$page_title = $product->name;
		$stmt_product_image = $this->product_images_model->product_images($product_id);
		$num_product_image =  count($stmt_product_image);
		$review_field = $this->user_model->review_template($product_id);
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
			
		$data = array('page_title' 			=> $page_title, 
					  'num_product_image' 	=> $num_product_image, 
					  'stmt_product_image' 	=> $stmt_product_image, 
					  'product' 			=> $product, 
					  'id' 					=> $product_id,
					  'reviews' 			=> $review_field,
					  'template' 			=> $template, 
					  'mobile' 				=> $mobile,
					  'user_show' 			=> $this->user_show,
					  'review' 				=> $review
			);
		$this->form_validation->set_rules('product_id', 'Product Id', 'trim|required');
		$this->form_validation->set_rules('rating', 'Rating', 'trim|required|regex_match[/^[1-5]$/]');
    	$this->form_validation->set_rules('review', 'Written Review', 'trim|required|min_length[10]|max_length[500]');
    	
    	if($this->form_validation->run() == FALSE) {
      		$this->load->view('product_view', $data);
    	} else { // Form validation successful
    		$this->user_model->review();
			$this->load->view('product_view', $data);
    		//redirect('/', 'refresh');
    	}
	}
}