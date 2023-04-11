<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activation extends MY_Controller {
	public function index() {	
		$page_title="Activation";
		
		if(!empty($this->user))
			redirect('/', 'refresh');
		
		$tag_ok = $this->user_model->check_url_tag();
		
		if(empty($tag_ok))
			redirect('/', 'refresh');
		
		$template 	= $this->templater->template;
		$mobile 	= $this->templater->mobile;
		
		$data = array('page_title' 		=> $page_title,
					  'template' 		=> $template, 
    				  'mobile' 			=> $mobile,
    				  'user_show'		=> $this->user_show
    				);
		
		$this->load->view('activation_view', $data);
	}
}