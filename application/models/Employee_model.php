<?php 

class Employee_model extends CI_model {

	public function get_all()
	{
		$q = "SELECT employee.*,branch.branch_name FROM `employee` join branch on employee_branch_id = branch.branch_id where employee_id != 1 order by employee_account_type";
		return $this->db->query($q)->result_array();

		// return $this->db->where('employee_id!=',1)->get('employee')->result_array();
	}
	public function add_new($data)
	{
		return $this->db->insert('employee',$data);
	}
	public function get_all_third_emp($branch_id)
	{
		return $this->db->query("SELECT employee.*,branch_name FROM `employee` LEFT join branch on employee_branch_id = branch_id WHERE employee_account_type NOT IN (1,2) AND employee_branch_id = ".$branch_id."")->result_array();
	}

}
?>