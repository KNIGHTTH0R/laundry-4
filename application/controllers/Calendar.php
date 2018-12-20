<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function index()
	{
		$admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
		$admin['employee_branch_id']= $admin['employee_branch_id'];
        
        $data['events'] = $this->db->query('SELECT * FROM `holiday` WHERE holiday_branch_id = '.$admin['employee_branch_id'].'')->result_array();
	
		$data['holiday'] = $this->db->query('SELECT * FROM `holiday` WHERE holiday_branch_id = '.$admin['employee_branch_id'].' AND YEAR(holiday_start_date) = YEAR(CURDATE()) ORDER BY `holiday`.`holiday_start_date` ASC')->result_array();	
		$data['year'] = 0;
		if (!empty($data['events'])) 
		{
			for ($i=0; $i < count($data['events']); $i++) 
			{ 
				$year_array[] = substr($data['events'][$i]['holiday_start_date'],0,4);	
			}
			$year = array_unique($year_array);

			$test1 = implode(',', $year);
			$data['year'] = explode(',', $test1);
		}	


        $data['active'] = 'holiday';
        $data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type');

        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Calendar/holiday',$data);
	}

	function addEvent()
	{
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Holiday added successfully");
        $this->session->set_flashdata('type',"success");

		$admin = $this->session->userdata('admin');
		$data1['employee_branch_id']= $admin['employee_branch_id'];

		$data['holiday_branch_id'] = $data1['employee_branch_id'];
		$data['holiday_name'] = $this->input->post('title');
		$data['holiday_start_date'] = $this->input->post('start');
		$data['holiday_end_date'] = $this->input->post('end');

		$this->db->insert('holiday',$data);

		redirect('Calendar');
	}

	public function cal_edit()
	{
		$data = $this->input->post();
		if (array_key_exists("delete",$data))
		{
			if($data['delete'] == 'on')
			{
				$sql = "DELETE FROM holiday WHERE holiday_id = ".$data['id']."";
				$this->db->query($sql);
				redirect('Calendar');
			}

		}else{
			if ($data['id']!= '') 
			{
				$data1['holiday_name'] = $data['title'];
				$this->db->where('holiday_id',$data['id'])->update('holiday',$data1);
				redirect('Calendar');
			}
		}
	}

	public function select_cal_edit()
	{ 
		$id = $_POST['Event'][0];
		$start = $_POST['Event'][1];
		$end = $_POST['Event'][2];

		$sql = "UPDATE holiday SET  holiday_start_date = '".$start."', holiday_end_date = '".$end."' WHERE holiday_id = ".$id." ";
		$rep = $this->db->query($sql);
		echo json_encode($rep);
		// redirect('Company');
		// echo json_encode($new[0]);
	}

	function event_delete()
	{
		$id = $_POST['event_id'];	
		$this->db->query('DELETE FROM holiday WHERE holiday_id = "'.$id.'"');
	}
	function delete_event($id)
	{
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Holiday deleted successfully");
        $this->session->set_flashdata('type',"success");

		$this->db->query('DELETE FROM holiday WHERE holiday_id = "'.$id.'"');
		redirect('Calendar/index');
	}

	function year_wise_list()
	{
		$admin = $this->session->userdata('admin');
		$data1['employee_branch_id']= $admin['employee_branch_id'];

		$select_year = $_POST['select_year'];
		$data5 = $this->db->query('SELECT * FROM `holiday` WHERE holiday_branch_id = '.$data1['employee_branch_id'].' AND  YEAR(holiday_start_date)="'.$select_year.'" ORDER BY `holiday`.`holiday_start_date` ASC')->result_array();	
		echo json_encode($data5);
	}

}
