<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {

	public function index()
	{
		$this->load->library('countries');
		$this->load->model('products_model');
		$this->load->model('product_images_model');
		$this->load->model('shipping_model');
		
		//$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
		if(empty($_SESSION['cart']))
			redirect('/', 'refresh');
		
		$page_title="Checkout";
		
		$ids = array();
    	foreach($_SESSION['cart'] as $id => $value) {
    		if (is_numeric($id))
        		array_push($ids, $id);
    	}
    	
    	$stmts = $this->products_model->read_by_ids($ids);
    	
    	$total=0;
    	$item_count=0;
    	
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$first = '';
		$last = '';
		$country = '';
		$company = '';
		$email = '';
		$phone = '';
		$address1 = '';
		$address2 = '';
		$city = '';
		$state = '';
		$zip = '';
		$first_2 = '';
		$last_2 = '';
		$country_2 = '';
		$company_2 = '';
		$address1_2 = '';
		$address2_2 = '';
		$city_2 = '';
		$state_2 = '';
		$zip_2 = '';
		$different = '';
		
		
    	$email = $this->session->userdata('email');
    	$phone = $this->session->userdata('phone');
    	$notes = $this->session->userdata('notes');
    	
		if (!empty($_SESSION['first_billing'])) {
			$first = $this->session->userdata('first_billing');
    		$last = $this->session->userdata('last_billing');
    		$country = $this->session->userdata('country_billing');
    		$company = $this->session->userdata('company_billing');
    		$address1 = $this->session->userdata('address1_billing');
    		$address2 = $this->session->userdata('address2_billing');
    		$city = $this->session->userdata('city_billing');
    		$state = $this->session->userdata('state_billing');
    		$zip = $this->session->userdata('zip_billing');
    		
    		$first_2 = $this->session->userdata('first');
    		$last_2 = $this->session->userdata('last');
    		$country_2 = $this->session->userdata('country');
    		$company_2 = $this->session->userdata('company');
    		$address1_2 = $this->session->userdata('address1');
    		$address2_2 = $this->session->userdata('address2');
    		$city_2 = $this->session->userdata('city');
    		$state_2 = $this->session->userdata('state');
    		$zip_2 = $this->session->userdata('zip');
    		$different = "checked";
    	} else {
    		$first = $this->session->userdata('first');
    		$last = $this->session->userdata('last');
    		$country = $this->session->userdata('country');
    		$company = $this->session->userdata('company');
    		$address1 = $this->session->userdata('address1');
    		$address2 = $this->session->userdata('address2');
    		$city = $this->session->userdata('city');
    		$state = $this->session->userdata('state');
    		$zip = $this->session->userdata('zip');
    	}
    	
    	$shipping = $this->shipping_model->shipping_quote();
		
		
    	/*$data = array(
    		'page_title' => $page_title, 
    		'stmts' => $stmts, 
    		'ids' => $ids, 
    		'total' => $total, 
    		'item_count' => $item_count, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'country_array' => $this->drop_down($this->countries->country_array)
    	);*/
    	
    	$data = array(
    		'page_title' => $page_title, 
    		'stmts' => $stmts, 
    		'ids' => $ids, 
    		'total' => $total, 
    		'item_count' => $item_count, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $this->user_show,
    		'country_array' => $this->countries->drop_down($this->countries->country_array, $country),
    		'country_array_2' => $this->countries->drop_down($this->countries->country_array, $country_2),
    		'first' => $first,
		 	'last' => $last,
			'country' => $country,
			'company' => $company,
			'email' => $email,
			'phone' => $phone,
			'address1' => $address1,
			'address2' => $address2,
			'city' => $city,
			'state' => $state,
			'zip' => $zip,
			'first_2' => $first_2,
			'last_2' => $last_2,
			'country_2' => $country_2,
			'company_2' => $company_2,
			'address1_2' => $address1_2,
			'address2_2' => $address2_2,
			'city_2' => $city_2,
			'state_2' => $state_2,
			'zip_2' => $zip_2,
			'different' => $different,
			'notes' => $notes,
			'shipping' => $shipping
    	);
    	
		$this->load->view('checkout_view', $data);
	}
	/*
	public function drop_down($options_array, $selected = null) 
  	{ 
    	$return = '<option value="'.$selected.'">'.$selected.'</option>'; 
      	foreach($options_array as $option) 
      	{ 
        	if ($option != $selected) {
          		$return .= '<option value="'.$option.'">'.$option.'</option>';
        	}
      	} 
      	return $return; 
  	}*/
}