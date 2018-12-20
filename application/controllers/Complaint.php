<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint extends CI_Controller {
	function __construct(){
        parent::__construct();

        if(!isset($this->session->userdata['admin']))
        {   
            redirect('Authentication');
        }
    }
    
    public function index()
    {
        $admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
        $data['complaint_list'] = $this->db->query("SELECT complaint_id,user_first_name,user_last_name,user_mobile_no,complaint_text,DATE_FORMAT(complaint_text_date,'%D %b %Y') as complaint_text_date,complaint_reply FROM `complaint` JOIN request ON complaint_request_id = request_id JOIN user ON complaint_user_id = user_id WHERE complaint_branch_id = ".$admin['employee_branch_id']." AND user_expiry_date = '9999-12-31' ORDER BY `complaint_id` DESC")->result_array();
        // echo "<pre>";print_r($data);die();
        $d['flash']['active'] = $this->session->flashdata('active');
        $d['flash']['title'] = $this->session->flashdata('title');
        $d['flash']['text'] = $this->session->flashdata('text');
        $d['flash']['type'] = $this->session->flashdata('type'); 
        $d['active'] = "complaint";
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Complaint/complaint_list',$data);
        $this->load->view('Complaint/complaint_footer',$d);
    }

    function view_complaint()
    {
        $admin = $this->session->userdata('admin');
        $data['employee_profile_image'] = $admin['employee_profile_image'];
        $complaint_id = $_POST['complaint_id'];
        $data['complaint_list'] = $this->db->query("SELECT user_profile_image,user_last_name,user_first_name,DATE_FORMAT(complaint_text_date,'%D %b %Y') as complaint_text_date,DATE_FORMAT(complaint_reply_date,'%D %b %Y') as complaint_reply_date,complaint_text, complaint_reply,complaint_id FROM `complaint` JOIN request ON complaint_request_id = request_id JOIN user ON complaint_user_id = user_id WHERE complaint_id = ".$complaint_id." AND complaint_branch_id = ".$admin['employee_branch_id']." AND user_expiry_date = '9999-12-31' ORDER BY `complaint_id` DESC")->row();
        echo json_encode($data);
    }

    function update_complaint_status()
    {
        $complaint_id = $_POST['co_id'];
        $complaint_reply = $_POST['co_reply'];
        $complaint_date = date('Y-m-d');
        $this->db->set('complaint_reply',$complaint_reply)->set('complaint_reply_date',$complaint_date)->where('complaint_id',$complaint_id)->update('complaint');        
        echo json_encode($complaint_reply);
    }

}