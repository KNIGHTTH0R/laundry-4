<?php
	class Authentication_model extends CI_model	{

	public function login($data)
	{
		$login = $this->db->where('employee_mobile_no',$data['user_username'])->get('employee')->result_array();

		// print_r($login);die();
		if(empty($login) || $login[0]['employee_id'] == '' )
		{
			// echo "hii";
			return 1;
		}
		else
		{

				// $login1 = $this->db->from('employee')->join('branch','employee_branch_id=branch_id')->where('employee_mobile_no',$data['user_username'])->where('employee_password',$data['user_password'])->get()->result_array();
				$login1 = $this->db->from('employee')->where('employee_mobile_no',$data['user_username'])->where('employee_password',$data['user_password'])->get()->result_array();

				if(empty($login1) || $login1[0]['employee_id'] == '')
				{
					return 2;
				}
				else
				{

					if($login[0]['employee_expiry_date'] != "9999-12-31")
					{
						return 3;
					}
					else
					{
						if($login[0]['employee_account_type'] == "1")
						{
							$login1 = $this->db->from('employee')->where('employee_mobile_no',$data['user_username'])->where('employee_password',$data['user_password'])->get()->result_array();
							$this->session->set_userdata('super_admin',$login1[0]);
							redirect('Su');
						}
						elseif($login[0]['employee_account_type'] == "2")
						{
							$login1 = $this->db->from('employee')->join('branch','employee_branch_id=branch_id')->where('employee_mobile_no',$data['user_username'])->where('employee_password',$data['user_password'])->get()->result_array();
							
							if ($login[0]['employee_password'] == md5('admin123')) {
								$this->session->set_userdata('update_password',$login1[0]);
								redirect('Authentication/change_password');
							}

							$this->session->set_userdata('admin',$login1[0]);
							redirect('Admin');
						}
						elseif($login[0]['employee_account_type'] == "3")
						{
							return 3;
						}		
					}
				}	
		}
	}





	}
?>