<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller {
	
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
        $d['active'] = "assign";

        $data['device'] = $this->db->query('SELECT device.*,VD_id FROM device LEFT JOIN vehicle_device_assgn on device_id = VD_device_id WHERE device_expiry_date = "9999-12-31" AND VD_id is null')->result_array();
        $data['vehicle'] = $this->db->query('SELECT vehicle.*,VD_id FROM vehicle LEFT JOIN vehicle_device_assgn on vehicle_id = VD_vehicle_id WHERE vehicle_expiry_date = "9999-12-31" AND VD_id is null')->result_array();
        $data['assign'] = $this->db->query('SELECT vehicle_device_assgn.*,vehicle_no FROM `vehicle_device_assgn` JOIN vehicle ON vehicle_id = VD_vehicle_id')->result_array();

        // echo "<pre>";print_r($data['assign']);die();
		$this->load->view('Admin/admin_header');
		$this->load->view('Assign/vehicle_device_assign',$data);
		$this->load->view('Admin/admin_footer',$d);
	}

	public function vehicle_device_assign()
	{
		$assgn['VD_device_id'] = $this->input->post('VD_device_id');
		$assgn['VD_vehicle_id'] = $this->input->post('VD_vehicle_id');
		$assgn['VD_effective_date'] = date('Y-m-d');

		$this->db->insert('vehicle_device_assgn',$assgn);

		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Vehicle & Device Assigned Successfully...!!");
        $this->session->set_flashdata('type',"success");

        redirect('Assign');
	}
	public function delete_vehicle_assgn()
	{
		$VD_id = $_POST['VD_id'];
		$this->db->set('VD_expiry_date', date('Y-m-d'))->where('VD_id', $VD_id)->update('vehicle_device_assgn');
	}
	public function vehicle_device_assign_update()
	{
		$assgn['VD_device_id'] = $this->input->post('VD_device_id');
		$assgn['VD_vehicle_id'] = $this->input->post('VD_vehicle_id');
		$assgn['VD_id'] = $this->input->post('VD_id');

		$this->db->set($assgn)->where('VD_id',$assgn['VD_id'])->update('vehicle_device_assgn');

		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Details Updated Successfully.");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
		redirect('Assign');
	}


}    