<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class SMS extends CI_Controller {

	

	function __construct(){

		parent::__construct();



		if(!isset($this->session->userdata['super_admin']))

    	{	

    		redirect('Authentication');

		}

	}



	public function index()

	{

		$data['user'] = $this->db->query("SELECT user_id,concat(user_first_name,' ',user_last_name)as username,user_mobile_no,user_address_area FROM `user` where user_expiry_date ='9999-12-31'")->result_array();

		$nav['pie_chart_data'] = $this->db->query("select branch_name,case when cnt is NULL then 0 else cnt end as cnt from (select '8x-Laundry' as branch_name,'0' as branch_id union all select branch_name,branch_id from branch) as branch left join (SELECT sent_sms_branch_id,sum(sent_sms_count) as cnt FROM `sent_sms` group by sent_sms_branch_id) as sms_count on branch_id=sent_sms_branch_id")->result_array(); 

		$data['pending'] = $this->db->query("select 'Pending' as branch_name,concat(sms_count,'/',(total_cnt+sms_count)) as cnt from sms,(select sum(sent_sms_count) as total_cnt from sent_sms) as total")->result_array();

		$nav['sms'] = 'sms';

		$this->load->view('su/su_header');

		$this->load->view('SMS/user_sent_sms',$data);

		$this->load->view('SMS/sms_footer',$nav);

	}



	function send_user_sms()

	{

		

		$msg = urlencode($this->input->post('user_sms'));

		$Msg = $this->input->post('user_sms');

		$user = $this->input->post('user_id[]');

		$cnt = count($user);

		for ($i=0; $i < $cnt; $i++) { 

			$user_id = $user[$i];

			$no = $this->db->query("SELECT user_mobile_no from user where user_id = ".$user_id."")->result_array();

			$ch=curl_init();

	        curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendUnicodeSMS.aspx?APIKEY=28QHnbg118a&MobileNo=91".$no[0]['user_mobile_no']."&SenderID=ATEXLD&Message=".$msg."&ServiceName=PROMOTIONAL_SPL");

	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	        $output =curl_exec($ch);

	        curl_close($ch);

	        $sms_details = explode(":", $output);

	        $this->db->query("INSERT into sent_sms values(NUll,NUll,'3','".$sms_details[2]."','".$sms_details[1]."','".$sms_details[4]."',1,'".$Msg."',".$user_id.",0)");

	        $this->db->query("update sms set sms_count=sms_count-1");



	        $this->session->set_flashdata('active',1);

            $this->session->set_flashdata('title',"Successfully Message send to Customer.");

            $this->session->set_flashdata('text',"");

            $this->session->set_flashdata('type',"success");

            redirect('SMS');

		}

	}



	function sms_details()

	{

		$data['sms'] = $this->db->query("SELECT sent_sms.*,case WHEN sent_sms_type = '1' then 'Pick Up' WHEN sent_sms_type = '2' then 'Delivery' WHEN sent_sms_type = '3' then 'Personalized' WHEN sent_sms_type = '4' then 'OTP' WHEN sent_sms_type = '5' then 'Request' WHEN sent_sms_type = '6' then 'Payment' WHEN sent_sms_type = '7' then 'Payment Remainder' else 'NA' end as sms_type,CONCAT(user_first_name,' ',user_last_name)as username,branch_name FROM `sent_sms` left join user on sent_sms_user_id = user_id left join branch on sent_sms_branch_id=branch_id order by sent_sms_id DESC  limit 1000")->result_array();

		$nav['pie_chart_data'] = $this->db->query("select branch_name,case when cnt is NULL then 0 else cnt end as cnt from (select '8x-Laundry' as branch_name,'0' as branch_id union all select branch_name,branch_id from branch) as branch left join (SELECT sent_sms_branch_id,count(*) as cnt FROM `sent_sms` group by sent_sms_branch_id) as sms_count on branch_id=sent_sms_branch_id")->result_array(); 

		$nav['sms'] = 'sms';

		$this->load->view('su/su_header');

		$this->load->view('SMS/sms_details',$data);

		$this->load->view('SMS/sms_footer',$nav);

	}

}

?>