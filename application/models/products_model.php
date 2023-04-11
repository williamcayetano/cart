<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model {

	function products_all() {
		//print "Limit $limit: Offset $offset";
		//exit;
		$sql = "SELECT * FROM products WHERE active='y'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function product($id) {
		$sql = "SELECT name, cart_desc, price FROM products WHERE active = 'y' AND id = ? LIMIT 0,1";
		$query = $this->db->query($sql, $id);
		return $query->row();
	}
	
	function read_by_ids($ids) {
		$return_array = array();
		$i = 0;
		foreach($ids as $id) {		
			$sql = "SELECT id, name, price FROM products WHERE id=? LIMIT 1";
			$query = $this->db->query($sql, $id);
			$return_array[$i] = $query->row();
			$i++;
		}
		return $return_array;
	}
	/*
	function get_shipping($ids) {
		$return_array = array();
		$i = 0;
		foreach($ids as $id) {		
			$sql = "SELECT * FROM orders WHERE product_id=? LIMIT 1";
			$query = $this->db->query($sql, $id);
			$return_array[$i] = $query->row();
			$i++;
		}
		return $return_array;
	}*/
}