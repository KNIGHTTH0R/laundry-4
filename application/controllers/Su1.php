<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Su1 extends CI_Controller {
	
	function __construct(){
		parent::__construct();

		if(!isset($this->session->userdata['super_admin']))
    	{	
    		redirect('Authentication');
		}
	}
	
	public function index()
	{
		$nav['dash'] = 'dashboard';
		$this->load->view('su/su_header');
		$this->load->view('su/su_dashboard');
		$this->load->view('su/su_footer',$nav);
	}

// =============================================================== Branch =============================================================
	public function branches()
	{
		$nav['dash'] = 'branch';
		$data['branches'] = $this->Branch_model->get_all();
		$this->load->view('su/su_header');
		$this->load->view('Branches/branch_registration',$data);
		$this->load->view('Branches/branch_footer',$nav);
	}

	public function add_branch()
	{
		$data['branch_name'] = $this->input->post('branch_name');
		$data['branch_PAYTM_QR_code']=$this->upload_QRcode('branch_paytm_code','QR_Code');
		$data['branch_area'] = $this->input->post('branch_area');
		$data['branch_location_address'] = $this->input->post('branch_location_address');
		$data['branch_latitude'] = $this->input->post('branch_lat');
		$data['branch_longitude'] = $this->input->post('branch_long');
		$data['branch_verification_code'] = $this->input->post('branch_ver_code');
		$res = $this->Branch_model->add_new($data);
		if($res == 1){
		redirect('su/branches');
		}
		else
		{
			echo "Not register";
		}
	}


// ======================================================== Employee ===========================================================================
	public function employees()
	{
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
		$data['employee_profile_image']=$this->upload('profile_image','profile_image');
		$data['employee_account_type']=$this->input->post('employee_account_type');
		$data['employee_mobile_no']=$this->input->post('employee_mobile_no');
		$data['employee_effective_date']=date('Y-m-d');
		$res = $this->Employee_model->add_new($data);

		if($res == 1){
		redirect('su/employees');
		}
		else
		{
			echo "Not register";
		}
	}

// ==================================================================== Category ==========================================================================
	public function Category()
	{
		$data['products'] = $this->Product_model->get_all_category();
		$data['branches'] = $this->Branch_model->get_all();
		$nav['dash'] = 'category';
		$this->load->view('su/su_header');
		$this->load->view('Products/category_registration',$data);
		$this->load->view('Products/product_footer',$nav);
	}

	public function add_product_category()
	{
		$data['product_category']=$this->input->post('product_category');
		$data['product_branch_id']=0;
		$data['product_effective_date']=date('Y-m-d');
		$res = $this->Product_model->add_new($data);
		if($res == 1){
			redirect('su/products');
		}
	}


// ==================================================================== Products ==========================================================================
	public function products()
	{
		$data['products_category'] = $this->Product_model->get_all_category();
		$data['products'] = $this->Product_model->get_all();
		$nav['dash'] = 'product';
		$this->load->view('su/su_header');
		$this->load->view('Products/product_registration',$data);
		$this->load->view('Products/product_footer',$nav);
	}

	public function add_product()
	{

		$data['product_category']=$this->input->post('product_category');
		$data['product_branch_id']=0;
		$data['product_item']=$this->input->post('product_item');

		$data['product_icon']=$this->upload('product_icon','profile_image');

		$data['product_rate']=$this->input->post('product_rate');
		$data['product_qty_type']=$this->input->post('product_qty_type');
		$data['product_effective_date']=date('Y-m-d');

		$res = $this->Product_model->add_new($data);
		if($res == 1){
			redirect('su/products');
		}
		else
		{
			echo "Not register";
		}
	}

// ==================================================================== Add On Services ==========================================================================
	public function add_on_services()
	{
		$data['products'] = $this->Product_model->get_all();
		$data['addon'] = $this->Product_model->get_addon();
		// echo "<pre>";print_r($data['addon']);die();
		$nav['flash']['active'] = $this->session->flashdata('active');
        $nav['flash']['title'] = $this->session->flashdata('title');
        $nav['flash']['text'] = $this->session->flashdata('text');
        $nav['flash']['type'] = $this->session->flashdata('type');
		$nav['dash'] = 'add_on_services';
		$this->load->view('su/su_header');
		$this->load->view('Products/add_services',$data);
		$this->load->view('Products/product_footer',$nav);
	}

	public function add_on_services_reg()
	{
		// print_r("expression");die();
		$data['addon_name']=$this->input->post('addon_name');
		$data['addon_product_id']=$this->input->post('addon_product_id');
		$data['addon_rate']=$this->input->post('addon_rate');
		$data['addon_branch_id']=0;
		$data['addon_effective_date']=date('Y-m-d');

		$res = $this->Product_model->add_on_services_reg($data);
		
		$this->session->set_flashdata('active',1);
        $this->session->set_flashdata('title',"Thank You!");
        $this->session->set_flashdata('text',"Add On Service Added Successfully...!!");
        $this->session->set_flashdata('type',"success");

        redirect('Su1/add_on_services');
	}

// ==================================================================== Branch Product Assignment ==========================================================================
	public function branch_product_assign_details()
	{
		$data['products_category'] = $this->Product_model->get_all_category();
		// $data['products_item'] = $this->Product_model->get_all_item();
		$nav['dash'] = 'assign';
		$this->load->view('su/su_header');
		$this->load->view('Assign/branch_product_assign',$data);
		$this->load->view('Assign/branch_product_assign_footer',$nav);
	}

	function fetch_item_acc_product()
	{
		$prod_cat = $_POST['prod_cat'];
		echo json_encode($prod_cat);
	}

	public function add_assign()
	{

		$data['product_category']=$this->input->post('product_category');
		$data['product_branch_id']=$this->input->post('product_branch_id');
		$data['product_item']=$this->input->post('product_item');

		$data['product_icon']=$this->upload('product_icon','profile_image');

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

	function upload_QRcode($file,$folder)
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

?>