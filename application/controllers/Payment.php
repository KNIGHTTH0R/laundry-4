<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Payment extends CI_Controller {
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
        $data['user'] = $this->db->query("select user_id,concat(user_name,'     [ Rs.',user_pending_amount,' ]') as user_name from (select
                user_id
                ,concat(user_first_name,' ',user_last_name) as user_name
                ,case when payment_user_id is NULL then total_amount else (total_amount-payment) end as user_pending_amount
                from user
                join (SELECT
                request_user_id
                ,round(sum(request_amount),0) as total_amount
                FROM request
                where request_branch_id='".$admin['employee_branch_id']."'
                group by request_user_id
                ) as request
                on request_user_id=user_id
                left join ( SELECT
                payment_user_id
                ,sum(payment_amount+payment_discount) as payment
                FROM payment
                where payment_branch_id='".$admin['employee_branch_id']."'
                group by payment_user_id
                  )as payment
                on payment_user_id=user_id) as data
                where user_pending_amount > 0")->result_array();
        $data['user_payment'] = $this->db->query("SELECT user.user_id
                            ,user.user_profile_image
                            ,concat(user.user_first_name,' ',user.user_last_name) as name
                            ,user.user_mobile_no
                            ,case when user.user_expiry_date='9999-12-31' then 'Active' else 'Inactive' end as user_status
                            ,case when type_1_cnt is NULL then '0' else type_1_cnt end as  type_1_cnt
                            ,case when type_2_cnt is NULL then '0' else type_2_cnt end as  type_2_cnt
                            ,case when type_3_cnt is NULL then '0' else type_3_cnt end as  type_3_cnt
                            ,case when type_4_cnt is NULL then '0' else type_4_cnt end as  type_4_cnt
                            ,case when type_5_cnt is NULL then '0' else type_5_cnt end as  type_5_cnt
                            ,case when type_6_cnt is NULL then '0' else type_6_cnt end as  type_6_cnt
                            ,case when total_qty is NULL then '0' else total_qty end as  total_qty
                            ,case when total_amount is NULL then '0' else total_amount end as  total_amount
                            ,case when total_received is NULL then '0' else total_received end as  total_received
                            ,case when payment_discount is NULL then '0' else payment_discount end as  payment_discount
                            ,case when (total_amount - total_received - payment_discount) is NULL then '0' else (total_amount - total_received - payment_discount) end as pending_amount
                            FROM user
                            join 
                            (select request_user_id from request where request_branch_id=".$admin['employee_branch_id']." Group by request_user_id) as user_id
                            on user_id.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,count(request_user_id) as type_1_cnt
                            from request
                            where request_status=1
                            and request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as type_1
                            on type_1.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,count(request_user_id) as type_2_cnt
                            from request
                            where request_status=2
                            and request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as type_2
                            on type_2.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,count(request_user_id) as type_3_cnt
                            from request
                            where request_status=3
                            and request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as type_3
                            on type_3.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,count(request_user_id) as type_4_cnt
                            from request
                            where request_status=4
                            and request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as type_4
                            on type_4.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,count(request_user_id) as type_5_cnt
                            from request
                            where request_status=5
                            and request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as type_5
                            on type_5.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,count(request_user_id) as type_6_cnt
                            from request
                            where request_status=6
                            and request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as type_6
                            on type_6.request_user_id=user_id
                            left join (
                            select
                            request_user_id
                            ,sum(request_qty) as total_qty
                            ,sum(request_amount) as total_amount
                            from request
                            where request_branch_id=".$admin['employee_branch_id']."
                            Group by request_user_id
                               ) as total
                            on total.request_user_id=user_id
                            left join (
                            SELECT
                            payment_user_id
                            ,sum(payment_amount) as total_received
                            ,sum(payment_discount) as payment_discount
                            FROM payment
                            where payment_branch_id=".$admin['employee_branch_id']."
                            group by payment_user_id
                               ) as received
                            on received.payment_user_id=user_id")->result_array();
        $data['payment'] = "payment";
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Payment/user_pay_details',$data);
    }

    public function daily_book()
    {
        $data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type'); 

        $admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
        $data['employee_details'] = $this->db->query("SELECT * FROM `employee` where employee_branch_id = ".$admin['employee_branch_id']." and employee_account_type = '2' and employee_expiry_date = '9999-12-31'")->result_array();
        $data['day_book'] = $this->db->query("SELECT 
                        concat(user_first_name,' ',user_last_name) as name
                            ,user_mobile_no
                            ,payment_admin_id
                            ,concat(admin.employee_first_name,' ',admin.employee_last_name) as admin_name
                            ,payment_id
                            ,DATE_FORMAT(payment_date,'%D %b %Y') as payment_date
                            ,payment_date as date_payment
                            ,TIME_FORMAT(payment_time,'%h:%i %p') as payment_time
                            ,case when employee.employee_first_name is NULL then 'Walking Receipt' else concat(employee.employee_first_name,' ',employee.employee_last_name) end as emp_name 
                            ,case when payment_method=1 then 'Cash' else 'Paytm' end as payment_method
                            ,payment_amount
                            ,payment_discount
                            ,case when payment_status=1 then 'Payment Received but Pending for approval' else 'Payment Approved by User' end as payment_status
                        FROM payment
                        join user
                        on payment_user_id=user_id
                        left join employee
                        on payment_employee_id = employee.employee_id
                        left join (select * from employee where employee_account_type=2) as admin
                        on admin.employee_id=payment_admin_id
                        WHERE payment_branch_id=".$admin['employee_branch_id']."")->result_array();
        $nav['payment'] = "payment";
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Payment/daily_book',$data);
        $this->load->view('Payment/payment_footer',$nav);
    }

    function user_payemnt_details()
    {
        $user_id = $_POST['user_id'];
        $data = $this->db->query("select 
                DATE_FORMAT(sql_date, '%d-%m-%Y') as date
                ,description
                ,request_amount
                ,payment_amount
                from 
                (
                    (
                        SELECT
                        request_date as sql_date
                        ,concat('order No ',request_id,' ; Total Qty ',request_qty) as description
                        ,request_amount
                        ,'0' as payment_amount
                        FROM user
                        join request
                        on request_user_id=user_id
                        WHERE user_id='".$user_id."'
                        and user_id != ''
                            and request_status not in (1,6)
                        order by request_date
                    )
                    union
                    (
                        SELECT
                        payment_date as sql_date
                        ,case when payment_method=1 and payment_discount != '0' then concat('Cash received by hand with Discount of Rs.',payment_discount ) 
                            when payment_method=1 and payment_discount = '0' then 'Cash received by hand'
                            when payment_method=2 and payment_discount != '0' then concat('Payment received on paytm with Discount of Rs.',payment_discount )
                            else 'Payment received on paytm' end as description
                        ,'0' as request_amount
                        ,payment_amount
                        FROM user
                        join payment
                        on payment_user_id=user_id
                        WHERE user_id='".$user_id."'
                        and user_id != ''
                        order by payment_date
                    )
                    union
                    (
                        SELECT
                        payment_date as sql_date
                        ,'Discount' as description
                        ,'0' as request_amount
                        ,payment_discount
                        FROM user
                        join payment
                        on payment_user_id=user_id
                        WHERE user_id='".$user_id."'
                        and user_id != ''
                        and payment_discount != '0'
                        order by payment_date
                    )

                ) as data
                order by sql_date desc")->result_array();
        echo json_encode($data); 
        // redirect('Request');
    }

     function user_info_details()
    {
        $user_id = $_POST['user_id'];
        $data = $this->db->query("SELECT
                        concat(user_first_name,' ' ,user_last_name) as username
                        ,user_mobile_no
                        ,case when req is NULL then '0' else req end as req
                        ,case when pay is NULL then '0' else pay end as pay
                        ,case when dis is NULL then '0' else dis end as dis
                        ,case when (req-pay-dis) is NUll then '0' else  (req-pay-dis) end as balance
                        FROM user
                        ,(select sum(payment_amount) as pay ,sum(payment_discount) as dis from payment where payment_user_id=".$user_id.") as payment
                        ,(select sum(request_amount) as req  from request where request_user_id=".$user_id.") as request
                        WHERE user_id=".$user_id."
                        and user_id != ''")->result_array();
        echo json_encode($data); 
        // redirect('Request');
    }

    function approved_request()
    {
        $request_id = $_POST['request_id'];
        $this->db->set('request_status','3')->where('request_id',$request_id)->update('request');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request has been Process Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        echo json_encode($request_id); 
        // redirect('Request');
    } 

    function under_process_request()
    {
        $request_id = $_POST['request_id'];
        $this->db->set('request_status','4')->where('request_id',$request_id)->update('request');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Request has been Process Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        echo json_encode($request_id); 
        // redirect('Request');
    }

    function update_payment_admin()
    {
        $payment_id = $this->input->post("payment_id");
        $payment_admin_id = $this->input->post("payment_admin_id");
        $this->db->set('payment_admin_id',$payment_admin_id)->where('payment_id',$payment_id)->update('payment');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Payment Admin updated Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        redirect('Payment/daily_book');
    }

    function add_walkin_payment_details()
    {
        $admin = $this->session->userdata('admin');
        $payment_user_id = $this->input->post('payment_user_id');
        $payment_method = $this->input->post('payment_method');
        $payment_amount = round($this->input->post('payment_amount'));
        $payment_discount = round($this->input->post('payment_discount'));
        $this->db->query("Insert into payment values(NULL,".$payment_user_id.",".$admin['branch_id'].",0,".$admin['employee_id'].",'".$payment_method."', DATE_FORMAT(now(),'%Y-%m-%d'),TIME_FORMAT(now(),'%H:%i:%s'),".$payment_amount.",".$payment_discount.",'2')");
        $no = $this->db->query("SELECT user_mobile_no from user where user_id = ".$payment_user_id."")->result_array();
        $ch=curl_init();
        $date = date('d+M+Y');
        $time = date("g:i+a");
        curl_setopt($ch,CURLOPT_URL,"http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=28QHnbg118a&MobileNo=91".$no[0]['user_mobile_no']."&SenderID=ATEXLD&Message=Dear+Customer%2C+%0A+%0A+Your+Payment+of+Rs.".$payment_amount."+has+been+received+on+".$date."+at+".$time.".+%0A+%0A+Regards%2C+%0A+8x-Laundry.&ServiceName=TEMPLATE_BASED");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output =curl_exec($ch);
        curl_close($ch);
        $sms_details = explode(":", $output);
        $msg = "Dear Customer, Your Payment of Rs.".$payment_amount." has been received on ".date('d M Y')." at ".date('g:i a').". Regards, 8x-Laundry.";
        $this->db->query("INSERT into sent_sms values(NUll,NUll,'7','".$sms_details[2]."','".$sms_details[1]."','".$sms_details[4]."',1,'".$msg."',".$payment_user_id.",".$admin['branch_id'].")");
        $this->db->query("update sms set sms_count=sms_count-1");
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Payment updated Successfully");
        $this->session->set_flashdata('text',"");
        $this->session->set_flashdata('type',"success");
        redirect('Payment');
    }

    function send_pending_amount_sms()
    {
        $admin = $this->session->userdata('admin');
        $user_id = $_POST['user_id'];
        $amount = $_POST['amount'];
        $no = $this->db->query("SELECT user_mobile_no from user where user_id = ".$user_id."")->result_array();
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=28QHnbg118a&MobileNo=91".$no[0]['user_mobile_no']."&SenderID=ATEXLD&Message=Dear+Customer%2C+%0A+%0A+Your+Outstanding+Balance+amount+is+Rs.".$amount.".+%0A+Kindly+pay+the+amount+at+earliest.+%0A+%0A+Regards%2C+%0A+8x-Laundry.&ServiceName=TEMPLATE_BASED");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output =curl_exec($ch);
        curl_close($ch);
        $sms_details = explode(":", $output);
        $msg = "Dear Customer, Your Outstanding Balance amount is Rs.".$amount.". Kindly pay the amount at earliest. Regards, 8x-Laundry.";
        $this->db->query("INSERT into sent_sms values(NUll,NUll,'7','".$sms_details[2]."','".$sms_details[1]."','".$sms_details[4]."',1,'".$msg."',".$user_id.",".$admin['branch_id'].")");
        $this->db->query("update sms set sms_count=sms_count-1");
        echo json_encode($output);
    }

}