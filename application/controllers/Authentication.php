<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	
	public function index()
	{   
		// if(isset($this->session->userdata['admin']))
  //       {
  //           redirect('Admin');
  //       }
  //       if(isset($this->session->userdata['super_admin']))
  //       {
  //           redirect('Device');
  //       }

		$data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type');

		$this->load->view('Dashboard/login',$data);
	}

	function login()
	{
		$this->form_validation->set_rules('user_username','trim|required');
		$this->form_validation->set_rules('user_password','password','trim|required');

		if($this->form_validation->run() == FALSE){

			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Sorry!");
	        $this->session->set_flashdata('text',"Please Enter Correct Details");
	        $this->session->set_flashdata('type',"warning");
			redirect('Authentication');
		}
		else
		{
			$data['user_username'] = $this->input->post('user_username');
			$data['user_password'] = md5($this->input->post('user_password'));
			
			
			$log_check = $this->Authentication_model->login($data);
			
			if($log_check == 1){
				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Sorry!");
		        $this->session->set_flashdata('text',"Please Enter Correct Username");
		        $this->session->set_flashdata('type',"warning");

				redirect('Authentication');
			}
			if($log_check == 2){
				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Sorry!");
		        $this->session->set_flashdata('text',"Please Enter Correct Password.");
		        $this->session->set_flashdata('type',"warning");

				redirect('Authentication');
			}
			if ($log_check == 3) {
				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Sorry!");
		        $this->session->set_flashdata('text',"Unauthorized User");
		        $this->session->set_flashdata('type',"warning");
	        
				redirect('Authentication');
			}


		}
	}

	public function logout()
	{
		$sessiondata['user_username'] = '';
		$sessiondata['user_password'] = '';

		$this->session->unset_userdata('admin',$sessiondata);
		$this->session->unset_userdata('super_admin',$sessiondata);
		$this->session->unset_userdata('update_password',$sessiondata);
		
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Logout Successfully..!!");
        $this->session->set_flashdata('type',"success");
        redirect('/');
	}

	function change_password()
	{
		$data['employee_details'] = $this->session->userdata('update_password');
		$this->load->view('Dashboard/change_password',$data);
	}

	function update_password()
	{
		$pass['employee_id'] = $this->input->post('employee_profile_id');
		$pass['employee_password'] = md5($this->input->post('user_password'));
		$pass['employee_password1'] = $this->input->post('user_password');
		$this->db->set('employee_password',$pass['employee_password'])->where('employee_id',$pass['employee_id'])->update('employee');
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Password has been Updated");
        $this->session->set_flashdata('text',"Please login with updated password");
        $this->session->set_flashdata('type',"success");
        $this->session->unset_userdata('update_password');
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('super_admin');
        redirect('/');
	}



}    