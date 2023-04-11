<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	public function index() {	
		
		if($this->user)
			redirect('/', 'refresh');
		
		
		$page_title="Login";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array('page_title' => $page_title,
					  'template' => $template, 
    				  'mobile' => $mobile,
    				  'user_show' => $this->user_show
    				);
		
		$this->load->view('login_view', $data);
	}
	
	public function process() {
		$this->load->library('form_validation');
		
		if($this->user)
			redirect('/', 'refresh');
		
		//sleep for 2 seconds to squash brute-force attempts
		sleep(2);
		
		$page_title="Login";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array(
    		'page_title' => $page_title, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $this->user_show
    	);
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[2]|max_length[50]');
    	$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[2]|max_length[255]');
    	
    	$email = $this->input->post('email');
    	
    	if($this->form_validation->run() == FALSE) {
    		$data['email']= $email;
      		$this->load->view('login_view', $data);
    	} else { // Form validation successful
    		$data['message'] = $this->user_model->login();
    		$data['page_title'] = "Result";
					
			$this->load->view('result_view', $data);
    		//redirect('/', 'refresh');
    	}
    	//redirect('/shipping', 'refresh');
	}
}