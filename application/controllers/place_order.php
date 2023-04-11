<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Place_order extends MY_Controller {
	public function index()
	{
		$page_title="Thank You!";
		
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array(
			'page_title' => $page_title, 
			'template' => $template, 
			'mobile' => $mobile,
			'user_show' => $this->user_show
		);
		$this->load->view('place_order_view', $data);
	}
}