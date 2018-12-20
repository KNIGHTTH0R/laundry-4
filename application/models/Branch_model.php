<?php 

class Branch_model extends CI_model {

	public function add_new($data)
	{
		$this->db->insert('branch',$data);
		$data = $this->db->query("SELECT branch_id FROM `branch` ORDER BY branch_id DESC limit 1")->result_array();
		$res = $this->db->query("SELECT product_id FROM product where product_branch_id='0'")->num_rows();
		if ($res != 0)
		{
			$this->db->query("insert into product SELECT NULL,".$data[0]['branch_id'].",product_icon,product_category,product_item,product_rate,product_qty_type,'2018-08-06','9999-12-31' FROM `product` where product_branch_id=0");
			$this->db->query("insert into addon_services select NULL as addon_id,addon_name,product_id,addon_rate,".$data[0]['branch_id']." as branch_id,product_effective_date,Null as expiry_date from (select * from product where product_branch_id=".$data[0]['branch_id'].") as prdct join (select addon_name,addon_rate,product_category as category,product_item as item from addon_services join product on addon_product_id=product_id and product_Branch_id=0 where addon_branch_id=0) as data0 on category=product_category and item=product_item");
		}
		return 0;
	}

	public function get_all()
	{
		return $this->db->get('branch')->result_array();
	}
}
?>