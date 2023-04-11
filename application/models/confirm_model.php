<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm_model extends CI_Model {
  
  	
  private function rand_str_gen($len) {
    	//How to use:
    	//$crypt_pass = crypt($password)
    	//$pass+hash = rand_str_gen(20) . "$crypt_pass" . ran_str_gen(20);
    	$result = "";
    	$chars = "0123456789";
    	$char_array = str_split($chars);
    	for ($i = 0; $i < $len; $i++) {
      		$rand_item = array_rand($char_array);
      		$result .= "" . $char_array[$rand_item];
    	}
    	return $result;
  }

  public function submit($id, $price, $quantity, $user_agent) {
    $ip_address 	= getenv('REMOTE_ADDR');
    $ship_f_name 	= ucwords($this->input->post('first'));
    $ship_l_name 	= ucwords($this->input->post('last'));
    $company 		= ucwords($this->input->post('company'));
    $ship_address	= ucwords($this->input->post('address1'));
    $ship_address_2	= ucwords($this->input->post('address2'));
    $ship_city		= ucwords($this->input->post('city'));
    $ship_state		= ucwords($this->input->post('state'));
    $ship_zip		= $this->input->post('zip');
    $ship_country 	= ucwords($this->input->post('country'));
    $phone			= preg_replace('/[^0-9]/', '', $this->input->post('phone'));
    $bill_f_name	= ucwords($this->input->post('first_name_2'));
    $bill_l_name	= ucwords($this->input->post('last_name_2'));
    $bill_address	= ucwords($this->input->post('address1_2'));
    $bill_address_2	= ucwords($this->input->post('address2_2'));
    $bill_city		= ucwords($this->input->post('city_2'));
    $bill_state		= ucwords($this->input->post('state_2'));
    $bill_zip 		= $this->input->post('zip_2');
    $bill_country 	= ucwords($this->input->post('country_2'));
    $email 			= strtolower($this->input->post('email'));
    $notes 			= $this->input->post('notes');
    $user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    
    // Get processor id
    $processor_name = $this->input->post('processor');
    $processor_sql = "SELECT * FROM processors WHERE name=? LIMIT 1";
    $processor_query = $this->db->query($processor_sql, $processor_name);
    
    $processor_row = $processor_query->row(0);
    $processor_id = $processor_row->id;
    
    if (is_null($processor_id))
    	redirect('/', 'refresh');
    
    // Generate random user id for guest
    if (empty($user_id))
    	$user_id = $this->rand_str_gen(48);
    	
    
    // Check for duplicate order made in the last 5 minutes and confirm they want to make purchase again!
    /*$validate_data = array(
     	'product_id' 		=> $id,
     	'quantity' 			=> $quantity,
     	'ship_f_name' 		=> $ship_f_name,
     	'ship_l_name' 		=> $ship_l_name,
      	'company' 			=> $company,
      	'ship_address' 		=> $ship_address,
      	'ship_address_2' 	=> $ship_address_2,
      	'ship_city' 		=> $ship_city,
      	'ship_state' 		=> $ship_state,
      	'ship_zip' 			=> $ship_zip,
      	'ship_country' 		=> $ship_country,
      	'email' 			=> $email,
      	'ip_address' 		=> $ip_address,
      	'user_agent'		=> $user_agent,
    );
    
    $sql_validate = "SELECT * FROM orders WHERE product_id=?, quantity=?, ship_f_name=?,
    ship_l_name=?, company=?, ship_address=?, ship_address_2=?, ship_city=?, ship_state=?,
    ship_zip=?, ship_country=?, email=?, ip_address=?, user_agent=? WHERE created < (NOW() - INTERVAL 10 MINUTE) LIMIT 1";
    
    $query_validate = $this->db->query($sql_validate, $validate_data);
    
    if ($query_validate->num_rows() > 0) {
    	$order_row = $query_validate->row(0);
    	$product_id = $order_row->product_id;
    	$quantity = $order_row->quantity;
    	
    	$sql_product = "SELECT name FROM products WHERE id=? LIMIT 1";
    	$query_product = $this->db->query($sql_product, $product_id);
    	
    	$product_row = $query_produc->row(0);
    	$product_name = $product_row->name;
    
    	if (!is_null($product_name) && !is_null($quantity))
    		redirect('/duplicate/index/product/$product_name/quantity/$quantity', 'refresh');
    }*/
		
			
    $checkout_data = array(
    	'product_id' 		=> $id,
    	'user_id'			=> $user_id, 
    	'processor_id' 		=> $processor_id,
	  	'quantity' 			=> $quantity,
      	'ship_f_name' 		=> $ship_f_name,
      	'ship_l_name' 		=> $ship_l_name,
      	'company' 			=> $company,
      	'ship_address' 		=> $ship_address,
      	'ship_address_2' 	=> $ship_address_2,
      	'ship_city' 		=> $ship_city,
      	'ship_state' 		=> $ship_state,
      	'ship_zip' 			=> $ship_zip,
      	'ship_country' 		=> $ship_country,
      	'phone' 			=> $phone,
      	'bill_f_name' 		=> $bill_f_name,
      	'bill_l_name' 		=> $bill_l_name,
      	'bill_address' 		=> $bill_address,
      	'bill_address_2' 	=> $bill_address_2,
      	'bill_city' 		=> $bill_city,
      	'bill_state' 		=> $bill_state,
      	'bill_zip' 			=> $bill_zip,
      	'bill_country' 		=> $bill_country,
      	'email' 			=> $email,
      	'ip_address' 		=> $ip_address,
      	'user_agent'		=> $user_agent,
      	'notes' 			=> $notes
    );
    $sql = "INSERT INTO orders (product_id, user_id, processor_id, quantity, ship_f_name, ship_l_name, company, 
    ship_address, ship_address_2, ship_city, ship_state, ship_zip, ship_country, phone, bill_f_name, bill_l_name, 
    bill_address, bill_address_2, bill_city, bill_state, bill_zip, bill_country, email, ip_address, user_agent, created, notes) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?)";
    
    $query = $this->db->query($sql, $checkout_data);
    
    return $this->db->insert_id();
  }
  
  public function update($id, $type) {
  	$ip_address = getenv('REMOTE_ADDR');
  	
  	if (strcmp($type,"billing") == 0) {
  	 	$checkout_data = array(
      		'first_name_2' 		=> ucwords($this->input->post('first_name')),
      		'last_name_2' 		=> ucwords($this->input->post('last_name')),
      		'company_2' 		=> ucwords($this->input->post('company')),
      		'email' 			=> strtolower($this->input->post('email')),
      		'phone' 			=> preg_replace('/[^0-9]/', '', $this->input->post('phone')),
      		'country_2' 		=> ucwords($this->input->post('country')),
      		'address1_2' 		=> ucwords($this->input->post('address1')),
      		'address2_2' 		=> ucwords($this->input->post('address2')),
      		'city_2' 			=> ucwords($this->input->post('city')),
      		'state_2' 			=> ucwords($this->input->post('state')),
      		'zip_2' 			=> $this->input->post('zip'),
      		'product_id' 		=> $id,
      		'ip_address' 		=> $ip_address
    	);
    	$sql = "UPDATE orders SET first_name_2=?, last_name_2=?, company_2=?, email=?, phone=?, country_2=?, address1_2=?, address2_2=?, city_2=?, state_2=?, zip_2=? WHERE product_id=? AND ip_address=? ORDER BY created DESC LIMIT 1";
    } else {
    	$checkout_data = array(
      		'first_name' 		=> ucwords($this->input->post('first_name')),
      		'last_name' 		=> ucwords($this->input->post('last_name')),
      		'company' 			=> ucwords($this->input->post('company')),
      		'country' 			=> ucwords($this->input->post('country')),
      		'address1' 			=> ucwords($this->input->post('address1')),
      		'address2' 			=> ucwords($this->input->post('address2')),
      		'city' 				=> ucwords($this->input->post('city')),
      		'state' 			=> ucwords($this->input->post('state')),
      		'zip' 				=> $this->input->post('zip'),
      		'notes' 			=> $this->input->post('notes'),
      		'product_id' 		=> $id,
      		'ip_address' 		=> $ip_address
    	);
    	$sql = "UPDATE orders SET first_name=?, last_name=?, company=?, country=?, address1=?, address2=?, city=?, state=?, zip=? WHERE product_id=? AND ip_address=? ORDER BY created DESC LIMIT 1";
    }
    $query = $this->db->query($sql, $checkout_data);
  }
}