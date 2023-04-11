<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_images_model extends CI_Model {

	function product_images_all($limit = 0, $offset = 0) {
		$sql = "SELECT * FROM products WHERE active = 'y' ORDER BY created DESC LIMIT ?, ?";
		$limit_array = array((int)$limit, (int)$offset);
		$query = $this->db->query($sql,$limit_array);

		$return_array = array();
		$i = 0;
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$product_id = $row->id;
				$sql2 = "SELECT * FROM product_images WHERE product_id = ? ORDER BY name ASC";
				$query2 = $this->db->query($sql2, $product_id);
				$image_array = array();
				
				if ($query2->num_rows() > 0) {
					$return_array[$i]['product'] = $row;
					$j = 0;
					foreach ($query2->result() as $row2) {
						$image_array[$j] = $row2;				
						++$j;
					}
					$return_array[$i]['images'] = $image_array;
					++$i;
				}
			}
		}
		
		return $return_array;
	}
	
	function product_images($id) {
		$sql = "SELECT id, product_id, name FROM product_images WHERE product_id = ? ORDER BY name ASC";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	function product_image($id) {
		$sql = "SELECT id, product_id, name FROM product_images WHERE product_id = ? ORDER BY name DESC LIMIT 1";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
}