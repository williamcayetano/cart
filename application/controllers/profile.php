<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	public function index() {
		$this->view();
	}
	
	public function view() {
		$this->load->library('pagination');
	    
	    if(!$this->user)
	    	redirect('/', 'refresh');
	    
	    $user_session = $this->user['user'];
		$orders = $this->user_model->ordersall($user_session);
		$orders_array = [];
		$segment = false;
		$links = false;
		
		if (!empty($orders)) {
			//config pagination
			$config['base_url'] = base_url("profile/view");
    		$config['total_rows'] = count($orders);
    		$config['per_page'] = 30;
    		$config['num_links'] = 20;
    		$config['uri_segment'] = 3;
    		$config['full_tag_open'] = '<div id="pagination">';
    		$config['full_tag_close'] = '</div>';
    		$this->pagination->initialize($config); 
    	
    		$segment = preg_replace('#[^0-9]#', '', $this->uri->segment($config['uri_segment']));
    		//echo "SEGMENT: $segment";
    		$limit = is_numeric($segment) ? $segment : 0;
    		$offset = $config["per_page"];
    		$links = $this->pagination->create_links();
    		$orders_array = $this->user_model->orders($user_session, $limit, $offset);
    	}
    	
		
		$page_title="Profile";
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		$data = array('page_title' => $page_title,
					  'template' => $template, 
    				  'mobile' => $mobile,
    				  'user'	=> $this->user,
    				  'orders' => $orders_array,
    				  'segment' => $segment,
    				  'links' => $links,
    				  'user_show' => $this->user_show
    				);
		$this->load->view('profile_view', $data);
	}
}
