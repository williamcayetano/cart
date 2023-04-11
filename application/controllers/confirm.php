<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm extends MY_Controller {
	public function index() {
		$this->process();
	}

	public function process() {
		$this->load->library('countries');
		$this->load->model('products_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$page_title="Confirm";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		//$_SESSION['cart'] = !is_null($_SESSION['cart']) ? $_SESSION['cart'] : redirect('/', 'refresh');
		//var_dump($_SESSION['cart']);
		
		if(empty($_SESSION['cart']))
			redirect('/', 'refresh');
    		
		$ids = array();
    	foreach($_SESSION['cart'] as $id => $value){
    		if (is_numeric($id))
        		array_push($ids, $id);
    	}
    	
    	$stmts = $this->products_model->read_by_ids($ids);
    	$total=0;
    	$item_count=0;
		
		$data = array(
    		'page_title' => $page_title, 
    		'stmts' => $stmts, 
    		'ids' => $ids, 
    		'total' => $total, 
    		'item_count' => $item_count,
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $this->user_show,
    		'country_array' => $this->countries->drop_down($this->countries->country_array) 
    	);
		
		$this->form_validation->set_rules('first', 'First Name', 'trim|required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('last', 'Last Name', 'trim|required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('company', 'Company', 'trim|max_length[255]');
    	$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[6]|max_length[255]');
    	$this->form_validation->set_rules('phone', 'Phone', 'trim|max_length[255]');
    	$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('address1', 'Address 1', 'trim|required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('address2', 'Address 2', 'trim|max_length[255]');
    	$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[2]|max_length[255]');
    	$this->form_validation->set_rules('zip', 'Zip', 'trim|required|min_length[2]|max_length[255]');
    	
    	$this->form_validation->set_rules('first_2', 'First Name', 'trim|max_length[255]');
    	$this->form_validation->set_rules('last_2', 'Last Name', 'trim|max_length[255]');
    	$this->form_validation->set_rules('company_2', 'Company', 'trim|max_length[255]');
    	$this->form_validation->set_rules('country_2', 'Country', 'trim|max_length[255]');
    	$this->form_validation->set_rules('address1_2', 'Address 1', 'trim|max_length[255]');
    	$this->form_validation->set_rules('address2_2', 'Address 2', 'trim|max_length[255]');
    	$this->form_validation->set_rules('city_2', 'City', 'trim|max_length[255]');
    	$this->form_validation->set_rules('state_2', 'State', 'trim|max_length[255]');
    	$this->form_validation->set_rules('zip_2', 'Zip', 'trim|max_length[255]');
    	$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[1020]');
    	
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
    	$different = $this->input->post('different');
    	$notes = $this->input->post('notes');
    	$first_name_2 = $this->input->post('first_2');
    	$processor	= $this->input->post('processor');
    	
    	if (isset($different) || !empty($first_name_2)) {
    		$last_name_2 = $this->input->post('last_2');
    		$company_2= $this->input->post('company_2');
    		$country_2 = $this->input->post('country_2');
    		$address1_2 = $this->input->post('address1_2');
    		$address2_2 = $this->input->post('address2_2');
    		$city_2 = $this->input->post('city_2');
    		$state_2 = $this->input->post('state_2');
    		$zip_2 = $this->input->post('zip_2');
    	}
    	
    	$valid_country_2 = "United States of America";
    	if (isset($country_2))
    		$valid_country_2 = $country_2;
    	
    	if($this->form_validation->run() == FALSE 
    	|| !in_array($country, $this->countries->country_array) 
    	|| !in_array($valid_country_2, $this->countries->country_array) 
    	|| is_null($processor)) {
      		$data['first']= $first_name;
      		$data['last']= $last_name;
      		$data['company']= $company;
      		$data['country']= $this->countries->drop_down($this->countries->country_array, $country);
      		$data['email']= $email;
      		$data['phone']= $phone;
      		$data['address1']= $address1;
      		$data['address2']= $address2;
      		$data['city']= $city;
      		$data['state']= $state;
      		$data['zip']= $zip;
      		$data['notes'] = $notes;
      		
      		if (isset($different) || !empty($first_name_2)) {
      			$data['first_2']= $first_name_2;
      			$data['last_2']= $last_name_2;
      			$data['company_2']= $company_2;
      			$data['country_2']= $this->countries->drop_down($this->countries->country_array, $country_2);
      			$data['address1_2']= $address1_2;
      			$data['address2_2']= $address2_2;
      			$data['city_2']= $city_2;
      			$data['state_2']= $state_2;
      			$data['zip_2']= $zip_2;
      		}
      		
      		$this->load->view('checkout_view', $data);
    	} else { // Form validation successful
      		$this->load->model('confirm_model'); 
      		$this->load->library('agent'); 
    		
    		#redirect to index if array is empty
    		if (empty($_SESSION['cart'])) {
    			redirect('/', 'refresh');
    		}
		
    		$user_agent = $this->agent->user_agent();
    
    		$total=0;
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
    		
    		//clear session data so it can be reset
    		foreach($_SESSION as $name => $value) {
    		 	$unset_array = array('total', 'first', 'last', 'country', 'company', 'email', 'phone',
    		 	'address1', 'address2', 'city', 'state', 'zip', 'first_billing', 'last_billing', 
    		 	'country_billing', 'address1_billing', 'address2_billing', 'city_billing',
    		 	'state_billing', 'zip_billing', 'notes');
    			if (in_array($name, $unset_array))
        			unset($_SESSION[$name]);
    		}
    		
    		$this->session->set_userdata('total', $total);
    		$this->session->set_userdata('email', $email);
    		$this->session->set_userdata('phone', $phone);
    		$this->session->set_userdata('notes', $notes);
    		if (isset($different) || !empty($first_name_2)) {
    			//Shipping To
    			$this->session->set_userdata('first',$first_name_2);
    			$this->session->set_userdata('last',$last_name_2);
    			$this->session->set_userdata('country',$country_2);
    			$this->session->set_userdata('company', $company_2);
    			$this->session->set_userdata('address1',$address1_2);
    			$this->session->set_userdata('address2',$address2_2);
    			$this->session->set_userdata('city',$city_2);
    			$this->session->set_userdata('state',$state_2);
    			$this->session->set_userdata('zip',$zip_2);
    			
    			//Billing
    			$this->session->set_userdata('first_billing',$first_name);
    			$this->session->set_userdata('last_billing',$last_name);
    			$this->session->set_userdata('country_billing',$country);
    			$this->session->set_userdata('address1_billing',$address1);
    			$this->session->set_userdata('address2_billing',$address2);
    			$this->session->set_userdata('city_billing',$city);
    			$this->session->set_userdata('state_billing',$state);
    			$this->session->set_userdata('zip_billing',$zip);
    		} else {
    			//Shipping
    			$this->session->set_userdata('first',$first_name);
    			$this->session->set_userdata('last',$last_name);
    			$this->session->set_userdata('country',$country);
    			$this->session->set_userdata('company', $company);
    			$this->session->set_userdata('address1',$address1);
    			$this->session->set_userdata('address2',$address2);
    			$this->session->set_userdata('city',$city);
    			$this->session->set_userdata('state',$state);
    			$this->session->set_userdata('zip',$zip);
    			
    			//Billing to same address
    			$this->session->set_userdata('first_billing',$first_name);
    			$this->session->set_userdata('last_billing',$last_name);
    			$this->session->set_userdata('country_billing',$country);
    			$this->session->set_userdata('address1_billing',$address1);
    			$this->session->set_userdata('address2_billing',$address2);
    			$this->session->set_userdata('city_billing',$city);
    			$this->session->set_userdata('state_billing',$state);
    			$this->session->set_userdata('zip_billing',$zip);
    		}
    		redirect('/shipping', 'refresh');
    		
    		/*
    		if (isset($_SESSION['cart'])) {
				foreach($_SESSION['cart'] as $array_key => $array_val) {
					unset($_SESSION['cart'][$array_key]);
				}
			}
			$this->session->sess_destroy();
			
			$this->load->view('confirm_view', $data);
			*/
		}
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