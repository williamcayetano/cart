<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Templater {

	public $mobile;
    public $template;
	
	private function template()
	{
		return 1;
	}
	
	private function mobile()
	{
		return '';
	}
	
	public function __construct()
	{
		$this->mobile = $this->mobile();
		$this->template = $this->template();
	}
}