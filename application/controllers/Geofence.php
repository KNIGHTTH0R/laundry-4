<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Geofence extends CI_Controller {
	
	public function index()
	{     
		if(!isset($this->session->userdata['super_admin']))
		{
			redirect('/');
		}    
		$d['flash']['active'] = $this->session->flashdata('active');
        $d['flash']['title'] = $this->session->flashdata('title');
        $d['flash']['text'] = $this->session->flashdata('text');
        $d['flash']['type'] = $this->session->flashdata('type');
        $d['active'] = "geofence";
        
		$data['geofence'] = $this->db->query('SELECT * FROM `geofence`')->result_array();

		$this->load->view('Device/device_header');
		$this->load->view('Geofence/geofence_registration',$data);
		$this->load->view('Device/device_footer',$d);
	}
	public function geofence_registration()
	{
		$geo['geofence_group_name'] = $this->input->post('geofence_group_name');
		$data['geofence_lat'] = $this->input->post('geofence_lat');
		$data['geofence_long'] = $this->input->post('geofence_long');
		$geo['geofence_effective_date'] = date('Y-m-d');

		$reg_check = $this->db->where('geofence_group_name',$geo['geofence_group_name'])->get('geofence')->num_rows();

		if($reg_check != 0)
		{
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Sorry!");
            $this->session->set_flashdata('text',"Geofence Name Already Exists");
            $this->session->set_flashdata('type',"warning");
        
			redirect('Geofence');
		}
		else
		{
			for ($i=0; $i <count($data['geofence_lat']) ; $i++) 
			{ 
				$geo['geofence_lat'] = $data['geofence_lat'][$i];	
				$geo['geofence_long'] = $data['geofence_long'][$i];	
				$geo['geofence_index'] = $i+1;
				$this->db->insert('geofence',$geo);
			}

			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Thank You!");
	        $this->session->set_flashdata('text',"Geofence Added Successfully...!!");
	        $this->session->set_flashdata('type',"success");

	        redirect('Geofence');
	    }    
	}
	function update_geofence($geofence_id){
		$this->session->set_userdata('update_geofence',$geofence_id);
		redirect('Geofence/update_geofence_view');
	}

	function update_geofence_view()
	{
		if(!isset($this->session->userdata['super_admin']))
		{
			redirect('/');
		}  
		$device['flash']['active'] = $this->session->flashdata('active');
    	$device['flash']['title'] = $this->session->flashdata('title');
    	$device['flash']['text'] = $this->session->flashdata('text');
    	$device['flash']['type'] = $this->session->flashdata('type');

		$d['active'] = 'geofence';

		$geofence_id = $this->session->userdata('update_geofence');
		$data['geofence'] = $this->db->where('geofence_id', $geofence_id)->get('geofence')->result_array();

		$this->load->view('Device/device_header');
		$this->load->view('Geofence/geofence_update',$data);
		$this->load->view('Device/device_footer',$d);
	}

	function update_geofence_details()
	{
		$data['geofence_id'] = $this->input->post('geofence_id');
		$data['geofence_group_name'] = $this->input->post('geofence_group_name');
		$data['geofence_lat'] = $this->input->post('geofence_lat');
		$data['geofence_long'] = $this->input->post('geofence_long');
		$this->db->set($data)->where('geofence_id',$data['geofence_id'])->update('geofence');

		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Geofence Updated Successfully.");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
		redirect('Geofence');
	}
	function deactivate_geofence($geofence_id)
	{
		$this->session->set_userdata('deactivate_geofence',$geofence_id);
		redirect('Geofence/disable_geofence');
	}
	function disable_geofence()
	{
		$geofence_id = $this->session->userdata('deactivate_geofence');
		$this->db->set('geofence_expiry_date', date('Y-m-d'))->where('geofence_id', $geofence_id)->update('geofence');
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Geofence Deactivated.");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
		redirect('Geofence');
	}
	function geofence_active($geofence_id)
	{
		$this->session->set_userdata('geofence_active',$geofence_id);
		redirect('Geofence/enable_geofence');
	}
	function enable_geofence()
	{
		$geofence_id = $this->session->userdata('geofence_active');
		$this->db->set('geofence_expiry_date', '9999-12-31')->where('geofence_id', $geofence_id)->update('geofence');
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Geofence Activated.");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
		redirect('Geofence');
	}

}	