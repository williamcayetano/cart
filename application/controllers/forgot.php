<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends CI_Controller {
	public function index() {	
		$this->load->library('session');
		$this->load->library('templater');
		$this->load->model("user_model");
		$user = $this->user_model->validate_user();
	    $user_show = false;
	    
	    if ($user)
	    	redirect('/', 'refresh');
			
		$page_title="Forgot";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array('page_title' => $page_title,
					  'template' => $template, 
    				  'mobile' => $mobile,
    				  'user_show' => $user_show
    				);
		
		$this->load->view('forgot_view', $data);
	}
	
	public function process() {
		$this->load->library('session');
		$this->load->library('templater');
		$this->load->library('form_validation');
		//$this->load->helper('form');
		$this->load->model("user_model");
		$user = $this->user_model->validate_user();
	    $user_show = false;
	    
	    if ($user)
	    	redirect('/', 'refresh');
		
		//sleep for 2 seconds to squash brute-force attempts
		sleep(2);
		
		$page_title="Forgot";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array(
    		'page_title' => $page_title, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $user_show
    	);
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[50]');
    	
    	$data['email'] = $this->input->post('email');
    	if($this->form_validation->run() == FALSE) {
      		$this->load->view('forgot_view', $data);
    	} else { // Form validation successful
    		$data['message'] = $this->user_model->forgot();
					
			$this->load->view('result_view', $data);
    		//redirect('/', 'refresh');
    	}
    	//redirect('/shipping', 'refresh');
	
	}
}