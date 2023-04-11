<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	private function rand_str_gen($len) {
    	//How to use:
    	//$crypt_pass = crypt($password)
    	//$pass+hash = rand_str_gen(20) . "$crypt_pass" . ran_str_gen(20);
    	$result = "";
    	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    	$char_array = str_split($chars);
    	for ($i = 0; $i < $len; $i++) {
      		$rand_item = array_rand($char_array);
      		$result .= "" . $char_array[$rand_item];
    	}
    	return $result;
  	}

	public function user($user_id, $username = FALSE) {
		if ($username == TRUE) {
			
			$sql = 'SELECT * FROM users WHERE username = ? LIMIT 1';
			$query = $this->db->query($sql,$user_id);
			
			return $query->row_array();
		}
		
		$sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
		
		$query = $this->db->query($sql, $user_id);
		
		$row = $query->row_array();
		
		return $row;
	}
	
	public function get_user_from_session($session_id) {
		$sql_get_user = "SELECT * FROM users WHERE session_id=? LIMIT 1";
		$query_get_user = $this->db->query($sql_get_user, $session_id);
		
		if ($query_get_user->num_rows() > 0) {
			$row = $query_get_user->row_array();
			return $row;
		}
		return 0;
	}
	
	public function ordersall($user_session) {
		$user = $this->get_user_from_session($user_session);
		
		if ($user) {
			$user_id = $user['id'];
			
			$sql = "SELECT * FROM orders WHERE user_id=? ORDER BY created DESC";
			$query = $this->db->query($sql, $user_id);
		
			$rows = $query->result_array();
			return $rows;
		} 
		return 0;
	}
	
	public function orders($user_session, $limit, $offset) {
		$user = $this->get_user_from_session($user_session);
		
		if ($user) {
			$user_id = $user['id'];
			
			$sql = "SELECT * FROM orders WHERE user_id=? ORDER BY created DESC LIMIT ?, ?";
			$order_array = array($user_id, (int)$limit, (int)$offset);
			$query = $this->db->query($sql, $order_array);
			$num_rows = $query->num_rows();
			//echo "Query Num Rows: $num_rows User Id: $user_id Limit: $limit OffSet: $offset<br />";
			//exit();
			$return_array = array();
			$i = 0;
			//$rows = $query->result_array();
			
			if ($num_rows > 0) {
				//echo "Num Rows: $num_rows<br />";
				foreach ($query->result() as $row) {
					//echo var_dump($row);
					$product_id = $row->product_id;
					//echo "Product ID: $product_id<br />";
					$return_array[$i]['order'] = $row;
					$sql2 = "SELECT name FROM products WHERE id = ? LIMIT 1";
					$query2 = $this->db->query($sql2, $product_id);
					$num_rows2 = $query2->num_rows();
					
					if ($num_rows2 > 0) {
						$row2 = $query2->row_array();
						//echo var_dump($row2);
						$return_array[$i]['product_name'] = $row2['name'];
					}
					$i++;
				}
			}
			//echo var_dump($return_array);
			return $return_array;
		}
		return 0;
	}
	
	public function order($id, $user_session) {
		$user = $this->get_user_from_session($user_session['user']);
		
		if ($user) {
			$user_id = $user['id'];
			
			$sql_get_order = "SELECT * FROM orders WHERE id = ? AND user_id = ? LIMIT 1";	
			$query = $this->db->query($sql_get_order, array($id, $user_id));
			
			$num_rows = $query->num_rows();
			if ($num_rows > 0) {
				$row = $query->row_array();
				$product_id = $row['product_id'];
				$processor_id = $row['processor_id'];
				$shipper_id = $row['shipper_id'];
				
				$sql_get_product = "SELECT name, price, cart_desc FROM products WHERE id = ? LIMIT 1";
				$query_product = $this->db->query($sql_get_product, $product_id);
				if ($query_product->num_rows() > 0) {
					$product_row = $query_product->row_array();
					$row['product_name'] = $product_row['name'];
					$row['product_price'] = $product_row['price'];
					$row['product_cart_desc'] = $product_row['cart_desc'];
				} else {
					redirect('/', 'refresh');
				}
				
				$sql_get_processor = "SELECT name FROM processors WHERE id = ? LIMIT 1";
				$query_processor = $this->db->query($sql_get_processor, $processor_id);
				if ($query_processor->num_rows() > 0) {
					$processor_row = $query_processor->row_array();
					$row['processor_name'] = $processor_row['name'];
				} else {
					redirect('/', 'refresh');
				}
				
				$sql_get_shipper = "SELECT name, cost FROM shippers WHERE id = ? LIMIT 1";
				$query_shipper = $this->db->query($sql_get_shipper, $shipper_id);
				if ($query_shipper->num_rows() > 0) {
					$shipper_row = $query_shipper->row_array();
					$row['shipper_name'] = $shipper_row['name'];
					$row['shipper_cost'] = $shipper_row['cost'];
				} else {
					redirect('/', 'refresh');
				}
				return $row;
			} else {
				//placeholder
				redirect('/', 'refresh');
			}
		} else {
			//placeholder
			redirect('/', 'refresh');
		}
	}
	
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('pass');
		$remember = $this->input->post('remember');
		
		if (!empty($email) && !empty($password)) {
			$sql = "SELECT * FROM users WHERE email = ? AND active=1 LIMIT 1";
			$query = $this->db->query($sql, $email);
			$row = $query->row_array();
			
			if (!empty($row)) {
				$user_id = $row['id'];
				$session_id = $this->rand_str_gen(60);
				$username = $row['username'];
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$phone = $row['phone'];
				$address = $row['address'];
				$address2 = $row['address2'];
				$city = $row['city'];
				$state = $row['state'];
				$zip = $row['zip'];
				$country = $row['country'];
				
				$pass_hash = $row['password'];
				$active = $row['active'];
					
				if (password_verify($password, $pass_hash)) {
          			if (strcmp($active, 'y') == 0) {
          			
						$session_data = array(
	    					'user' => $session_id,
	    					'username' => $username,
	    					'email'	=> $email,
	    					'first' => $first_name,
	    					'last' => $last_name,
	    					'phone' => $phone,
	    					'address1' => $address,
	    					'address2' => $address2,
	    					'city' => $city,
	    					'state' => $state,
	    					'zip' => $zip,
	    					'country' => $country
	  					);
	   					$this->session->set_userdata($session_data);
	   					
	   					if(isset($remember)) {
	   						$cookie = array(
    							'name'   => 'remember',
    							'value'  => $session_id,
    							'expire' => 7 * 24 * 60 * 60, // 7 days, 86,400 seconds in a day
    							'domain' => 'localhost'
							);
							set_cookie($cookie);
	   						//set_cookie('remember', 1, 7 * 24 * 60 * 60, 'theblackshoppingnetwork.com'); // 7 days
	   					}
	   					
	   					$ip_address = getenv('REMOTE_ADDR');
	   					$sql = "INSERT INTO logins (user_id, ip_address, created) VALUES (?, ?, now())";
	   					$query = $this->db->query($sql, array($user_id, $ip_address));
	   					
	   					
	   					$sql_update = "UPDATE users SET session_id=? WHERE id=?";
	   					$query_update = $this->db->query($sql_update, array($session_id, $user_id));
	   					
						//return 'welcome back.';
						redirect('/', 'refresh');
					} else {
						return 'user no longer active.';
					}
				} else {
					return 'email or password not found.';
				}
			} else {
				return 'email or password not found.';
			}
		} else {
			return 'please enter a username and a password.';
		} 	
	}
	
	function register() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$confirm = $this->input->post('confirm');
		$ip_address = getenv('REMOTE_ADDR');
		
		if (!empty($email) && !empty($password) && !empty($confirm)) {
			$valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
			
			if (!$valid_email) {
      			return 'email is invalid. please try another.';
   			}
			
			if ($password != $confirm) {
      			return 'the password fields did not match.';
    		}
    		
   			if (strlen($password) < 6) {
      			return 'your password is too short. use more than 5 characters please.';
    		}
    		
    		//check if email exists here
			$sql_check = "SELECT * FROM users WHERE email=? LIMIT 1";
			$sql_query = $this->db->query($sql_check, $email);
			$row = $sql_query->row_array();
			if ($row) {
				return $email . ' is already in use. Did you <a href="' . base_url() . 'forgot">forget</a> your password?';
			}
    		
			
			$pass_hash = password_hash($password,PASSWORD_BCRYPT);
			$url_tag = $this->rand_str_gen(60);
			$session_id = $this->rand_str_gen(60);
			$username = 'user_' . $this->rand_str_gen(60);
			
			$username_check = $this->user($username, TRUE);
			if ($username_check)
				$username = 'user_' . $this->rand_str_gen(60);
			
			$sql_insert = "INSERT INTO users (email, password, username, ip_address, session_id, created) VALUES (?, ?, ?, ?, ?, now())";
			
			$query_insert = $this->db->query($sql_insert, array($email, $pass_hash, $username, $ip_address, $session_id));
			
			$user_id = $this->db->insert_id();
			
			$sql_insert_tag = "INSERT INTO url_tags (user_id, type, tag, created) VALUES (?, ?, ?, now())";
			$query_insert_tag = $this->db->query($sql_insert_tag, array($user_id, 'r', $url_tag));
			/*$config = Array(
        		'protocol' => 'smtp',
        		'smtp_host' => 'ssl://smtp.googlemail.com',
        		'smtp_port' => 587,
        		'smtp_user' => 'internetgrind@gmail.com',
        		'smtp_pass' => 'jbwcxx99'
      		);*/
	   		
	   		/*$this->load->library('email', $config);
      
        	$this->email->set_newline('\r\n');
      
        	$this->email->from('welcome@theblackshoppingnetwork.com');
        	$this->email->to($email);
        	$this->email->subject('The Black Shopping Network Activation');
        	$this->email->message('<!DOCTYPE html><html><head><meta charset="UTF-8">
        	<title>The Black Shopping Network Message</title>
        	</head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
        	<a href="http://www.theblackshoppingnetwork.com">
        	<img src="http://www.theblackshoppingnetwork.com/images/logo.png" width="36" height="30" alt="theblackshoppingnetwork" style="border:none; float:left;">
        	</a>The Black Shopping Network Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$email.',<br /><br />
        	Click the link below to activate your account when ready:<br /><br /><a href="http://www.theblackshoppingnetwork.com/activation/id/'.$url_tag.'">
        	Click here to activate your account now</a><br /><br />
        	Login after successful activation using your:<br />* E-mail Address: <b>'.$email.'</b></div></body></html>');
        
      
        	if($this->email->send()) {
          		return 'Thank you for registering. Your email was sent. Please validate your email by clicking the link inside.';
        	} else {
          		show_error($this->email->print_debugger());
          		//return 'An error was encountered that caused the register email not to be sent. Please <a href="base_url()contact">contact us with alerting us to this issue, and make sure to include your email in the message.';
        	
        	}*/
	   		
	   		return 'There was an error processing your registration. Please <a href="' . base_url() . 'contact">contact</a> us.';
			 
		} else {
			return 'all fields must be completed for registration.';
		} 
	}
	
	function forgot() {
		$email = $this->input->post('email');
		$sql = "SELECT id, email FROM users WHERE email=? AND active=1 LIMIT 1";
		$query = $this->db->query($sql, $email);
		
		$row = $query->row_array();
		if ($row) {
			$row_id = $row['id'];
			$url_tag = $this->rand_str_gen(60);
			$sql_insert_tag = "INSERT INTO url_tags (user_id, type, tag, created) VALUES (?, ?, ?, now())";
			$query_insert_tag = $this->db->query($sql_insert_tag, array($row_id, 'f', $url_tag));
			
			/*$config = Array(
        		'protocol' => 'smtp',
        		'smtp_host' => 'ssl://smtp.googlemail.com',
        		'smtp_port' => 587,
        		'smtp_user' => 'reset@theblackshoppingnetwork.com',
        		'smtp_pass' => 'jbwcxx99'
      		);*/
	   		
	   		/*$this->load->library('email', $config);
      
        	$this->email->set_newline('\r\n');
      
        	$this->email->from('reset@theblackshoppingnetwork.com');
        	$this->email->to($email);
        	$this->email->subject('The Black Shopping Network Reset Password');
        	$this->email->message('<!DOCTYPE html><html><head><meta charset="UTF-8"><title>The Black Shopping Network Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.theblackshoppingnetwork.com"><img src="http://www.theblackshoppingnetwork.com/images/logo.png" width="36" height="30" alt="theblackshoppingnetwork" style="border:none; float:left;"></a>The Black Shopping Network Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$email.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://www.theblackshoppingnetwork.com/activation.php?id='.$url_tag.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$email.'</b></div></body></html>');
        	
        	<p>This is an automated message from The Black Shopping Network. If you did not recently initiate the Forgot 
				Password process, please disregard this email.</p><p>You indicated that you forgot your login password.</p>
				<p><a href="http://www.theblackshoppingnetwork.com/reset/id/'.$url_tag.'">Please click the temporary link to reset your password</a></p>
				<p>If you do not click the link in this email, no changes will be made to your account.</p>';
        	if($this->email->send()) {
          		return 'An email was sent to the address you provided with instructions on how to reset your password.';
        	} else {
        		show_error($this->email->print_debugger());
          		//return 'An error was encountered that caused the reset email not to be sent. Please <a href="base_url()contact">contact us with alerting us to this issue, and make sure to include your email in the message.';
        	}*/
        	return 'Debug: message sent';
		} else {
			return 'No user was found with that email.';
		}
	}
	
	function check_url_tag() {
		$id = $this->input->post('id');
		
		if (!$id)
			redirect('/', 'refresh');
		
		$sql = "SELECT * FROM url_tags WHERE tag=? AND active='y' LIMIT 1";
		$query = $this->db->query($sql, $id);
		
		$row = $query->row_array();
		
		if (!empty($row)) {
			$tag_id = $row['id'];
			$sql_update = "UPDATE url_tags set active='n' WHERE id=?";
			$query_update = $this->db->query($sql_update, $tag_id);
		}
		
		return $row;
	}
	
	function change_password($user_id) {
		$url_tag = $this->input->post('id');
		$password = $this->input->post('password');
		$confirm = $this->input->post('confirm');
		
		if (!empty($password) && !empty($confirm)) {
			if ($password != $confirm) {
      			return 'the password fields did not match.';
    		}
    		
   			if (strlen($password) < 6) {
      			return 'your password is too short. use more than 5 characters please.';
    		}
    		
    		$sql_check_tag = "SELECT * FROM url_tags WHERE tag=? LIMIT 1";
    		$query_check_tag = $this->db->query($sql_check_tag, $url_tag);
    		$row_tag = $query_check_tag->row_array();
    		
    		if (empty($row_tag)) {
    			return "id not found or expired. please try to <a href=\"base_url()reset\">reset</a> your password again.";
    		}
    		
    		$user_id = $row_tag['user_id'];
    		
    		$sql_update = "UPDATE users SET password=? WHERE id=? LIMIT 1";
    		$query_update = $this->db->query($sql_update, array($password, $user_id));
    		return "your password was updated.";
    	}
	}
	
	function contact() {
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
      	//$subject = 'Online Query From: ' . $email;
      	$body = $this->input->post('body');
      
      	$sql = "INSERT INTO contact (email,subject,body,created) VALUES (?, ?, ?, now())";
      	$query = $this->db->query($sql, array($email, $subject, $body));
      
      	/*$this->load->library('email');
      
      	$this->email->set_newline('\r\n');
      
      	$this->email->from('auto-responder@whiteowlent.com');
      	$this->email->to('whiteowlemail@gmail.com');
      	$this->email->subject($subject);
      	$this->email->message($body);
      
      	if($this->email->send()) {
        	$data['content'] = 'Your message has been sent. Someone will get in contact with you shortly.';
        	$this->load->view('result_view', $data);
      	} else {
        	$data['content'] = 'Hmmm.... There seems to be a problem in sending your message.';
        	$this->load->view('result_view', $data);
      	}*/
      	return 'Debug: message sent';
    }
	
	function edit($user) {
		$username = $this->input->post('username');
    	$first_name = $this->input->post('first_name');
    	$last_name = $this->input->post('last_name');
    	$phone = $this->input->post('phone');
    	$address = $this->input->post('address');
    	$address2 = $this->input->post('address2');
    	$city = $this->input->post('city');
    	$state = $this->input->post('state');
    	$zip = $this->input->post('zip');
    	$country = $this->input->post('country');
    	$user_session = $user['user'];
    	$bool_username_taken = false;
    	$user_id = 0;
    	
    	$user_from_session = $this->get_user_from_session($user_session);
		
		if ($user_from_session) {
			$user_id = $user_from_session['id'];
    	} else {
    		return "Session invalid.";
    	}
    	
    	$sql_username_check = "SELECT id FROM users WHERE username=? LIMIT 1";
    	$query = $this->db->query($sql_username_check, $username);
    	
    	if ($query->num_rows() > 0) {
    		$bool_username_taken = true;
    	}
    	
    	//unset session
    	//$array_items = array('username' => '', 'first_name' => '', );
		//$this->session->unset_userdata($array_items);
		
    		$session_data = array(
	    		'first' => $first_name,
	    		'last' => $last_name,
	    		'phone' => $phone,
	    		'address1' => $address,
	    		'address2' => $address2,
	    		'city' => $city,
	    		'state' => $state,
	    		'zip' => $zip,
	    		'country' => $country
	  		);
	   		$this->session->set_userdata($session_data);
    		
    	if ($bool_username_taken) {
    	
    		$sql = "UPDATE users SET first_name=?, last_name=?, phone=?, address=?, address2=?, city=?, state=?, zip=?, country=?, updated=now() WHERE id=?";
    		$query = $this->db->query($sql, array($first_name, $last_name, $phone, $address, $address2, $city, $state, $zip, $country, $user_id));
    		return 'The username you have chosen is already taken. Please select another username. The rest of your profile has been updated.';
    	} else {
    		$_SESSION['username'] = $username;
    		$sql = "UPDATE users SET username=?, first_name=?, last_name=?, phone=?, address=?, address2=?, city=?, state=?, zip=?, country=?, updated=now() WHERE id=?";
    		$query = $this->db->query($sql, array($username, $first_name, $last_name, $phone, $address, $address2, $city, $state, $zip, $country, $user_id));
    		return 'Your user profile has been updated.';
    	}
	}
	
	function validate_user() {
		$this->load->library('session');
		$this->load->helper('cookie');
		$user_session = $this->session->get_userdata('user');
		
		if (empty($user_session['user'])) {
			$remember_cookie = get_cookie('remember');
			//echo "RememberCookie: $remember_cookie\n";
			if (!$remember_cookie)
				return 0;
			
			$user = $this->get_user_from_session($remember_cookie);
			
			if ($user) {
				//echo "Got User From Session\n";
				$session_id = $remember_cookie;
				$email = $user['email'];
				$username = $user['username'];
				$first_name = $user['first_name'];
				$last_name = $user['last_name'];
				$phone = $user['phone'];
				$address = $user['address'];
				$address2 = $user['address2'];
				$city = $user['city'];
				$state = $user['state'];
				$zip = $user['zip'];
				$country = $user['country'];
			
			
				$session_data = array(
	    			'user' => $session_id,
	    			'username' => $username,
	    			'email'	=> $email,
	    			'first' => $first_name,
	    			'last' => $last_name,
	    			'phone' => $phone,
	    			'address1' => $address,
	    			'address2' => $address2,
	    			'city' => $city,
	    			'state' => $state,
	    			'zip' => $zip,
	    			'country' => $country
	  			);
	  			
	   			$user_session = $this->session->set_userdata($session_data);
	   			return $session_data;
	   		}
		}
		
		return $user_session;
	}
	
	function log_page_view() {
		$user_session = $this->validate_user();
		$user = null;
		$field_id = 0;
	
		if ($user_session['user']) {
			$user = $this->get_user_from_session($user_session['user']);
		}
		
		if($this->uri->segment(3)) {
			$field_id = $this->uri->segment(3);
		}
		
		if($this->uri->segment(1)) {
			$page_name = $this->uri->segment(1);
			$sql_get_page = "SELECT * FROM pages WHERE name=? LIMIT 1";
				
			$query_page = $this->db->query($sql_get_page, $page_name);
			$row = $query_page->row_array();
			if (!empty($row)) {
				$page_id = $row['id'];
				$ip_address = getenv('REMOTE_ADDR');
				
				$sql_insert_page_view = "INSERT INTO page_views (page_id, page_field, user_id, ip_address, created) VALUES (?, ?, ?, ?, now())";
				$page_view_array = array($page_id, $field_id, 0, $ip_address);
				if($user['id']) {
					$page_view_array = array($page_id, $field_id, $user['id'], $ip_address);
				}
				$query_insert = $this->db->query($sql_insert_page_view, $page_view_array);
			}
		}
	}
	
	function review_template($product_id) {
		$user_session = $this->validate_user();
		$user = null;
		$order_row = array();
		$review_row = array();
		$reviews_row = array();
		
		if ($user_session['user']) {
			$user = $this->get_user_from_session($user_session['user']);
		}
		
		if ($user['id']) {
			$sql_get_order = "SELECT * FROM orders WHERE product_id=? AND user_id=? AND shipped='y' AND fulfilled='y' LIMIT 1";
			$query_order = $this->db->query($sql_get_order, array($product_id, $user['id']));
			$order_row = $query_order->row_array();
		}
		
		if (!empty($order_row)) {
			$sql_get_review = "SELECT * FROM reviews WHERE product_id=? AND user_id=? LIMIT 1";
			$query_review = $this->db->query($sql_get_review, array($product_id, $user['id']));
			$review_row = $query_review->row_array();
		}
		
		$sql_get_reviews = "SELECT * FROM reviews WHERE product_id=? ORDER BY created DESC";
		$query_reviews = $this->db->query($sql_get_reviews, $product_id);
		$reviews_row = $query_reviews->result_array();
		$i = 0;
		
		foreach($reviews_row as $row) {
			$user_id = $row['user_id'];
			$user_info = $this->user($user_id);
			if ($user_info) {
				$username = $user_info['username'];
				$reviews_row[$i]['username'] = $username;	
				$i++;
			} 
		}
		
		$ordered = empty($order_row) ? false : true;
		$reviewed = empty($review_row) ? false : true;
		$return_array = array('user' => $user, 'reviewed' => $reviewed, 'ordered' => $ordered, 'reviews' => $reviews_row);
		
		return $return_array;
	}
	
	function review() {
		$user_session = $this->validate_user();
		$user_id = 0;
		
		if ($user_session['user']) {
			$user = $this->get_user_from_session($user_session['user']);
			$user_id = $user['id'];
			if (!$user_id)
				return 0;
		} else {
			return 0;
		}	
		
		$product_id = $this->input->post('product_id');
		$rating = $this->input->post('rating');
      	$review = $this->input->post('review');
      
      	$sql = "INSERT INTO reviews (product_id, user_id, rating, review, created) VALUES (?, ?, ?, ?, now())";
      	$query = $this->db->query($sql, array($product_id, $user_id, $rating, $review));
	}
}