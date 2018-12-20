<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
        $data['total_pending_request'] = $this->db->query("SELECT count(request_id) as total_request FROM request where request_branch_id=".$admin['employee_branch_id']." and request_status IN (1,2,3,4)")->result_array();
        $data['total_comp_request'] = $this->db->query("SELECT count(request_id) as total_request FROM request where request_branch_id=".$admin['employee_branch_id']." and request_status IN ('5')")->result_array();
        // print_r( $data['total_comp_request']);die();
        $data['total_admin'] = $this->db->query("SELECT count(employee_id) as total_employee FROM employee where employee_branch_id =".$admin['employee_branch_id']." and employee_expiry_date='9999-12-31' and employee_account_type IN(2)")->result_array();
        $data['total_deli'] = $this->db->query("SELECT count(employee_id) as total_employee FROM employee where employee_branch_id = ".$admin['employee_branch_id']." and employee_expiry_date='9999-12-31' and employee_account_type IN(3)")->result_array();
        $data['total_request'] = $this->db->query("SELECT count(complaint_id) as total_request FROM complaint where complaint_branch_id=".$admin['employee_branch_id']."")->result_array();
        $data['total_resolve'] = $this->db->query("SELECT count(complaint_id) as total_request FROM complaint  where complaint_reply IS NOT NULL and complaint_reply_date IS NOT NULL and complaint_branch_id=".$admin['employee_branch_id']."")->result_array();
        $data['total_SMS'] = $this->db->query("SELECT sum(sent_sms_count) as total_SMS FROM `sent_sms` where sent_sms_branch_id =".$admin['employee_branch_id']."")->result_array();
        $data['total_revenue'] = $this->db->query("SELECT sum(request_amount)as total_amount FROM request where request_branch_id =".$admin['employee_branch_id']."")->result_array();
        $data['total_active_user'] = $this->db->query("SELECT * FROM `request` join user on request_user_id = user_id where request_branch_id = ".$admin['employee_branch_id']." group by request_user_id")->num_rows();
       $nav['branch_details'] = $this->db->query("SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 7 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 7 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 7 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 7 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered
            UNION
            SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 6 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 6 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 6 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 6 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered
            UNION
            SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 5 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 5 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 5 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 5 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered
            UNION
            SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 4 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 4 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 4 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 4 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered
            UNION
            SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 3 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 3 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 3 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 3 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered
            UNION
            SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 2 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 2 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 2 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 2 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered
            UNION
            SELECT DATE_FORMAT(DATE(NOW() - INTERVAL 1 DAY), '%a') AS Day,DATE_FORMAT(DATE(NOW() - INTERVAL 1 DAY), '%D %b') AS day_date,pending_request,delivered_request from(select count(request_id) as pending_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 1 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(1,2,3,4)) as pending, (select count(request_id) as delivered_request from request where  DATE(request_date) = DATE(DATE(NOW() - INTERVAL 1 DAY)) and request_branch_id = ".$admin['employee_branch_id']." and request_status IN(5,6)) as delivered")->result_array();
        $nav['branch_request_status'] = $this->db->query("SELECT * from 
            (SELECT count(request_id)as total_pickup FROM `request` where request_branch_id =".$admin['employee_branch_id']." and request_status = '1') as request_pickup,
            (SELECT count(request_id)as total_approval FROM `request` where request_branch_id =".$admin['employee_branch_id']." and request_status = '2') as request_approval,
            (SELECT count(request_id)as total_underprocess FROM `request` where request_branch_id =".$admin['employee_branch_id']." and request_status = '3') as request_underprocess,
            (SELECT count(request_id)as total_workdone FROM `request` where request_branch_id =".$admin['employee_branch_id']." and request_status = '4') as request_workdone,
            (SELECT count(request_id)as total_delievred FROM `request` where request_branch_id =".$admin['employee_branch_id']." and request_status = '5') as request_delievred,
            (SELECT count(request_id)as total_cancelled FROM `request` where request_branch_id =".$admin['employee_branch_id']." and request_status = '6') as request_cancelled")->result_array();
        // print_r($data['branch_request_status']);die();
        $nav['dashboard'] = "dashboard";
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Admin/admin_dashboard',$data);
        $this->load->view('Admin/admin_dashboard_footer',$nav);
    }


// ======================================================== Employee ===========================================================================
    public function employees()
    {
        $admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
        
        $data['employees'] = $this->Employee_model->get_all_third_emp($admin['employee_branch_id']);

        $d['active'] = 'employee';
        $d['flash']['active'] = $this->session->flashdata('active');
        $d['flash']['title'] = $this->session->flashdata('title');
        $d['flash']['text'] = $this->session->flashdata('text');
        $d['flash']['type'] = $this->session->flashdata('type');

        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Employee/third_employee_registration',$data);
        $this->load->view('Admin/admin_footer',$d);
    }

    public function add_employee()
    {
        $admin = $this->session->userdata('admin');
        $data['employee_mobile_no']=$this->input->post('employee_mobile_no');
        $data['employee_first_name']=$this->input->post('employee_first_name');
        $data['employee_middle_name']=$this->input->post('employee_middle_name');
        $data['employee_last_name']=$this->input->post('employee_last_name');
        $data['employee_id_proof_no']=$this->input->post('employee_id_proof_no');
        $data['employee_branch_id']= $admin['employee_branch_id'];
        $data['employee_account_type']= "3";
        $data['employee_effective_date']=date('Y-m-d');

        $cnt = $this->db->where('employee_mobile_no',$data['employee_mobile_no'])->get('employee')->num_rows();
        if ($cnt != 0)
        {
            $this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Sorry!");
            $this->session->set_flashdata('text',"Employee Already Exist...!!");
            $this->session->set_flashdata('type',"warning");
            redirect('Admin/employees');
        }else{
            
            $data['employee_profile_image']=$this->upload('profile_image','profile_image');
            $data['employee_id_proof_image']=$this->upload_proof('employee_id_proof_image','ID_Proof');
            $res = $this->Employee_model->add_new($data);
            
            $this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Thank You!");
            $this->session->set_flashdata('text',"Employee Added Successfully...!!");
            $this->session->set_flashdata('type',"success");
            redirect('Admin/employees');
        }
        
    }

    function update_employee()
    {
        $data['employee_id'] = $this->input->post('employee_id');
        $data['employee_first_name'] = $this->input->post('employee_first_name');
        $data['employee_middle_name'] = $this->input->post('employee_middle_name');
        $data['employee_last_name'] = $this->input->post('employee_last_name');
        $data['employee_mobile_no'] = $this->input->post('employee_mobile_no');
        $this->db->set('employee_first_name',$data['employee_first_name'])->set('employee_middle_name',$data['employee_middle_name'])->set('employee_last_name',$data['employee_last_name'])->set('employee_mobile_no',$data['employee_mobile_no'])->where('employee_id',$data['employee_id'])->update('employee');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Employee Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('Admin/employees');
    }


// ==================================================================== Products =========================================================================
    public function products()
    {
        $data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type');
        $admin = $this->session->userdata('admin');
        $admin['branch_logo'] = $admin['branch_logo'];
        // $data['products'] = $this->db->query("SELECT * FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id= ".$admin['employee_branch_id']." and product_item IS NULL and product_rate IS NULL order by product_id")->result_array();
        $data['products'] = $this->db->query("SELECT * FROM product WHERE product_expiry_date = '9999-12-31' and product_branch_id= ".$admin['employee_branch_id']." and product_item IS NOT NULL and product_rate IS NOT NULL order by product_id")->result_array();
        // echo "<pre>";print_r($data['products']);die();/
        $d['active'] = 'product';
        $this->load->view('Admin/admin_header',$admin);
        $this->load->view('Products/admin_product',$data);
        $this->load->view('Admin/admin_footer',$d);
    }
    function fetch_item_acc_product()
    {
        $admin = $this->session->userdata('admin');
        $prod_cat = $_POST['prod_cat'];
  
        $data =  $this->db->query("SELECT product_id,product_item,product_category,product_expiry_date,product_rate FROM product WHERE product_branch_id=".$admin['employee_branch_id']." and product_item IS NOT NULL and product_rate IS NOT NULL and product_category IN('".$prod_cat."') order by product_id")->result_array();
        echo json_encode($data);
    }
    function fetch_service_acc_item()
    {
        $admin = $this->session->userdata('admin');
        $prod_item = $_POST['product_item'];
        $data = $this->db->query("SELECT addon_id,addon_name,product_item,addon_expiry_date,addon_rate FROM product join addon_services on product_id = addon_product_id WHERE product_expiry_date = '9999-12-31' and product_branch_id=".$admin['employee_branch_id']." and addon_branch_id = ".$admin['employee_branch_id']." and product_item IS NOT NULL and product_rate IS NOT NULL and product_item IN('".$prod_item."') order by addon_id")->result_array();
        echo json_encode($data);
    }
    function product_expire()
    {
        $id = $_POST['id'];
        $this->db->query('update product set product_expiry_date = "'.date('Y-m-d').'" where product_id= "'.$id.'" ');
    }
    function product_effective()
    {
        $id = $_POST['id'];
        $this->db->query('update product set product_expiry_date = "9999-12-31" where product_id= "'.$id.'" ');
    }
    function product_addon_expire()
    {
        $id = $_POST['id'];
        $this->db->query('update addon_services set addon_expiry_date = "'.date('Y-m-d').'" where addon_id= "'.$id.'" ');
    }
    function product_addon_effective()
    {
        $id = $_POST['id'];
        $this->db->query('update addon_services set addon_expiry_date = "9999-12-31" where addon_id= "'.$id.'" ');
    }


    function Update_branch_product_rate()
    {
        $product_id = $this->input->post('product_id');
        $product_rate = $this->input->post('product_rate');
        $this->db->set('product_rate',$product_rate)->where('product_id',$product_id)->update('product');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Product Rate Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('Admin/products');

    }

    function Update_branch_addon_service_rate()
    {
        $addon_id = $this->input->post('addon_id');
        $addon_rate = $this->input->post('addon_rate');
        $this->db->set('addon_rate',$addon_rate)->where('addon_id',$addon_id)->update('addon_services');
        $this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Service Rate Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('Admin/products');

    }

    // public function add_product()
    // {

    //     $data['product_category']=$this->input->post('product_category');
    //     $data['product_branch_id']=0;
    //     $data['product_item']=$this->input->post('product_item');

    //     $data['product_icon']=$this->upload_item('product_icon','profile_image');

    //     $data['product_rate']=$this->input->post('product_rate');
    //     $data['product_qty_type']=$this->input->post('product_qty_type');
    //     $data['product_effective_date']=date('Y-m-d');

    //     $res = $this->Product_model->add_new($data);
    //     if($res == 1){
    //         redirect('su/products');
    //     }
    //     else
    //     {
    //         echo "Not register";
    //     }
    // }    

// ================================================================== Upload ===========================================================================
    function upload($file,$folder)
    {
        $config = array(
            'upload_path' => "uploads/".$folder."/",
            'upload_url' => base_url()."uploads/".$folder."/",
            'allowed_types' => "jpg|png|gif|jpeg"
            );
        $this->upload->initialize($config);
        if(!$this->upload->do_upload($file)){
            $user_photo = base_url().'uploads/'.$folder.'/default_employee_image.png';
            return $user_photo;
        }
        else{
            $upload_files = array('upload_data' => $this->upload->data());
            $user_photo = base_url().'uploads/'.$folder.'/'.$upload_files['upload_data']['file_name'];
            $this->upload->data();

            return $user_photo;
        }
    }

    function upload_proof($file,$folder)
    {
        $config = array(
            'upload_path' => "uploads/".$folder."/",
            'upload_url' => base_url()."uploads/".$folder."/",
            'allowed_types' => "jpg|png|gif|jpeg"
            );
        $this->upload->initialize($config);
        if($this->upload->do_upload($file)){
            $upload_files = array('upload_data' => $this->upload->data());
            $user_photo = base_url().'uploads/'.$folder.'/'.$upload_files['upload_data']['file_name'];
            $this->upload->data();

            return $user_photo;
        }
    }

}    