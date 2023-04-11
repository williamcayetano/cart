<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {
	public function index()
	{
		$this->load->model('products_model');
			
		$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
		
		$action = $this->uri->segment(4);
			
		$page_title="Cart";
		
		$ids = array();
    	foreach($_SESSION['cart'] as $id => $value){
    		if (is_numeric($id))
        		array_push($ids, $id);
    	}
 		
 		$stmts = array();
 		if (count($ids) > 0)
 			$stmts = $this->products_model->read_by_ids($ids);
    	
    	$total=0;
    	$item_count=0;
    	
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
    	
    	$data = array('page_title' => $page_title, 
    		'stmts' => $stmts, 
    		'ids' => $ids, 
    		'action' => $action, 
    		'total' => $total, 
    		'item_count' => $item_count, 
    		'template' => $template, 
    		'mobile' => $mobile, 
    		'user_show' => $this->user_show
    	);
		$this->load->view('cart_view', $data);
	}
}