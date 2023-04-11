<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {
	public function index() {	
		$this->load->library('recaptcha');
		
		if($this->user)
			redirect('/', 'refresh');
			
		$page_title = "Register";
		$template 	= $this->templater->template;
		$mobile 	= $this->templater->mobile;
        $recaptcha 	= $this->recaptcha->render();
        $message = '';
		
		$data = array('page_title' 		=> $page_title,
					  'template' 		=> $template, 
    				  'mobile' 			=> $mobile,
    				  'recaptcha_html' 	=> $recaptcha,
    				  'message'			=> $message,
    				  'user_show'		=> $this->user_show
    				);
		
		$this->load->view('register_view', $data);
	}
	
	public function process() {
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
		
		if($this->user)
			redirect('/', 'refresh');
		
		$page_title="Result";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array(
    		'page_title' => $page_title, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $this->user_show
    	);
		
		// Catch the user's answer
		$captcha_answer = $this->input->post('g-recaptcha-response');

		// Verify user's answer
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		
                                
    	if ($response['success']) {
			$register = $this->user_model->register();
		
			$data['message'] = $register; 
			//end info header
					
			$this->load->view('result_view', $data);
		} else {
			$data['message'] = 'captcha was incorrect. please hit the back button, refresh the captcha and try again.'; 
			//end info header
					
			$this->load->view('result_view', $data);
    	}
	}		
}