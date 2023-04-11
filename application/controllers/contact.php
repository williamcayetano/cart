<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {
	
	 public function index()
	{
		$page_title="Contact";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array('page_title' => $page_title,
					  'template' => $template, 
    				  'mobile' => $mobile,
    				  'user_show' => $this->user_show
    				);
    				
		$this->load->view('contact_view', $data);
	}
	
	public function message() {
		$this->load->library('form_validation');
		$page_title="Contact";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array(
    		'page_title' => $page_title, 
    		'template' => $template, 
    		'mobile' => $mobile,
    		'user_show' => $this->user_show
    	);
		
    	$this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[6]|valid_email|max_length[50]');
    	$this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[2]|valid_email|max_length[100]');
   	 	$this->form_validation->set_rules('body', 'Body Of Message', 'trim|required|min_length[10]');
    
    	if($this->form_validation->run() == FALSE) {
      		$this->load->view('contact_view', $data);
    	} else {
			$contact = $this->user_model->contact();
			
			$data['message'] = $contact;
      		$this->load->view('result_view', $data);
    	}
  	}
}