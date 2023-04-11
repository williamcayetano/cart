<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends MY_Controller {
	public function index() {
		if (!isset($_SESSION['cart']) || empty($_SESSION['cart']) || empty($_SESSION['total']))
			redirect('/', 'refresh');
    		
		$this->load->model('products_model');
		$this->load->model('shipping_model');
		$this->load->model('user_model');
		
		$page_title="Confirm";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;		
		
		$ids = array();
    	foreach($_SESSION['cart'] as $id => $value){
    		if (is_numeric($id))
        		array_push($ids, $id);
    	}
    	
    	//$stmts = $this->products_model->get_shipping($ids);
    	//$last_line = end($stmts);
    	
    	//$shipping = $this->shipping_model->shipping_options();
    	//var_dump($shipping);
    	//exit();
    	
    	$first_name = $this->session->userdata('first');
    	$last_name = $this->session->userdata('last');
    	$country = $this->session->userdata('country');
    	$company = $this->session->userdata('company');
    	$email = $this->session->userdata('email');
    	$phone = $this->session->userdata('phone');
    	$address1 = $this->session->userdata('address1');
    	$address2 = $this->session->userdata('address2');
    	$city = $this->session->userdata('city');
    	$state = $this->session->userdata('state');
    	$zip = $this->session->userdata('zip');
    	$total = $this->session->userdata('total');
    	$notes = $this->session->userdata('notes');
    	
    	//shipping_options() code goes here
    	
    	$first_name_billing = $this->session->userdata('first_billing');
    	$last_name_billing = $this->session->userdata('last_billing');
    	$country_billing = $this->session->userdata('country_billing');
    	$company_billing = $this->session->userdata('company_billing');
    	$address1_billing = $this->session->userdata('address1_billing');
    	$address2_billing = $this->session->userdata('address2_billing');
    	$city_billing = $this->session->userdata('city_billing');
    	$state_billing = $this->session->userdata('state_billing');
    	$zip_billing = $this->session->userdata('zip_billing');
    		
		$data = array(
    		'page_title' 			=> $page_title, 
    		//'last_line' 			=> $last_line, 
    		'ids' 					=> $ids, 
    		'template' 				=> $template, 
    		'mobile' 				=> $mobile,
    		'user_show' 			=> $this->user_show,
    		'first_name' 			=> $first_name,
    		'last_name' 			=> $last_name,
    		'country' 				=> $country,
    		'address1' 				=> $address1,
    		'address2' 				=> $address2,
    		'city' 					=> $city,
    		'state' 				=> $state,
    		'zip' 					=> $zip,
    		'total' 				=> $total,
    		'first_name_billing' 	=> $first_name_billing,
    		'last_name_billing' 	=> $last_name_billing,
    		'country_billing' 		=> $country_billing,
    		'address1_billing' 		=> $address1_billing,
    		'address2_billing' 		=> $address2_billing,
    		'city_billing' 			=> $city_billing,
    		'state_billing' 		=> $state_billing,
    		'zip_billing' 			=> $zip_billing,
    		'phone'					=> $phone,
    		'company'				=> $company,
    		'company_billing'		=> $company_billing
    		//'shipping'				=> $shipping
    	);
    	
    	$this->load->view('shipping_view', $data);
	}
	/*
	public function address($type = 'shipping') {
		if (!isset($_SESSION['cart']) || empty($_SESSION['cart']) || empty($_SESSION['total']))
			redirect('/', 'refresh');
		
		$this->load->library('session');
		$this->load->library('templater');
		$this->load->library('countries');
		$page_title = "Change Shipping Address";
		
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		$address_change_type = "shipping";
		
		$first_name = $this->session->userdata('first');
    	$last_name = $this->session->userdata('last');
    	$country = $this->session->userdata('country');
    	$company = $this->session->userdata('company');
    	$email = $this->session->userdata('email');
    	$phone = $this->session->userdata('phone');
    	$address1 = $this->session->userdata('address1');
    	$address2 = $this->session->userdata('address2');
    	$city = $this->session->userdata('city');
    	$state = $this->session->userdata('state');
    	$zip = $this->session->userdata('zip');
    	
		if (strcmp($type,'billing') == 0) {
			$page_title = "Change Billing Address";
			$address_change_type = $type;
			$first_name = $this->session->userdata('first_billing');
    		$last_name = $this->session->userdata('last_billing');
    		$country = $this->session->userdata('country_billing');
    		$company = $this->session->userdata('company_billing');
    		$address1 = $this->session->userdata('address1_billing');
    		$address2 = $this->session->userdata('address2_billing');
    		$city = $this->session->userdata('city_billing');
    		$state = $this->session->userdata('state_billing');
    		$zip = $this->session->userdata('zip_billing');
		}
		
		$data = array(
    		'page_title' 			=> $page_title, 
    		'template' 				=> $template, 
    		'mobile' 				=> $mobile,
    		'first' 				=> $first_name,
    		'last'		 			=> $last_name,
    		'company'		 		=> $company,
    		'email'					=> $email,
    		'phone'		 			=> $phone,
    		'country_array' 		=> $this->countries->drop_down($this->countries->country_array, $country),
    		'country' 				=> $country,
    		'address1' 				=> $address1,
    		'address2' 				=> $address2,
    		'city' 					=> $city,
    		'state' 				=> $state,
    		'zip' 					=> $zip,
    		'type'					=> $address_change_type
    	);
			
		$this->load->view('address_view', $data);
	}
	
	public function process() {
		$this->load->library('session');
		$this->load->library('countries');
		$this->load->model('products_model');
		$this->load->library('templater');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$page_title = "Confirm";
		$template 	= $this->templater->template;
		$mobile 	= $this->templater->mobile;
		
		
		$data = array(
    		'page_title' => $page_title, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'country_array' => $this->countries->drop_down($this->countries->country_array) 
    	);
		
		$this->form_validation->set_rules('first', 'First Name', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('last', 'Last Name', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('company', 'Company', 'trim');
    	$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('phone', 'Phone', 'trim');
    	$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('address1', 'Address 1', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('address2', 'Address 2', 'trim');
    	$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('zip', 'Zip', 'trim|required|min_length[2]');
    	$this->form_validation->set_rules('type', 'Address Type', 'trim|required|min_length[2]');
    	
    	$first_name = $this->input->post('first');
    	$last_name = $this->input->post('last');
    	$company = $this->input->post('company');
    	$email = $this->input->post('email');
    	$phone = $this->input->post('phone');
    	$country = $this->input->post('country');
    	$address1 = $this->input->post('address1');
    	$address2 = $this->input->post('address2');
    	$city = $this->input->post('city');
    	$state = $this->input->post('state');
    	$zip = $this->input->post('zip');
    	$type = $this->input->post('type');
    	
    	$valid_country_2 = "United States of America";
    	if (isset($country_2))
    		$valid_country_2 = $country_2;
    	
    	if($this->form_validation->run() == FALSE || !in_array($country, $this->countries->country_array) || !in_array($valid_country_2, $this->countries->country_array)) {
      		$data['first']= $first_name;
      		$data['last']= $last_name;
      		$data['company']= $company;
      		$data['country']= $this->drop_down($this->countries->country_array, $country);
      		$data['address1']= $address1;
      		$data['address2']= $address2;
      		$data['city']= $city;
      		$data['state']= $state;
      		$data['zip']= $zip;
      		$data['type']= $type;
      		
      		$this->load->view('address_view', $data);
    	} else {
      		$this->load->model('confirm_model'); 
      		$this->load->library('agent'); 
    		
    		#redirect to index if array is empty
    		if (empty($_SESSION['cart'])) {
    			redirect('/', 'refresh');
    		}
    		
    		//Put shipping info in db here
		
    		$user_agent = $this->agent->user_agent();
    
    		$total=0;
    		//$item_count=0;
    		foreach ($stmts as $row) {
				$id = $row->id;
				$price = $row->price;
        		$quantity = $_SESSION['cart'][$id]['quantity'];
        		if ($quantity > 0) {
        			$query = $this->confirm_model->submit($id, $price, $quantity, $user_agent);
        			$sub_total = $price * $quantity;
        			
        			//$item_count += $quantity;
        			$total += $sub_total;
        		}
    		}
    		
    		
    		$this->session->set_userdata('company', $company);
    		$this->session->set_userdata('email', $email);
    		$this->session->set_userdata('phone', $phone);
    		if (strcmp($type,"billing") == 0) {
    			//clear session data so it can be reset
    			foreach($_SESSION as $name => $value) {
    		 		$unset_array = array('first_billing', 'last_billing', 
    		 		'country_billing','company', 'email',  
    		 		'phone', 'address1_billing', 'address2_billing', 
    		 		'city_billing', 'state_billing', 'zip_billing');
    				if (in_array($name, $unset_array))
        				unset($_SESSION[$name]);
    			}
    			
    			$this->session->set_userdata('first_billing',$first_name);
    			$this->session->set_userdata('last_billing',$last_name);
    			$this->session->set_userdata('country_billing',$country);
    			$this->session->set_userdata('address1_billing',$address1);
    			$this->session->set_userdata('address2_billing',$address2);
    			$this->session->set_userdata('city_billing',$city);
    			$this->session->set_userdata('state_billing',$state);
    			$this->session->set_userdata('zip_billing',$zip);
    		} else {
    			foreach($_SESSION as $name => $value) {
    		 		$unset_array = array('total', 'first', 'last', 'country',
    		 		'company', 'email', 'phone', 'address1', 
    		 		'address2', 'city', 'state', 'zip');
    				if (in_array($name, $unset_array))
        				unset($_SESSION[$name]);
    			}
    			
    			$this->session->set_userdata('first',$first_name);
    			$this->session->set_userdata('last',$last_name);
    			$this->session->set_userdata('country',$country);
    			$this->session->set_userdata('address1',$address1);
    			$this->session->set_userdata('address2',$address2);
    			$this->session->set_userdata('city',$city);
    			$this->session->set_userdata('state',$state);
    			$this->session->set_userdata('zip',$zip);
    			
    		}
    		redirect('/shipping', 'refresh');
		}
	}*/
}