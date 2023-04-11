<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index() {
		$this->load->library('templater');
		$this->load->library('form_validation');
  
  		//Unset all session variables
  		$_SESSION = array();
  
  		if (isset($_COOKIE['remember'])) {
    		setCookie("remember", '', time()-42000, '/');
  		}
  
  		session_destroy();
  
  		if (!isset($_SESSION['cart'])) {
    		redirect('/', 'refresh');
  		} else {
  			$page_title="Logout";
			$template = $this->templater->template;
			$mobile = $this->templater->mobile;
			$user_show = true;
		
			$data = array(
    			'page_title' => $page_title, 
    			'template' => $template, 
    			'mobile' => $mobile,
    			'user_show' => $user_show
    		);
    		
    		$data['message'] = "Could not log you out, sorry the system encountered an error.";
					
			$this->load->view('result_view', $data);
  		}
	}
}