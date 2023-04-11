<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller {
	
	public function index() {
		
		$this->load->library('countries');
		
	    if (!$this->user)
	    	redirect('/', 'refresh');
	    
	    $page_title="User Edit";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array('page_title' => $page_title,
					  'template' => $template, 
    				  'mobile' => $mobile,
    				  'user_show' => $this->user_show,
    				  'user'	=> $this->user,
    				  'country_array' => $this->countries->drop_down($this->countries->country_array, $this->user['country']),
    				  'username' => $this->user['username'],
	    			  'first_name' => $this->user['first'],
	    			  'last_name' => $this->user['last'],
	    			  'phone' => $this->user['phone'],
	    			  'address' => $this->user['address1'],
	    			  'address2' => $this->user['address2'],
	    			  'city' => $this->user['city'],
	    			  'state' => $this->user['state'],
	    			  'zip' => $this->user['zip']
    				);
		$this->load->view('edit_view', $data);
	}
	
	public function process() {
		$this->load->library('form_validation');
	    
	    if (!$this->user)
	    	redirect('/', 'refresh');
		
		//sleep for 2 seconds to squash brute-force attempts
		sleep(2);
		
		$page_title="User Edit";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array(
    		'page_title' => $page_title, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $this->user_show
    	);
    	
    	$this->form_validation->set_rules('username', 'Username', 'trim|max_length[50]');
    	$this->form_validation->set_rules('first_name', 'First Name', 'trim|max_length[50]');
    	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|max_length[50]');
    	$this->form_validation->set_rules('phone', 'Phone', 'trim|max_length[20]');
    	$this->form_validation->set_rules('address', 'Address', 'trim|max_length[100]');
    	$this->form_validation->set_rules('address2', 'Address 2', 'trim|max_length[100]');
    	$this->form_validation->set_rules('city', 'City', 'trim|max_length[50]');
    	$this->form_validation->set_rules('state', 'State', 'trim|max_length[50]');
    	$this->form_validation->set_rules('zip', 'Zip', 'trim|max_length[20]');
    	$this->form_validation->set_rules('country', 'Country', 'trim|max_length[50]');
    	
    	$username = $this->input->post('username');
    	$first_name = $this->input->post('first_name');
    	$last_name = $this->input->post('last_name');
    	$phone = $this->input->post('phone');
    	$address = $this->input->post('address');
    	$address2 = $this->input->post('address2');
    	$city = $this->input->post('city');
    	$state = $this->input->post('state');
    	$zip = $this->input->post('zip');
    	
    	if($this->form_validation->run() == FALSE) {
    		$data['username']= $username;
    		$data['first_name']= $first_name;
    		$data['last_name']= $last_name;
    		$data['address']= $address;
    		$data['address2']= $address2;
    		$data['city']= $city;
    		$data['state']= $state;
    		$data['zip']= $zip;
    		$this->load->view('edit_view', $data);
    	} else { // Form validation successful
    		$data['message'] = $this->user_model->edit($this->user);
			$this->load->view('result_view', $data);
    	}
	}
}
