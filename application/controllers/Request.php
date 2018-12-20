<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
	function __construct(){
        parent::__construct();

        if(!isset($this->session->userdata['admin']))
        {   
            redirect('Authentication');
        }
    }
    
    public function index()
    {
        $data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type'); 

        $admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
        $data['request'] = $this->db->query("SELECT request_user_id,CONCAT(user_last_name,' ',user_first_name)as username,branch_id,branch_name,request_id,DATE_FORMAT(request_date,'%D %b %Y') as request_date,TIME_FORMAT(request_start_time,'%h:%i %p') as request_start_time,TIME_FORMAT(request_end_time,'%h:%i %p') as request_end_time,request_status,CASE when request_status = 1 then 'Pick Up' when request_status = 2 then 'Approved' when request_status = 3 then 'Under Process' when request_status = 4 then 'Work Done' when request_status = 5 then 'Delivered' when request_status = 6 then 'Cancelled' else request_status end as status,
        	request_qty,request_amount,case when request_expected_delivery_date='0000-00-00' then 'NA' else DATE_FORMAT(request_expected_delivery_date,'%D %b %Y') end as request_expected_delivery_date,case when request_delivery_start_time='00:00:00' then 'NA' else TIME_FORMAT(request_delivery_start_time,'%h:%i %p') end as request_delivery_start_time,case when request_delivery_end_time='00:00:00' then 'NA' else TIME_FORMAT(request_delivery_end_time,'%h:%i %p') end as request_delivery_end_time,request_delivery_charges FROM `request` join branch on request_branch_id = branch_id join user on request_user_id = user_id where request_branch_id = ".$admin['employee_branch_id']." order by DATE_FORMAT(request_date,'%Y%m%d') DESC")->result_array();
        $data['request_details'] = $this->db->query("SELECT * from (SELECT count(*) as total_request FROM `request` where request_branch_id = ".$admin['employee_branch_id'].") as a,
                    (SELECT count(*) as pickup_request FROM `request` where request_branch_id = ".$admin['employee_branch_id']." and request_status ='1') as pickup,
                    (SELECT count(*) as approval_request FROM `request` where request_branch_id = ".$admin['employee_branch_id']." and request_status ='2') as approval,
                    (SELECT count(*) as under_process_request FROM `request` where request_branch_id = ".$admin['employee_branch_id']." and request_status ='3') as under,
                    (SELECT count(*) as work_done_request FROM `request` where request_branch_id = ".$admin['employee_branch_id']." and request_status ='4') as work,
                    (SELECT count(*) as delivery_request FROM `request` where request_branch_id = ".$admin['employee_branch_id']." and request_status ='5') as delivery,
                    (SELECT count(*) as cancel_request FROM `request` where request_branch_id = ".$admin['employee_branch_id']." and request_status ='6') as cancel")->result_array();
        $nav['request'] = "request";
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Request/request_details',$data);
        $this->load->view('Request/request_footer',$nav);
    }

    function cancel_request()
    {
        $request_id = $this->input->post('request_id');
        $this->db->set('request_status','6')->where('request_id',$request_id)->update('request');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request has been Cancelled Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        redirect('Request');
    }

    function approved_request()
    {
        $request_id = $_POST['request_id'];
        $this->db->set('request_status','3')->where('request_id',$request_id)->update('request');
        $this->db->set('inward_status','3')->where('inward_request_id',$request_id)->update('inward');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request has been Process Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        echo json_encode($request_id); 
        // redirect('Request');
    } 

    function under_process_request()
    {
        $admin = $this->session->userdata('admin');
        $request_id = $_POST['request_id'];
        $this->db->set('request_status','4')->where('request_id',$request_id)->update('request');
        $this->db->set('inward_status','4')->where('inward_request_id',$request_id)->update('inward');
        $no = $this->db->query("SELECT request_user_id,user_mobile_no from user JOIN request on user_id = request_user_id where request_id = ".$request_id."")->result_array();
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=28QHnbg118a&MobileNo=91".$no[0]['user_mobile_no']."&SenderID=ATEXLD&Message=Dear+Customer%2C+%0A+%0A+Your+Work+Request+".$request_id."+has+been+done+successfully.+%0A+Please+call+to+Laundry+on+91".$admin['branch_contact_no']."+to+schedule+your+delivery+Timing.+%0A+%0A+Regards%2C+%0A+8x-Laundry.&ServiceName=TEMPLATE_BASED");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output =curl_exec($ch);
        curl_close($ch);
        $sms_details = explode(":", $output);
        $msg = "Dear Customer, Your Work Request ".$request_id." has been dome successfully. Please Call to Laundry on ".$admin['branch_contact_no']." to scheduled your delivery Timing. Regards, 8x-Laundry.";
        $this->db->query("INSERT into sent_sms values(NUll,NUll,'2','".$sms_details[2]."','".$sms_details[1]."','".$sms_details[4]."',1,'".$msg."',".$no[0]['request_user_id'].",".$admin['branch_id'].")");
        $this->db->query("update sms set sms_count=sms_count-1");
        // echo json_encode($output);
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request has been Process Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        echo json_encode($request_id); 
    }

    function work_done_request()
    {
        $request_id = $_POST['request_id'];
        $this->db->set('request_status','5')->where('request_id',$request_id)->update('request');
        $this->db->set('inward_status','5')->where('inward_request_id',$request_id)->update('inward');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request has been Process Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        echo json_encode($request_id); 
        // redirect('Request');
    } 

    function inward_request_details($value='')
    {
        $request_id = $_POST['request_id'];
        $data = $this->db->query("SELECT product_category,product_item,inward_product_rate,inward_product_quantity,inward_total_amount
            ,case when inward_status = '1' then 'PickUp' when inward_status = '2' then 'Approved' when inward_status = '3' then 'Under Process' when inward_status = '4' then 'Work Done' when inward_status = '5' then 'Delivered' when inward_status = '6' then 'Cancelled' end as inward_status FROM `inward` join product on inward_product_id = product_id where inward_request_id =".$request_id."")->result_array();
        echo json_encode($data);
    }

    function Update_deliverDateTime()
    {
        $request_id = $this->input->post('request_id');
        $request_expected_delivery_date = $this->input->post('request_expected_delivery_date');
        $request_delivery_start_time = DATE("H:i:00",STRTOTIME($this->input->post('request_delivery_start_time')));
        $request_delivery_end_time = DATE("H:i:00",STRTOTIME($this->input->post('request_delivery_end_time')));
        $this->db->set('request_expected_delivery_date',$request_expected_delivery_date)->set('request_delivery_start_time',$request_delivery_start_time)->set('request_delivery_end_time',$request_delivery_end_time)->where('request_id',$request_id)->update('request');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request Delivery Date & Time Updated Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        redirect("Request");
    }
}