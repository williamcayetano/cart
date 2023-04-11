<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset extends MY_Controller {
	public function index() {	
		$page_title="Reset";
		
		if($this->user)
			redirect('/', 'refresh');
		
		$tag_ok = $this->user_model->check_url_tag();
		
		if(empty($tag_ok))
			redirect('/', 'refresh');
		
		$template 	= $this->templater->template;
		$mobile 	= $this->templater->mobile;
		
		$data = array('page_title' 		=> $page_title,
					  'template' 		=> $template, 
    				  'mobile' 			=> $mobile,
    				  'user_show'		=> $this->user_show,
    				  'id'				=> $tag_ok['tag']
    				);
		
		$this->load->view('reset_view', $data);
	}
	
	public function process() {
		$this->load->library('form_validation');
		
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
                                
		$change = $this->user_model->change_password();
		$data['message'] = $change; 
		$this->load->view('result_view', $data);
	}		
}