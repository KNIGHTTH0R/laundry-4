<?php 

class Product_model extends CI_model {

	public function get_all()
	{
		return $this->db->query("SELECT * FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id=0 and product_item IS NOT NULL and product_rate IS NOT NULL order by product_id")->result_array();
	}

	public function get_all_category()
	{
		return $this->db->query("SELECT * FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id=0 and product_item IS NULL and product_rate IS NULL order by product_id")->result_array();
	}

	public function get_all_item($prod_cat)
	{
		// return $prod_cat;
		return $this->db->query("SELECT product_id,product_item,product_category FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id=0 and product_item IS NOT NULL and product_rate IS NOT NULL and product_category IN('".$prod_cat."') order by product_id")->result_array();
	}

	public function get_final_item_list($prod_item)
	{
		// return $prod_cat;
		return $this->db->query("SELECT product_id,product_item,product_category FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id=0 and product_item IS NOT NULL and product_rate IS NOT NULL and product_id = ".$prod_item."")->result_array();
	}

	public function get_all_service($prod_item)
	{
		// return $prod_item;
		return $this->db->query("SELECT addon_id,addon_name,product_item FROM product join addon_services on product_id = addon_product_id WHERE product_expiry_date = '9999-12-31' and product_branch_id=0 and addon_branch_id = 0 and product_item IS NOT NULL and product_rate IS NOT NULL and product_item IN('".$prod_item."') order by addon_id")->result_array();
	}

	public function get_final_service_list($prod_service)
	{
		// return $prod_item;
		return $this->db->query("SELECT addon_id,addon_name,product_item,product_category FROM product join addon_services on product_id = addon_product_id WHERE product_expiry_date = '9999-12-31' and product_branch_id=0 and addon_branch_id = 0 and product_item IS NOT NULL and product_rate IS NOT NULL and addon_id =".$prod_service."")->result_array();
	}

	public function add_new($data)
	{
		return $this->db->insert('product',$data);
	}

	public function get_all_admin_product($product_branch_id)
	{
		return $this->db->query("SELECT * FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id= ".$product_branch_id." ")->result_array();
	}
}
?>