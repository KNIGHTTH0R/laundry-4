<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {
	
	public function index()
	{     
		if(!isset($this->session->userdata['admin']))
		{
			redirect('/');
		}     
		$d['flash']['active'] = $this->session->flashdata('active');
        $d['flash']['title'] = $this->session->flashdata('title');
        $d['flash']['text'] = $this->session->flashdata('text');
        $d['flash']['type'] = $this->session->flashdata('type');
        $d['active'] = "vehicle";

        $data['vehicle_list'] = $this->Vehicle_model->vehicle_list();
        $cnt = 0;
        $cnt_pending = 0;
        for ($i=0; $i <count($data['vehicle_list']) ; $i++) 
        { 
        	if ($data['vehicle_list'][$i]['VD_id'] == NULL) 
        	{
        		$cnt_pending = $cnt_pending+1;		
        	}
        	else
        	{
        		$cnt = $cnt +1;
        	}	
        }
        $d['cnt'] = $cnt;
        $d['cnt_pending'] = $cnt_pending;

        $data['cnt'] = $cnt;
        $data['cnt_pending'] = $cnt_pending;

		$this->load->view('Admin/admin_header');
		$this->load->view('Vehicle/vehicle_registration',$data);
		$this->load->view('Admin/admin_footer',$d);
	}
	public function vehicle_registration()
	{
		$vehicle['vehicle_no'] = $this->input->post('vehicle_no');
		$vehicle['vehicle_effective_date'] = date('Y-m-d');

		$reg_check = $this->Vehicle_model->reg_check($vehicle);

		if($reg_check == 4)
		{
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Sorry!");
            $this->session->set_flashdata('text',"Vehicle Number Already Exists");
            $this->session->set_flashdata('type',"warning");
        
			redirect('Vehicle');
		}
		else
		{
			$this->Vehicle_model->vehicle_registration($vehicle);

			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Thank You!");
	        $this->session->set_flashdata('text',"Vehicle added Successfully...!!");
	        $this->session->set_flashdata('type',"success");

			redirect('Vehicle');
		}
	}

	public function vehicle_update()
	{
		$vehicle['vehicle_no'] = $this->input->post('vehicle_no');
		$vehicle['vehicle_id'] = $this->input->post('vehicle_id');

		$this->db->set($vehicle)->where('vehicle_id',$vehicle['vehicle_id'])->update("vehicle", $vehicle);

		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Vehicle Details Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");

		redirect('Vehicle');
	}
	public function delete_vehicle()
	{
		$vehicle_id = $_POST['vehicle_id'];
		$this->db->set('vehicle_expiry_date', date('Y-m-d'))->where('vehicle_id', $vehicle_id)->update('vehicle');
	}
	public function vehicle_details()
	{
		if(!isset($this->session->userdata['admin']))
		{
			redirect('/');
		}   
		$d['flash']['active'] = $this->session->flashdata('active');
        $d['flash']['title'] = $this->session->flashdata('title');
        $d['flash']['text'] = $this->session->flashdata('text');
        $d['flash']['type'] = $this->session->flashdata('type');
        $d['active'] = "details";

		$data['vehicle_details'] = $this->db->query('SELECT vehicle.*,VD_device_id FROM `vehicle` LEFT JOIN vehicle_device_assgn ON VD_vehicle_id = vehicle_id AND VD_expiry_date = "9999-12-31" WHERE vehicle_expiry_date = "9999-12-31"')->result_array();
		// echo "<pre>";print_r($data);die();
		$this->load->view('Admin/admin_header');
		$this->load->view('Vehicle/vehicle_details',$data);
		$this->load->view('Admin/admin_footer',$d);
	}


}    