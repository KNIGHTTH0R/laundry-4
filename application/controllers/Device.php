<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {
	
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
        $d['active'] = "device";
        
		$data['device'] = $this->Device_model->fetch_device();

		$this->load->view('Device/device_header');
		$this->load->view('Device/device_registration',$data);
		$this->load->view('Device/device_footer',$d);
	}
	public function add_registration()
	{
		$device['device_id'] =  $this->input->post('device_id');
		$device_id = $this->Device_model->already_exits_device($device);

		$num['device_mobile_number'] =  $this->input->post('device_mobile_number');
		$mobile_no = $this->Device_model->already_exits_mobile($num);

		if($device_id != 0){
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Device Already Registered.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"warning");
			redirect('Device');
		}
		elseif($mobile_no != 0){
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Mobile Number Already Configured With Other Device.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"warning");
			redirect('Device');
		}
		else{
			$device_registration['device_id'] = $device['device_id'];
			$device_registration['device_mobile_number'] = $num['device_mobile_number'];
			$device_registration['device_mobile_IMSI_number'] = $this->input->post('device_mobile_IMSI_number');
			$device_registration['device_mobile_sim_number'] = $this->input->post('device_mobile_sim_number');
			$device_registration['device_non_moving_frequency'] =  $this->input->post('device_non_moving_frequency');
			$device_registration['device_port_number'] =  $this->input->post('device_port_number');
			$device_registration['device_effective_date'] = date('Y-m-d');
			
			$this->Device_model->device_registration($device_registration);
			
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Device Added Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Device');
				
		}
	}

	function update_device($device_id){
		$this->session->set_userdata('update_device',$device_id);
		redirect('Device/update_device_view');
	}

	function update_device_view()
	{
		if(!isset($this->session->userdata['super_admin']))
		{
			redirect('/');
		}   
		$device['flash']['active'] = $this->session->flashdata('active');
    	$device['flash']['title'] = $this->session->flashdata('title');
    	$device['flash']['text'] = $this->session->flashdata('text');
    	$device['flash']['type'] = $this->session->flashdata('type');

		$d['active'] = 'device';

		$device_id = $this->session->userdata('update_device');
		$device_update['device'] = $this->Device_model->fetch_device_update($device_id);

		$this->load->view('Device/device_header');
		$this->load->view('Device/update_device',$device_update);
		$this->load->view('Device/device_footer',$d);
	}

	function update_device_details()
	{
		$data['device_id'] = $this->input->post('device_id');
		$data['device_mobile_number'] = $this->input->post('device_mobile_number');
		$data['device_mobile_IMSI_number'] = $this->input->post('device_mobile_IMSI_number');
		$data['device_mobile_sim_number'] = $this->input->post('device_mobile_sim_number');
		$data['device_non_moving_frequency'] =  $this->input->post('device_non_moving_frequency');
		$data['device_port_number'] =  $this->input->post('device_port_number');
		$con = $this->Device_model->update_device_details($data);
		if($con != 0){
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Device not Updated...");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"warning");
			redirect('Device');
		}else{
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Device Updated Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Device');
		}
	}

	function deactivate_device($device_id)
	{
		$this->session->set_userdata('deactivate_device',$device_id);
		redirect('Device/disable_device');
	}

	function disable_device(){
		$device_id = $this->session->userdata('deactivate_device');
		$vehicle_device_details = $this->Device_model->fetch_vehicle_device($device_id);
		if (empty($vehicle_device_details)){
			$con = $this->Device_model->disable_device($device_id);
			if($con != 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Device not Deactivated...");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
				redirect('Device');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Device Deactivated.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Device');
			}
		}
		else{
			$VD_vehicle_id = $vehicle_device_details[0]['VD_vehicle_id'];
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"");
            $this->session->set_flashdata('text',"Device Already Assign to Vehicle ID ".$VD_vehicle_id."");
            $this->session->set_flashdata('type',"warning");
			redirect('Device');
		}
	}

	function device_active($device_id)
	{
		$this->session->set_userdata('active_device',$device_id);
		redirect('Device/enable_device');
	}

	function enable_device(){
		$device_id = $this->session->userdata('active_device');
		$con = $this->Device_model->enable_device($device_id);
		if($con != 0){
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Device not Activated...");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"warning");
			redirect('Device');
		}else{
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Device Activated.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Device');
		}
	}



}    