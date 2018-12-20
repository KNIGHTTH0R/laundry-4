<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WalkIn extends CI_Controller {
	function __construct(){
        parent::__construct();

        if(!isset($this->session->userdata['admin']))
        {   
            redirect('Authentication');
        }
    }
    
    public function index()
    {
        $nav['flash']['active'] = $this->session->flashdata('active');
        $nav['flash']['title'] = $this->session->flashdata('title');
        $nav['flash']['text'] = $this->session->flashdata('text');
        $nav['flash']['type'] = $this->session->flashdata('type');
        $admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
        $data['lat'] = $admin['branch_latitude'];   
        $data['long'] = $admin['branch_longitude'];
        $data['user'] = $this->db->query("SELECT * FROM `user` where user_expiry_date = '9999-12-31'")->result_array();
        $data['product_category'] = $this->db->query("SELECT product_category FROM `product` where product_item IS Null and product_rate IS Null and product_expiry_date = '9999-12-31' and product_branch_id =".$admin['branch_id']."")->result_array();
        $nav['dash'] = "walkin";
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('WalkIn/walkin',$data);
        $this->load->view('WalkIn/walkin_footer',$nav);
    }

    function add_walkin_details()
    {
        $admin = $this->session->userdata('admin');
        $walkin['user_profile_image'] = 'https://8xlaundry.com/uploads/profile_image/default_employee_image.png';
        $walkin['user_first_name'] = $this->input->post('user_first_name');
        $walkin['user_last_name'] = $this->input->post('user_last_name');
        $walkin['user_mobile_no'] = $this->input->post('user_mobile_no');
        $walkin['user_address_area'] = $this->input->post('user_address_area');
        $walkin['user_address_house_no'] = $this->input->post('user_address_house_no');
        $walkin['user_address_city'] = $this->input->post('user_address_city');
        $walkin['user_address_state'] = $this->input->post('user_address_state');
        $walkin['user_address_pincode'] = $this->input->post('user_address_pincode');
        $walkin['user_latitude'] = $this->input->post('user_latitude');
        $walkin['user_longitude'] = $this->input->post('user_longitude');
        $walkin['user_effective_date'] = date('Y-m-d');
        $verify = $this->db->query("SELECT * from user where user_mobile_no = ".$walkin['user_mobile_no']."")->num_rows();
        if($verify == 0){
            $this->db->insert('user',$walkin);
            $this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Thank You!");
            $this->session->set_flashdata('text',"User Added Successfully...!!");
            $this->session->set_flashdata('type',"success");
            redirect('WalkIn');
        }else{
            $this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Sorry!");
            $this->session->set_flashdata('text',"User Already Exist...!!");
            $this->session->set_flashdata('type',"warning");
            redirect('WalkIn');
        }
    }

    function fetch_item_details()
    {
        $admin = $this->session->userdata('admin');
        $category = $_POST['category'];
        $data = $this->db->query("SELECT * FROM `product` where product_item is not null and product_expiry_date = '9999-12-31' and product_category = '".$category."' and product_branch_id =".$admin['branch_id']."")->result_array();
        echo json_encode($data);
    }

    function fetch_item_price()
    {
        $admin = $this->session->userdata('admin');
        $item = $_POST['item'];
        $data = $this->db->query("SELECT product_rate,case when product_qty_type = '1' then 'KG' else 'No' end as product_qty_type FROM `product` where product_id = ".$item."")->result_array();
        echo json_encode($data);
    }

    function fetch_item_services()
    {
        $admin = $this->session->userdata('admin');
        $item = $_POST['item'];
        $data = $this->db->query("SELECT addon_name,addon_id,addon_rate FROM `addon_services` where addon_product_id =".$item."")->result_array();
        echo json_encode($data);
    }

    function fetch_addon_rate()
    {
        $addon = $_POST['addon'];
        $data = $this->db->query("SELECT GROUP_CONCAT(addon_name)as addon_name,sum(addon_rate)as addon_rate FROM addon_services where addon_id IN (".$addon.")")->result_array();
        echo json_encode($data);
    }

    function add_walkin_request()
    {
        //echo "<pre>";
        $admin = $this->session->userdata('admin');
        $this->db->query("insert into request values(NULL,".$this->input->post('user_details').",".$admin['branch_id'].",date_format(now(),'%Y-%m-%d'),Time_format(NOW(),'%H:00:00'),Time_format(DATE_ADD(NOW(), INTERVAL 1 HOUR),'%H:00:00'),2,0,0,'0000-00-00',NULL,NULL,NULL);");
        $last_id = $this->db->insert_id();
        $walkin['user_details'] = $this->input->post('user_details');
        $walkin['request_product_category'] = $this->input->post('request_product_category[]');
        $walkin['request_product_item'] = $this->input->post('request_product_item[]');
        $walkin['request_product_quantity'] = $this->input->post('request_product_quantity[]');
        $walkin['product_price_quantity'] = $this->input->post('product_price_quantity[]');
        $walkin['request_product_addon_service'] = $this->input->post('request_product_addon_service[][]');
        $walkin['request_product_total_amount'] = $this->input->post('request_product_total_amount[]');
        
        $product_count = count($walkin['request_product_category']);
		$addon="";
        for ($i=0; $i < $product_count; $i++) { 
            if (!empty($walkin['request_product_addon_service'])) {
                if (array_key_exists($i, $walkin['request_product_addon_service'])) {
					$addon=",";
                   $addon = implode(',',$walkin['request_product_addon_service'][$i]);
                }
                else
                {
                    $addon="";
                }
            }
            else
            {
                $addon="";
            }
           $price = explode ('/',$walkin['product_price_quantity'][$i]);
           $amt = explode (' ',$walkin['request_product_total_amount'][$i]);
           if(!empty($walkin['request_product_quantity'][$i])){
           $this->db->query("insert into inward SELECT NULL as inward_id,".$walkin['user_details']." as inward_user_id,".$admin['branch_id']." as inward_branch_id,".$last_id." as inward_request_id,
                ".$walkin['request_product_item'][$i]." as inward_product_id,".$price[0]." as inward_product_rate,".$walkin['request_product_quantity'][$i]." as inward_product_quantity,".$amt[0]." as inward_total_amount,GROUP_CONCAT(addon_name)as addon_name,date_format(now(),'%Y-%m-%d') as inward_date, Time_format(NOW(),'%H:%i:%s') as inward_time,NULL as date,2 as status,0 as pickup_emp,0 as drop_emp FROM addon_services where addon_id IN (0".$addon.")");
       		}
        }
        $data=$this->db->query("SELECT sum(inward_product_quantity) as total_qty , sum(inward_total_amount) as total_amt FROM inward where inward_request_id=".$last_id."")->result_array();
        
        $no = $this->db->query("SELECT user_mobile_no from user where user_id = ".$walkin['user_details']."")->result_array();
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=28QHnbg118a&MobileNo=91".$no[0]['user_mobile_no']."&SenderID=ATEXLD&Message=Dear+Customer%2C+%0A+%0A+Your+Request+has+been+Submitted+Successfully.+%0A+%0A+Request+id+%3A+".$last_id.".+%0A+Total+Qty+%3A+".$data[0]['total_qty'].".+%0A+Payable+Amount+%3A+Rs.".$data[0]['total_amt'].".+%0A+%0A+Regards%2C+%0A+8x-Laundry.&ServiceName=TEMPLATE_BASED");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output =curl_exec($ch);
        curl_close($ch);
        $sms_details = explode(":", $output);
        $msg = "Dear Customer,\nYour Request has been Submitted Successfully.\nRequest id : ".$last_id.".\nTotal Qty : ".$data[0]['total_qty'].".\nPayable Amount : Rs.".$data[0]['total_amt'].".\nRegards,\n8x-Laundry.";
        $this->db->query("INSERT into sent_sms values(NUll,NUll,'5','".$sms_details[2]."','".$sms_details[1]."','".$sms_details[4]."',1,'".$msg."',". $walkin['user_details'].",".$admin['branch_id'].")");
        $this->db->query("update sms set sms_count=sms_count-1");
        $this->db->query("update request set request_qty=".$data[0]['total_qty']." ,request_amount= ".$data[0]['total_amt']." where request_id=".$last_id."");
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Request Added Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('Request');
    }

}
?>