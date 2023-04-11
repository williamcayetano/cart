<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller {


	public function index()
	{
		$page_title="Products";
		
		$this->load->model('products_model');
		////$this->load->model("user_model");
		$this->load->model('product_images_model');
		$this->load->library('pagination');
		////$this->load->library('session');
		////$this->load->library('templater');
		////$user = $this->user_model->validate_user();
		////$user_show = false;
		
		////if ($user)
			////$user_show = true;
		
		$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
		
		foreach($_SESSION['cart'] as $array_key => $array_val) {
			if (!is_numeric($array_key)) {
				unset($_SESSION['cart']);
				$_SESSION['cart'] = array();
			}
		}
		
		$products_all = $this->products_model->products_all();
		
		$config['base_url'] = base_url('products/index');
    	$config["total_rows"] = count($products_all);
    	$config["per_page"] = 6;
    	$config['num_links'] = 3;
    	$config['uri_segment'] = 3;
    	$config['full_tag_open'] = '<div id="pagination">';
    	$config['full_tag_close'] = '</div>';
    	$this->pagination->initialize($config); 
    	
    	$segment = preg_replace('#[^0-9]#', '', $this->uri->segment(3));
    	$limit = is_numeric($segment) ? $segment : 0;
    	$offset =  $config["per_page"];
    	
    	$type_segment = gettype($segment);
    	$limit_segment = gettype($limit);
    	
    	//echo "Limit: $limit_segment; Offset: $type_segment;";
		$products = $this->product_images_model->product_images_all($limit, $offset);
    	
    	$action = $this->uri->segment(5);
    	
		$links = $this->pagination->create_links();
		
		$template = $this->templater->template;
		$mobile = $this->templater->mobile;
		
		//echo "Actions: " . $action;
		//print base_url('products/index');
		//exit();
		
		//var_dump($_SESSION['cart']);
		
		/*foreach($products as $product) {
			//echo $product->product;
			var_dump($product['images']);
			echo "<br /><br />";
			/*if(isset($product->description)) {
				echo $product->description;
			}*/
		//}
		$data = array(
						'page_title' => $page_title, 
						'links' => $links, 
						'action' => $action, 
						'products' => $products, 
						'segment' => $segment, 
						'template' => $template, 
						'mobile' => $mobile,
						'user_show' => $this->user_show
				);
		$this->load->view('products_view', $data);
	}
	
}