<?php

date_default_timezone_set("US/Pacific");
////error_reporting(E_ALL);

if (!defined('BASEPATH')) {
    exit( 'No direct script access allowed' );
}

class MY_Controller extends CI_Controller {

    public $user_show = false;
    public $user;

    public function __construct () {

        parent::__construct();
		$this->load->library('session');
		$this->load->library('templater');
		$this->load->library('form_validation');
		
		$this->load->model('user_model');
		$this->user = $this->user_model->validate_user();
		$this->user_model->log_page_view();
		
		if(!empty($this->user))
			$this->user_show = true;
		
	}
}

