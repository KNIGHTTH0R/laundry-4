<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Su extends CI_Controller {
	
	function __construct(){
		parent::__construct();

		if(!isset($this->session->userdata['super_admin']))
    	{	
    		redirect('Authentication');
		}
	}
	
	public function index()
	{
		$data['total_branch'] = $this->db->query("SELECT count(branch_id) as total_branch FROM branch")->result_array();
		$data['total_admin'] = $this->db->query("SELECT count(employee_id) as total_employee FROM employee where employee_expiry_date='9999-12-31' and employee_account_type IN(2)")->result_array();
		$data['total_deli'] = $this->db->query("SELECT count(employee_id) as total_employee FROM employee where employee_expiry_date='9999-12-31' and employee_account_type IN(3)")->result_array();
		$data['total_request'] = $this->db->query("SELECT count(complaint_id) as total_request FROM complaint")->result_array();
		$data['total_resolve'] = $this->db->query("SELECT count(complaint_id) as total_request FROM complaint  where complaint_reply IS NOT NULL and complaint_reply_date IS NOT NULL")->result_array();
		$data['total_SMS'] = $this->db->query("SELECT sum(sent_sms_count) as total_SMS FROM `sent_sms`")->result_array();
		$data['sms_pending']= $this->db->query("SELECT sms_count from sms")->result_array();
		$data['total_revenue'] = $this->db->query("SELECT case when sum(request_amount) is NULL then '0' else sum(request_amount) end as total_amount FROM request")->result_array();
		$data['total_active_user'] = $this->db->query("SELECT count(user_id) as total_user FROM user where user_expiry_date='9999-12-31'")->result_array();
		$data['total_deactive_user'] = $this->db->query("SELECT count(user_id) as total_user FROM user where user_expiry_date!='9999-12-31'")->result_array();
		$nav['branch_details'] = $this->db->query("SELECT branch_name,case when usr_cnt is NULL then 0 else usr_cnt end as usr_cnt,case when emp_cnt is null then 0 else emp_cnt end as emp_cnt from branch left join (select request_branch_id,count(*) as usr_cnt from (select request_branch_id,request_user_id from request group by 1,2) as user group by request_branch_id) as usr  on branch_id=request_branch_id left join (select employee_branch_id,count(employee_id) as emp_cnt from employee where employee_expiry_date ='9999-12-31' group BY employee_branch_id) as emp on branch_id=employee_branch_id")->result_array();
		$nav['branch_request_status'] = $this->db->query("SELECT branch_id,branch_name,case when cnt1 is NULL then 0 else cnt1 end as cnt1    ,case when cnt2 is NULL then 0 else cnt2 end as cnt2,case when cnt3 is NULL then 0 else cnt3 end as cnt3 FROM branch left join (select request_branch_id,count(*) as cnt1 from request where request_status in (1,2,3,4) group by request_branch_id) as temp1 on temp1.request_branch_id=branch_id left join (select request_branch_id,count(*) as cnt2 from request where request_status in (5) group by request_branch_id) as temp2 on temp2.request_branch_id=branch_id left join (select request_branch_id,count(*) as cnt3 from request where request_status in (6) group by request_branch_id) as temp3 on temp3.request_branch_id=branch_id")->result_array();
		$nav['dash'] = 'dashboard';
		$this->load->view('su/su_header');
		$this->load->view('su/su_dashboard',$data);
		$this->load->view('su/su_footer',$nav);
	}

// =============================================================== Branch =============================================================
	public function branches()
	{
		$data['flash']['active'] = $this->session->flashdata('active');
    	$data['flash']['title'] = $this->session->flashdata('title');
    	$data['flash']['text'] = $this->session->flashdata('text');
    	$data['flash']['type'] = $this->session->flashdata('type');
		$nav['dash'] = 'branch';
		$data['branches'] = $this->Branch_model->get_all();
		$this->load->view('su/su_header');
		$this->load->view('Branches/branch_registration',$data);
		$this->load->view('Branches/branch_footer',$nav);
	}

	public function add_branch()
	{
		$data['branch_name'] = $this->input->post('branch_name');
		$data['branch_area'] = $this->input->post('branch_area');
		$data['branch_contact_no'] = $this->input->post('branch_contact_no');
		$data['branch_home_delivery_charges'] = $this->input->post('branch_home_delivery_charges');
		$data['branch_minimum_delivery'] = $this->input->post('branch_minimum_delivery');
		$data['branch_location_address'] = $this->input->post('branch_location_address');
		$data['branch_latitude'] = $this->input->post('branch_lat');
		$data['branch_longitude'] = $this->input->post('branch_long');
		$data['branch_verification_code'] = $this->input->post('branch_ver_code');
		$data['branch_opening_time'] = $this->input->post('branch_opening_time');
		$data['branch_closed_time'] = $this->input->post('branch_closed_time');
		$data['branch_break_start_time'] = $this->input->post('branch_break_start_time');
		$data['branch_break_end_time'] = $this->input->post('branch_break_end_time');
		$res = $this->db->where('branch_name',$data['branch_name'])->where('branch_area',$data['branch_area'])->get('branch')->num_rows();
		if ($res != 0)
		{		
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Sorry!");
	        $this->session->set_flashdata('text',"Branch Already Exists...!!");
	        $this->session->set_flashdata('type',"warning");
		}else{
			$data['branch_PAYTM_QR_code']=$this->upload_QRcode('branch_paytm_code','QR_Code');
			$data['branch_logo']=$this->upload_logo('branch_logo','Logo');
			$this->Branch_model->add_new($data);
		
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Thank You!");
	        $this->session->set_flashdata('text',"Branch Added Successfully...!!");
	        $this->session->set_flashdata('type',"success");
		}
		redirect('su/branches');
		
	}

	function Update_branch()
	{
		$data['branch_id'] = $this->input->post('branch_id');
		$data['branch_name'] = $this->input->post('branch_name');
		$data['branch_area'] = $this->input->post('branch_area');
		$data['branch_contact_no'] = $this->input->post('branch_contact_no');
		$data['branch_home_delivery_charges'] = $this->input->post('branch_home_delivery_charges');
		$data['branch_location_address'] = $this->input->post('branch_location_address');
		$data['branch_latitude'] = $this->input->post('branch_lat');
		$data['branch_longitude'] = $this->input->post('branch_long');
		$data['branch_verification_code'] = $this->input->post('branch_ver_code');
		$data['branch_opening_time'] = $this->input->post('branch_opening_time');
		$data['branch_closed_time'] = $this->input->post('branch_closed_time');
		$data['branch_break_start_time'] = $this->input->post('branch_break_start_time');
		$data['branch_break_end_time'] = $this->input->post('branch_break_end_time');
		$data['branch_minimum_delivery'] = $this->input->post('branch_minimum_delivery');
		$this->db->set('branch_name',$data['branch_name'])->set('branch_area',$data['branch_area'])->set('branch_location_address',$data['branch_location_address'])->set('branch_latitude',$data['branch_latitude'])->set('branch_longitude',$data['branch_longitude'])->set('branch_verification_code',$data['branch_verification_code'])->set('branch_contact_no',$data['branch_contact_no'])->set('branch_opening_time',$data['branch_opening_time'])->set('branch_closed_time',$data['branch_closed_time'])->set('branch_break_start_time',$data['branch_break_start_time'])->set('branch_break_end_time',$data['branch_break_end_time'])->set('branch_home_delivery_charges',$data['branch_home_delivery_charges'])->set('branch_minimum_delivery',$data['branch_minimum_delivery'])->where('branch_id',$data['branch_id'])->update('branch');
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Branch Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('su/branches');
	}
	
	function update_Paytm_QR()
	{
		$data['branch_id'] = $this->input->post('branch_id');
		$data['branch_PAYTM_QR_code']=$this->upload_QRcode('branch_paytm_code','QR_Code');
		$this->db->set('branch_PAYTM_QR_code',$data['branch_PAYTM_QR_code'])->where('branch_id',$data['branch_id'])->update('branch');
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Branch Paytm QR Code Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('su/branches');
	}


// ======================================================== Employee ===========================================================================
	public function employees()
	{
		$data['flash']['active'] = $this->session->flashdata('active');
    	$data['flash']['title'] = $this->session->flashdata('title');
    	$data['flash']['text'] = $this->session->flashdata('text');
    	$data['flash']['type'] = $this->session->flashdata('type');
		$data['employees'] = $this->Employee_model->get_all();
		$data['branches'] = $this->Branch_model->get_all();
		$nav['dash'] = 'employee';
		$this->load->view('su/su_header');
		$this->load->view('Employee/employee_registration',$data);
		$this->load->view('Employee/employee_footer',$nav);
	}

	public function add_employee()
	{

		$data['employee_first_name']=$this->input->post('employee_first_name');
		$data['employee_middle_name']=$this->input->post('employee_middle_name');
		$data['employee_last_name']=$this->input->post('employee_last_name');
		$data['employee_branch_id']=$this->input->post('employee_branch_id');
		$data['employee_account_type']=$this->input->post('employee_account_type');
		$data['employee_mobile_no']=$this->input->post('employee_mobile_no');
		$data['employee_effective_date']=date('Y-m-d');
		//$res = $this->db->where('employee_first_name',$data['employee_first_name'])->where('employee_last_name',$data['employee_last_name'])->where('employee_mobile_no',$data['employee_mobile_no'])->get('employee')->num_rows();
		$res = $this->db->where('employee_mobile_no',$data['employee_mobile_no'])->get('employee')->num_rows();
		if ($res != 0)
		{		
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Sorry!");
	        $this->session->set_flashdata('text',"Employee Already Exists...!!");
	        $this->session->set_flashdata('type',"warning");
		}else{
			$data['employee_profile_image']=$this->upload('profile_image','profile_image');
			$this->Employee_model->add_new($data);
			
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Thank You!");
	        $this->session->set_flashdata('text',"Employee Added Successfully...!!");
	        $this->session->set_flashdata('type',"success");
		}
		redirect('Su/employees');
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
        redirect('Su/employees');
	}

	function reset_password()
	{
		$data['employee_id'] = $this->input->post('employee_id');
		$this->db->set('employee_password','0192023a7bbd73250516f069df18b500')->where('employee_id',$data['employee_id'])->update('employee');
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Employee Password Updated Successfully...!!");
        $this->session->set_flashdata('type',"success");
        redirect('Su/employees');
	}

// ==================================================================== Category ==========================================================================
	public function Category()
	{
		$data['products'] = $this->Product_model->get_all_category();
		$nav['dash'] = 'category';
		$this->load->view('su/su_header');
		$this->load->view('Products/category_registration',$data);
		$this->load->view('Products/product_footer',$nav);
	}

	public function add_product_category()
	{
		$branch_details = array(0);
		$branch_id = $this->db->query("SELECT branch_id FROM branch")->result_array();
		for ($i=0; $i < count($branch_id); $i++) {
			array_push($branch_details,$branch_id[$i]['branch_id']);
		}
		for ($i=0; $i < count($branch_details); $i++) { 
			$data['product_category']=$this->input->post('product_category');
			$data['product_branch_id']=$branch_details[$i];
			$data['product_effective_date']=date('Y-m-d');
			$res = $this->Product_model->add_new($data);
		}
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Category Added Successfully...!!");
        $this->session->set_flashdata('type',"success");
		redirect('su/Category');
	}


// ==================================================================== Products ==========================================================================
	public function products()
	{
		$this->load->helper('directory'); 
		$data['products_category'] = $this->Product_model->get_all_category();
		$data['products'] = $this->Product_model->get_all();
		$data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type');
        $data['dir'] = "assets/icons/"; // Your Path to folder
		$data['map'] = directory_map($data['dir']); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */


		$nav['dash'] = 'product';
		$this->load->view('su/su_header');
		$this->load->view('Products/product_registration',$data);
		$this->load->view('Products/product_footer',$nav);
	}

	public function add_product()
	{
		$branch_details = array(0);
		$branch_id = $this->db->query("SELECT branch_id FROM branch")->result_array();
		for ($i=0; $i < count($branch_id); $i++) {
			array_push($branch_details,$branch_id[$i]['branch_id']);
		}
		$product_category=$this->input->post('product_category');
		$product_item=$this->input->post('product_item');
		$cnt = $this->db->where('product_category',$product_category)->where('product_item',$product_item)->where('product_branch_id',0)->get('product')->num_rows();
		
		if ($cnt != 0)
		{		
			$this->session->set_flashdata('active',2);
	        $this->session->set_flashdata('title',"Sorry!");
	        $this->session->set_flashdata('text',"Product Already Exists...!!");
	        $this->session->set_flashdata('type',"warning");
		}else{
			// print_r($branch_details);die();
			for ($i=0; $i < count($branch_details); $i++) { 
				$data['product_category']=$this->input->post('product_category');
				$data['product_branch_id']=$branch_details[$i];
				$data['product_item']=$this->input->post('product_item');
				$data['product_icon']=$this->input->post('product_icon');
				$data['product_rate']=$this->input->post('product_rate');
				$data['product_qty_type']=$this->input->post('product_qty_type');
				$data['product_effective_date']=date('Y-m-d');
				$res = $this->Product_model->add_new($data);
			}
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Thank You!");
	        $this->session->set_flashdata('text',"Product Added Successfully...!!");
	        $this->session->set_flashdata('type',"success");
		}	
		redirect('su/products');
	}

// ================================================================== Add On Services =================================================================
	public function add_on_services()
	{
		$data['products'] = $this->Product_model->get_all();
		$data['products_category'] = $this->Product_model->get_all_category();
		$data['addon'] = $this->db->query("SELECT addon_services.*,product_item FROM `addon_services` LEFT JOIN product ON product_id = addon_product_id WHERE addon_branch_id = 0 AND addon_expiry_date = '9999-12-31'")->result_array();
		// print_r($data['addon']);die();
		$data['flash']['active'] = $this->session->flashdata('active');
        $data['flash']['title'] = $this->session->flashdata('title');
        $data['flash']['text'] = $this->session->flashdata('text');
        $data['flash']['type'] = $this->session->flashdata('type');
		$nav['dash'] = 'add_on_services';

		$this->load->view('su/su_header');
		$this->load->view('Products/add_services',$data);
		$this->load->view('Products/product_footer',$nav);
	}

	function fetch_product_details()
	{
		$cate = $_POST['cate'];
		$data = $this->db->query("SELECT * FROM `product` WHERE product_item IS NOT NULL and product_rate IS NOT NULL and product_branch_id = 0 and product_category ='".$cate."'")->result_array();
		echo json_encode($data);
	}

	public function add_on_services_reg()
	{
		$branch_details = array(0);
		$branch_id = $this->db->query("SELECT branch_id FROM branch")->result_array();
		for ($i=0; $i < count($branch_id); $i++) {
			array_push($branch_details,$branch_id[$i]['branch_id']);
		}
		// print_r($branch_details);die();
		$addon_name=$this->input->post('addon_name');
		$addon_product_id=$this->input->post('addon_product_id');
		$cnt = $this->db->where('addon_name',$addon_name)->where('addon_product_id',$addon_product_id)->where('addon_branch_id',0)->get('addon_services')->num_rows();
		if ($cnt != 0)
		{		
			$this->session->set_flashdata('active',2);
	        $this->session->set_flashdata('title',"Sorry!");
	        $this->session->set_flashdata('text',"Add On Service Already Exists...!!");
	        $this->session->set_flashdata('type',"warning");
		}else{
			for($i=0; $i < count($branch_details); $i++) { 
				$product_id = $this->db->query("SELECT product_id FROM product where product_item=(select product_item from product where product_id='".$addon_product_id."' and product_branch_id='0') and product_branch_id='".$branch_details[$i]."'")->result_array();
				$total_addon = $this->db->query("SELECT * FROM `addon_services` where addon_product_id =".$product_id[0]['product_id']." and addon_branch_id = ".$branch_details[$i]."")->num_rows();
				//print_r($total_addon);die();
				if($total_addon < 5){
					$data['addon_name']=$this->input->post('addon_name');
					//$data['addon_product_id']=$this->input->post(' ');
					$data['addon_product_id']=$product_id[0]['product_id'];
					$data['addon_rate']=$this->input->post('addon_rate');
					$data['addon_branch_id']= $branch_details[$i];
					$data['addon_effective_date']=date('Y-m-d');
					$this->db->insert('addon_services',$data);
				}
				else{
					$this->session->set_flashdata('active',1);
			        $this->session->set_flashdata('title',"Thank You!");
			        $this->session->set_flashdata('text',"Maximum  Addon's Allowed...!!");
			        $this->session->set_flashdata('type',"success");
			        redirect('Su/add_on_services');
				}
			}
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Thank You!");
	        $this->session->set_flashdata('text',"Add On Service Added Successfully...!!");
	        $this->session->set_flashdata('type',"success");
		}
		redirect('Su/add_on_services');
	}

// ==================================================================== Branch Product Assignment ==========================================================================
	public function branch_product_assign_details()
	{
		$data['products_category'] = $this->Product_model->get_all_category();
		$data['branches'] = $this->Branch_model->get_all();
		$nav['dash'] = 'assign';
		$this->load->view('su/su_header');
		$this->load->view('Assign/branch_product_assign',$data);
		$this->load->view('Assign/branch_product_assign_footer',$nav);
	}

	function fetch_item_acc_product()
	{
		$prod_cat = $_POST['prod_cat'];
		// $s = 0;
		// $k ='';
		// while (count($prod_cat) > $s) {
		// 	if($k=='')
		// 	{
		// 		$k = $k.$prod_cat[$s];
		// 	}
		// 	else
		// 	{
		// 		$k = $k.','.$prod_cat[$s];
		// 	}	
		// 	$s++;
		// }
		$data = $this->Product_model->get_all_item($prod_cat);
		echo json_encode($data);
	}

	function fetch_service_acc_item()
	{
		$prod_item = $_POST['product_item'];
		$data = $this->Product_model->get_all_service($prod_item);
		echo json_encode($data);
	}

	function fetch_final_item_acc_product()
	{
		$prod_item = $_POST['prod_item'];
		$data = $this->Product_model->get_final_item_list($prod_item);
		echo json_encode($data);
	}

	function fetch_final_service_acc_product()
	{
		$prod_service = $_POST['prod_service'];
		$data = $this->Product_model->get_final_service_list($prod_service);
		echo json_encode($data);
	}

	public function add_assign()
	{

		$data['product_category']=$this->input->post('product_category');
		$data['product_branch_id']=$this->input->post('product_branch_id');
		$data['product_item']=$this->input->post('product_item');

		$data['product_icon']=$this->upload_item('product_icon','profile_image');

		$data['product_rate']=$this->input->post('product_rate');
		$data['product_qty_type']=$this->input->post('product_qty_type');

		$res = $this->Product_model->add_new($data);
		if($res == 1){
		redirect('su/products');
			// echo "register";
		}
		else
		{
			echo "Not register";
		}
	}

	function add_branch_product()
	{
		$branch = $this->input->post('product_branch_id');
		$product = $this->input->post('product_category[]');
		$item = $this->input->post('product_item');
		$service = $this->input->post('product_service');
		echo "<pre>";
		print_r($product);
		print_r($item);
		print_r($service);
	}

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

	function upload_item($file,$folder)
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

	function upload_QRcode($file,$folder)
	{
		$config = array(
			'upload_path' => "uploads/".$folder."/",
			'upload_url' => base_url()."uploads/".$folder."/",
			'allowed_types' => "jpg|png|gif|jpeg",
			// 'max_size' => 100,
			// 'max_width' => 150,
			// 'max_height' => 150
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload($file)){
			$upload_files = array('upload_data' => $this->upload->data());
			$user_photo = base_url().'uploads/'.$folder.'/'.$upload_files['upload_data']['file_name'];
			$this->upload->data();

			return $user_photo;
		}
	}

	function upload_logo($file,$folder)
	{
		$config = array(
			'upload_path' => "uploads/".$folder."/",
			'upload_url' => base_url()."uploads/".$folder."/",
			'allowed_types' => "jpg|png|gif|jpeg",
			'encrypt_name' => TRUE,
			// 'max_size' => 100,
			// 'max_width' => 150,
			// 'max_height' => 150
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

?>