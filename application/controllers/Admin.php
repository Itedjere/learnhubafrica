<?php

class Admin extends CI_controller {
	
	public function __construct()
	{
		parent::__construct();
		//load session library
		$this->load->library('session');
		
		//load cookie helper library
		$this->load->helper('cookie');
		
		//load form validation library
		$this->load->library('form_validation');
		
		//load form pagination library
		$this->load->library('pagination');
		
		//load file helper
		$this->load->helper('file');
		
		//load date helper
		$this->load->helper('date');
				
		//load Admin_model model
		$this->load->model('Admin_model');
	}
	
	public function notification_list()
	{
		
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$data['total_num_category'] = $this->Admin_model->fetch_all_rows('category');
		
		//fetch the total number of tags
		$data['total_num_blogs'] = $this->Admin_model->fetch_all_rows('blog');
		
		//fetch the total number of categories
		$config['total_num_notification'] = $this->Admin_model->fetch_all_rows('notification');
		  
		$config['base_url'] = site_url("Admin/notification_list/");
		$config['per_page'] = 10;
		$config['uri_segment'] = '3';
		$config['num_links'] = round($config['total_num_notification'] / $config['per_page']);
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = FALSE;
		
		$config['last_link'] = FALSE;
		
		$config['next_link'] = FALSE;
		
		$config['prev_link'] = FALSE;
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page_number = $this->uri->segment(3);
		$data['notifications'] = $this->Admin_model->fetch_notification($config['per_page'], $page_number);
		
		$data['total_num_pages'] = ceil($config['total_num_notification'] / $config['per_page']);
		$data['total_num_rows'] = $config['total_num_notification'];
		
		$url_segments = $this->uri->total_segments();
		$data['page_num'] = ($url_segments !== 3) ? 1 : $this->uri->segment(3);
		
		$this->add_category_template('notification_list', $data);
	}
	
	public function view_notification()
	{
		//check for session and cookie presence
		$this->admin_header();
		
		//check and confirm if the total url segment is 3
		$url_segments = $this->uri->total_segments();
		
		if ($url_segments == 3) {
			//retrieved the unreviewed property id
			$notification_id = $this->uri->segment(3);
			
			//retrieve from the database all the details of this property
			$result = $this->Admin_model->fetch_notification_message($notification_id);
			
			if ($result === FALSE) {
				redirect('Admin/notification_list');
			}
			
			$data['notification_details'] = $result;
			
			$this->add_category_template('notification_message', $data);
			
		}else {
			redirect('Admin/notification_list');
		}
	}
	
	public function delete_notifications() 
	{
		$categorys_id = $this->input->post('hidden_order_ids');
		
		$arrayOfCategoryIds = explode("|", $categorys_id);
		for($i = 0; $i < count($arrayOfCategoryIds); $i++) {
			if ($arrayOfCategoryIds[$i] !== "") {
				$this->Admin_model->delete_notification_details($arrayOfCategoryIds[$i]);
			}
		}
		
		//redirect back to the vendor page
		redirect("admin/notification_list");
	}
	
	
	
	
	public function admin_header()
	{
		if (!empty($this->session->userdata('username')) || !empty(get_cookie('learnhub'))) {
			if ($this->Admin_model->check_session_cookie() != TRUE) 
			{
				redirect('Admin/login');
			}
		}else {
			redirect('Admin/login');
		}
	}
	
	public function login()
	{
		$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => ' ', 'contact' => ' ');
		
		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run('login') === FALSE) {
				
				$this->login_template();
				
			}else {
				//validate the login details in the model and get TRUE or FALSE
				$result = $this->Admin_model->confirm_admin_login();
				
				if ($result === TRUE) {
					//redirect the user to the admin home page if TRUE
					redirect('admin/notification_list');
				}else {
					//take the user back to the login page if FALSE;
					$data['login_error_message'] = 'Invalid Username or Password';
					
					$this->login_template($data);
				}
			}
		}else {
			$this->login_template();
		}
	}
	
	public function login_template($data = array())
	{
		$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
		
		$data['metas'] = $this->load->view('templates/home_metas', '', TRUE);
		$data['main_subheader'] = $this->load->view('templates/main_subheader', $show_active_link, TRUE);
		$data['header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
		$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
		$this->load->view('admins/login', $data);
	}
	
	public function create_admin()
	{
		$this->admin_header();
		if ($this->session->userdata('admin_id') != 1) {
			redirect('Admin');
		}
		$data['header'] = $this->load->view('templates/admin_header', '', TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/create_admin', $data);
	}
	
	public function create_new_admin()
	{
		if ($this->form_validation->run('create-admin') === FALSE) {
			
			$this->admin_header();
			if ($this->session->userdata('admin_id') != 1) {
				redirect('Admin');
			}
			$this->create_admin();
		}else {
			$result = $this->Admin_model->add_new_admin();
			
			if ($result === TRUE) {
				redirect('Admin/manage_admins');
			}else {
				
				$data['create_admin_error_message'] = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already exist!</div>';
				$this->admin_header();
				if ($this->session->userdata('admin_id') != 1) {
					redirect('Admin');
				}
				$this->create_admin();
			}
		}
	}
	
	public function manage_admins()
	{
		$this->admin_header();
		
		//get the total new orders
		
		if ($this->session->userdata('admin_id') != 1) {
			redirect('Admin');
		}
		$data['total_num_admins'] = $this->Admin_model->fetch_all_rows('admin');
		
		$data['admins'] = $this->Admin_model->fetch_all_admins();
		
		$data['header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/manage_admins', $data);
	}
	
	
	public function add_author()
	{
		//fetch the total number of categories
		//$data['brands'] = $this->Admin_model->fetch_all_rows_datas('vendor_id','vendors');
		$data['total_num_authors'] = $this->Admin_model->fetch_all_rows('authors');
		
		//fetch the total number of tags
		$data['total_num_blog'] = $this->Admin_model->fetch_all_rows('blog');
		
		//fetch the categories
		//$data['categories'] = $this->Admin_model->fetch_all_rows_datas('category_id', 'category');
		
		if((isset($_POST) && (!empty($_POST)))){
			if ($this->form_validation->run('add_author-form') === FALSE)
			{
				$this->add_author_template('add_author', $data);
			}
			else 
			{
				//Set All The Configurations Needed For File Upload
				$config['upload_path'] = './assets/images/author/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2048;
	
				$this->load->library('upload', $config);
				
				
				//Next Check if the Food Logo Has Been Uploaded
				if (!$this->upload->do_upload('author_photo'))
				{
					$data['msg'] = $this->upload->display_errors('<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	
					$this->add_author_template('add_author', $data);
				}
				else 
				{
					$imgdata['author_photo'] = $this->upload->data('file_name');
						
					if ($this->Admin_model->insert_author($imgdata) === TRUE) {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Author Has Been Added Successfully.</div>';
			
						$this->add_author_template('add_author', $data);
					}
					else
					{
						$data['msg']  = '<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Adding The Author. Pls Try Again</div>';
						
						$this->add_author_template('add_author', $data);
					}
				}
			}
		}
		else 
		{
			$this->add_author_template('add_author', $data);
		}
	}
	
	public function authors_list()
	{
		
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$config['total_num_author'] = $this->Admin_model->fetch_all_rows('authors');
		
		//fetch the total number of tags
		$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
		
		//$config['total_rows'] = $this->Admin_model->fetch_all_rows('food');
		  
		$config['base_url'] = site_url("Admin/authors/");
		$config['per_page'] = 10;
		$config['uri_segment'] = '3';
		$config['num_links'] = round($config['total_num_author'] / $config['per_page']);
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = FALSE;
		
		$config['last_link'] = FALSE;
		
		$config['next_link'] = FALSE;
		
		$config['prev_link'] = FALSE;
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page_number = $this->uri->segment(3);
		$data['authors'] = $this->Admin_model->fetch_author($config['per_page'], $page_number);
		
		$data['total_num_pages'] = ceil($config['total_num_author'] / $config['per_page']);
		$data['total_num_rows'] = $config['total_num_author'];
		
		$url_segments = $this->uri->total_segments();
		$data['page_num'] = ($url_segments !== 3) ? 1 : $this->uri->segment(3);
		
		$this->add_author_template('authors_list', $data);
	}
	
	public function edit_author()
	{
		if ($this->uri->total_segments() == 3) {
			$author_id = $this->uri->segment(3);
			
			//fetch the total number of categories
			$data['total_num_category'] = $this->Admin_model->fetch_all_rows('category');
		
			//fetch the total number of tags
			$data['total_num_authors'] = $this->Admin_model->fetch_all_rows('authors');
			
			if((isset($_POST) && (!empty($_POST)))){
				if ($this->form_validation->run('add_author-form') === FALSE)
				{
					$this->edit_author_segment($author_id, $data);
				}
				else 
				{
					//set the array that will carry the uploaded image name to the Admin Model empty
					//if an image was selected, the array will be populated with element
					$imgdata = array();
					
					if (!empty($_FILES['author_photo']['name'])) 
					{
						$_FILES['userfile']['name']     = $_FILES['author_photo']['name'];
						$_FILES['userfile']['type']     = $_FILES['author_photo']['type'];
						$_FILES['userfile']['tmp_name'] = $_FILES['author_photo']['tmp_name'];
						$_FILES['userfile']['error']    = $_FILES['author_photo']['error'];
						$_FILES['userfile']['size']     = $_FILES['author_photo']['size'];
						
						//Set All The Configurations Needed For File Upload
						$config['upload_path'] = './assets/images/author/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = 2048;
			
						$this->load->library('upload', $config);
									
						//Next Check if the vendor Logo Has Been Uploaded
						if (!$this->upload->do_upload())
						{
							$error = array('msg' => $this->upload->display_errors('<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'));
			
							$this->edit_author_segment($author_id, $error);
						}
						else
						{
							$imgdata['author_photo'] = $this->upload->data('file_name');
						}
					}
					if ($this->Admin_model->update_author_details($author_id, $imgdata) === TRUE) {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>This Authors Details Has Been Updated Successfully.</div>';
			
						$this->edit_author_segment($author_id, $data);
					}
					else
					{
						$data['msg']  = '<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Updating This Authors Details. Pls Try Again</div>';
						$this->edit_author_segment($author_id, $data);
					}
				}
			}else {
				$this->edit_author_segment($author_id, $data);
			}
			
		}else {
			redirect('Admin/authors_list');
		}
	}
	
	public function delete_authors() 
	{
		$authors_id = $this->input->post('hidden_order_ids');
		
		$arrayOfAuthorIds = explode("|", $authors_id);
		for($i = 0; $i < count($arrayOfAuthorIds); $i++) {
			if ($arrayOfAuthorIds[$i] !== "") {
				$this->Admin_model->delete_author_details($arrayOfAuthorIds[$i]);
			}
		}
		
		//redirect back to the vendor page
		redirect("admin/authors_list");
	}
	
	public function edit_author_segment($author_id, $data = array())
	{
		//check for session and cookie presence
		$this->admin_header();
		
		$result = $this->Admin_model->fetch_author_details($author_id);
		
		if ($result !== FALSE) {
			$data['author_details'] = $result;
			$this->add_author_template('edit_author', $data);
		}else {
			redirect('Admin/authors_list');
		}
	}
	
	public function add_author_template($filename, $data = array())
	{
		//get the total new orders
		//$data["there_is_new_order"] = $this->Admin_model->return_total_rows('order', 'status', 'open');
		
		$this->admin_header();
		$data['header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/'.$filename, $data);
	}
	
	
	
	
	
	public function add_category()
	{
		
		$data['total_num_category'] = $this->Admin_model->fetch_all_rows('category');
		
		//fetch the total number of tags
		$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
		
		//fetch the categories
		//$data['categories'] = $this->Admin_model->fetch_all_rows_datas('category_id', 'category');
		
		if((isset($_POST) && (!empty($_POST)))){
			if ($this->form_validation->run('add_category-form') === FALSE)
			{
				$this->add_category_template('add_category', $data);
			}
			else 
			{
				//Set All The Configurations Needed For File Upload
				$config['upload_path'] = './assets/images/category/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2048;
	
				$this->load->library('upload', $config);
				
				
				//Next Check if the Food Logo Has Been Uploaded
				if (!$this->upload->do_upload('category_banner'))
				{
					$data['msg'] = $this->upload->display_errors('<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	
					$this->add_category_template('add_category', $data);
				}
				else 
				{
					$imgdata['category_banner'] = $this->upload->data('file_name');
					
					if ($this->Admin_model->insert_category($imgdata) === TRUE) {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Category Has Been Added Successfully.</div>';
			
						$this->add_category_template('add_category', $data);
					}
					else
					{
						$data['msg']  = '<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Adding The Category. Pls Try Again</div>';
						
						$this->add_category_template('add_category', $data);
					}
				}
			}
		}
		else 
		{
			$this->add_category_template('add_category', $data);
		}
	}
	
	public function category_list()
	{
		
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$config['total_num_category'] = $this->Admin_model->fetch_all_rows('category');
		
		//fetch the total number of tags
		$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
		
		//$config['total_rows'] = $this->Admin_model->fetch_all_rows('food');
		  
		$config['base_url'] = site_url("Admin/category_list/");
		$config['per_page'] = 10;
		$config['uri_segment'] = '3';
		$config['num_links'] = round($config['total_num_category'] / $config['per_page']);
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = FALSE;
		
		$config['last_link'] = FALSE;
		
		$config['next_link'] = FALSE;
		
		$config['prev_link'] = FALSE;
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page_number = $this->uri->segment(3);
		$data['categorys'] = $this->Admin_model->fetch_category($config['per_page'], $page_number);
		
		$data['total_num_pages'] = ceil($config['total_num_category'] / $config['per_page']);
		$data['total_num_rows'] = $config['total_num_category'];
		
		$url_segments = $this->uri->total_segments();
		$data['page_num'] = ($url_segments !== 3) ? 1 : $this->uri->segment(3);
		
		$this->add_category_template('category_list', $data);
	}
	
	public function edit_category()
	{
		if ($this->uri->total_segments() == 3) {
			$category_id = $this->uri->segment(3);
			
			//fetch the total number of categories
			$data['total_num_category'] = $this->Admin_model->fetch_all_rows('category');
		
			//fetch the total number of tags
			$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
			
			if((isset($_POST) && (!empty($_POST)))){
				if ($this->form_validation->run('add_category-form') === FALSE)
				{
					$this->edit_category_segment($category_id, $data);
				}
				else 
				{
					//set the array that will carry the uploaded image name to the Admin Model empty
					//if an image was selected, the array will be populated with element
					$imgdata = array();
					
					if (!empty($_FILES['category_banner']['name'])) 
					{
						$_FILES['userfile']['name']     = $_FILES['category_banner']['name'];
						$_FILES['userfile']['type']     = $_FILES['category_banner']['type'];
						$_FILES['userfile']['tmp_name'] = $_FILES['category_banner']['tmp_name'];
						$_FILES['userfile']['error']    = $_FILES['category_banner']['error'];
						$_FILES['userfile']['size']     = $_FILES['category_banner']['size'];
						
						//Set All The Configurations Needed For File Upload
						$config['upload_path'] = './assets/images/category/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = 2048;
			
						$this->load->library('upload', $config);
									
						//Next Check if the vendor Logo Has Been Uploaded
						if (!$this->upload->do_upload())
						{
							$error = array('msg' => $this->upload->display_errors('<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'));
			
							$this->edit_category_segment($category_id, $error);
						}
						else
						{
							$imgdata['category_banner'] = $this->upload->data('file_name');
						}
					}
					if ($this->Admin_model->update_categoy_details($category_id, $imgdata) === TRUE) {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>This Category Details Has Been Updated Successfully.</div>';
			
						$this->edit_category_segment($category_id, $data);
					}
					else
					{
						$data['msg']  = '<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Updating This Food Item. Pls Try Again</div>';
						$this->edit_category_segment($category_id, $data);
					}
				}
			}else {
				$this->edit_category_segment($category_id, $data);
			}
			
		}else {
			redirect('Admin/category_list');
		}
	}
	
	public function delete_categorys() 
	{
		$categorys_id = $this->input->post('hidden_order_ids');
		
		$arrayOfCategoryIds = explode("|", $categorys_id);
		for($i = 0; $i < count($arrayOfCategoryIds); $i++) {
			if ($arrayOfCategoryIds[$i] !== "") {
				$this->Admin_model->delete_category_details($arrayOfCategoryIds[$i]);
			}
		}
		
		//redirect back to the vendor page
		redirect("admin/category_list");
	}
	
	public function edit_category_segment($category_id, $data = array())
	{
		//check for session and cookie presence
		$this->admin_header();
		
		$result = $this->Admin_model->fetch_category_details($category_id);
		
		if ($result !== FALSE) {
			$data['category_details'] = $result;
			$this->add_category_template('edit_category', $data);
		}else {
			redirect('Admin/category_list');
		}
	}
	
	public function add_category_template($filename, $data = array())
	{
		//get the total new orders
		//$data["there_is_new_order"] = $this->Admin_model->return_total_rows('order', 'status', 'open');
		
		$this->admin_header();
		$data['header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/'.$filename, $data);
	}
	
	
	
	
	public function add_tags() 
	{
		
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$data['total_num_category'] = $this->Admin_model->fetch_all_rows('category');
		
		//fetch the total number of tags
		$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
		
		if((isset($_POST) && (!empty($_POST)))){
			if ($this->form_validation->run('add_tags-form') === FALSE)
			{
				$this->add_tag_template('add_tag', $data);
			}
			else {
				if ($this->Admin_model->insert_tags() === TRUE) {
					$data['msg'] = '<div class="alert alert-success col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Tags Has Been Added Successfully.</div>';
		
					$this->add_tag_template('add_tag', $data);
				}
				else
				{
					$data['msg']  = '<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Adding Tags. Pls Try Again</div>';
					
					$this->add_tag_template('add_tag', $data);
				}
			}
		}
		else{
			$this->add_tag_template('add_tag', $data);
		}
	}
	
	public function tags_list()
	{
		
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$config['total_num_tag'] = $this->Admin_model->fetch_all_rows('tags');
		
		//fetch the total number of tags
		//$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
		
		//$config['total_rows'] = $this->Admin_model->fetch_all_rows('food');
		  
		$config['base_url'] = site_url("Admin/tags_list/");
		$config['per_page'] = 50;
		$config['uri_segment'] = '3';
		$config['num_links'] = round($config['total_num_tag'] / $config['per_page']);
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = FALSE;
		
		$config['last_link'] = FALSE;
		
		$config['next_link'] = FALSE;
		
		$config['prev_link'] = FALSE;
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page_number = $this->uri->segment(3);
		$data['tags'] = $this->Admin_model->fetch_tags($config['per_page'], $page_number);
		
		$data['total_num_pages'] = ceil($config['total_num_tag'] / $config['per_page']);
		$data['total_num_rows'] = $config['total_num_tag'];
		
		$url_segments = $this->uri->total_segments();
		$data['page_num'] = ($url_segments !== 3) ? 1 : $this->uri->segment(3);
		
		$this->add_tag_template('tags_list', $data);
	}
	
	public function delete_tag()
	{
		$this->Admin_model->delete_tag_details();
		
		//redirect back to the vendor page
		redirect("admin/tags_list");
	}
	
	public function edit_tag()
	{
		$this->Admin_model->edit_tag_details();
		
		//redirect back to the vendor page
		redirect("admin/tags_list");
	}
	
	public function add_tag_template($filename, $data = array())
	{
		//get the total new orders
		//$data["there_is_new_order"] = $this->Admin_model->return_total_rows('order', 'status', 'open');
		
		$this->admin_header();
		$data['header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/'.$filename, $data);
	}
	
	
	
	
	public function blog_list()
	{
		
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$config['total_num_blog'] = $this->Admin_model->fetch_all_rows('blog');
		
		//fetch the total number of tags
		$data['total_num_tags'] = $this->Admin_model->fetch_all_rows('tags');
		
		//$config['total_rows'] = $this->Admin_model->fetch_all_rows('food');
		  
		$config['base_url'] = site_url("Admin/blog_list/");
		$config['per_page'] = 50;
		$config['uri_segment'] = '3';
		$config['num_links'] = round($config['total_num_blog'] / $config['per_page']);
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = FALSE;
		
		$config['last_link'] = FALSE;
		
		$config['next_link'] = FALSE;
		
		$config['prev_link'] = FALSE;
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page_number = $this->uri->segment(3);
		$data['blogs'] = $this->Admin_model->fetch_blog($config['per_page'], $page_number);
		
		$data['total_num_pages'] = ceil($config['total_num_blog'] / $config['per_page']);
		$data['total_num_rows'] = $config['total_num_blog'];
		
		$url_segments = $this->uri->total_segments();
		$data['page_num'] = ($url_segments !== 3) ? 1 : $this->uri->segment(3);
		
		$this->create_blog_template('blog_list', $data);
	}
	
	public function create_blog()
	{
		$this->admin_header();
		
		//fetch the total datas of categories
		$data['categorys'] = $this->Admin_model->fetch_all_rows_datas('category_id', 'category');
		
		//fetch the total datas of author
		$data['authors'] = $this->Admin_model->fetch_all_rows_datas('author_id', 'authors');
		
		//fetch the total datas of author
		$data['tags'] = $this->Admin_model->fetch_all_rows_datas('id', 'tags');
		
		if((isset($_POST) && (!empty($_POST)))){
			if ($this->form_validation->run('create_blog-form') === FALSE) {
				
				$this->create_blog_template('create-blog', $data);
				
			}else {
				$config['upload_path'] = './assets/images/blog/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2048;
	
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('blog_photo'))
				{
					$imgerror = array('msg' => $this->upload->display_errors('<div class="alert alert-danger col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'));
					
					$this->create_blog_template('create-blog', $imgerror);
					
				}
				else 
				{
					$imgdata = array('file_name' => $this->upload->data('file_name'));
					
					if ($this->Admin_model->insert_blog($imgdata) === TRUE) {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Blog Has Been Created Successfully.</div>';
			
						$this->create_blog_template('create-blog', $data);
					}else {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Creating the Blog. Please Try Again Later</div>';
			
						$this->create_blog_template('create-blog', $data);
					}
				}
			}
		}else {
			$this->create_blog_template('create-blog', $data);
		}
	}
	
	public function edit_blog()
	{
		if ($this->uri->total_segments() == 3) {
			$blog_id = $this->uri->segment(3);
			$this->admin_header();
			
			//fetch the total datas of categories
			$data['categorys'] = $this->Admin_model->fetch_all_rows_datas('category_id', 'category');
			
			//fetch the total datas of author
			$data['authors'] = $this->Admin_model->fetch_all_rows_datas('author_id', 'authors');
			
			//fetch the total datas of author
			$data['tags'] = $this->Admin_model->fetch_all_rows_datas('id', 'tags');
			
			if((isset($_POST) && (!empty($_POST)))){
				if ($this->form_validation->run('create_blog-form') === FALSE) {
					
					$this->edit_blog_segment($blog_id, $data);
					
				}else {
					//set the array that will carry the uploaded image name to the Admin Model empty
					//if an image was selected, the array will be populated with element
					$imgdata = array();
					
					if (!empty($_FILES['blog_photo']['name'])) 
					{
						$config['upload_path'] = './assets/images/blog/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = 2048;
			
						$this->load->library('upload', $config);
						
						if (!$this->upload->do_upload('blog_photo'))
						{
							$data['msg'] = $this->upload->display_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
							
							$this->edit_blog_segment($blog_id, $data);
							
						}
						else 
						{
							$imgdata = array('blog_photo' => $this->upload->data('file_name'));
							
						}
					}
					
					if ($this->Admin_model->updata_blog_details($blog_id, $imgdata) === TRUE) {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Blog Has Been Updated Successfully.</div>';
			
						$this->edit_blog_segment($blog_id, $data);
					}else {
						$data['msg'] = '<div class="alert alert-success col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Creating the Blog. Please Try Again Later</div>';
			
						$this->edit_blog_segment($blog_id, $data);
					}
				}
			}else {
				$this->edit_blog_segment($blog_id, $data);
			}
		}else {
			redirect('Admin/blog_list');
		}
	}
	
	public function delete_blogs() 
	{
		$blogs_id = $this->input->post('hidden_order_ids');
		
		$arrayOfBlogIds = explode("|", $blogs_id);
		for($i = 0; $i < count($arrayOfBlogIds); $i++) {
			if ($arrayOfBlogIds[$i] !== "") {
				$this->Admin_model->delete_blog_details($arrayOfBlogIds[$i]);
			}
		}
		
		//redirect back to the vendor page
		redirect("admin/blog_list");
	}
	
	public function add_remove_food_home() 
	{
		if((isset($_POST) && (!empty($_POST)))){
			
			$this->Admin_model->add_remove_food_home();
			
		}
	}
	
	public function create_blog_template($filename, $data = array())
	{
		
		$this->admin_header();
		$data['header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/'.$filename, $data);
	}
	
	public function edit_blog_segment($blog_id, $data = array())
	{
		//check for session and cookie presence
		$this->admin_header();
		
		//get all the tags attached this blog from the blogs_and tags_table
		$data['tag_ids'] = $this->Admin_model->fetch_tags_tied_to_blog($blog_id);
		
		$result = $this->Admin_model->fetch_blog_details($blog_id);
		
		if ($result !== FALSE) {
			$data['blog'] = $result;
			$this->create_blog_template('edit_blog', $data);
		}else {
			redirect('Admin/blog_list');
		}
	}
	
	
	public function image_list() 
	{
		if ((isset($_FILES) && (!empty($_FILES)))) {
			
			$config['upload_path'] = './assets/images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('blog_photo'))
			{
				$data['msg'] = $this->upload->display_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
				$this->add_image_template($data);
			}
			else 
			{
				$imgdata = array('file_name' => $this->upload->data('file_name'));
				
				if ($this->Admin_model->insert_image($imgdata) === TRUE) {
					$data['msg'] = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Image Has Been Created Successfully.</div>';
					$this->add_image_template($data);
				}else {
					$data['msg'] = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An Error Was Encountered While Uploading The Image. Please Try Again Later</div>';
					$this->add_image_template($data);
				}
			}
			
		}else {
			$this->add_image_template();
		}
	}
	
	public function add_image_template($data = array()) 
	{
		//check for session and cookie presence
		$this->admin_header();
		
		//fetch the total number of categories
		$config['total_num_image'] = $this->Admin_model->fetch_all_rows('blog_images');
		
		//fetch the total number of tags
		$data['total_num_blogs'] = $this->Admin_model->fetch_all_rows('blog');
		
		//$config['total_rows'] = $this->Admin_model->fetch_all_rows('food');
		  
		$config['base_url'] = site_url("Admin/image_list/");
		$config['per_page'] = 60;
		$config['uri_segment'] = '3';
		$config['num_links'] = round($config['total_num_image'] / $config['per_page']);
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = FALSE;
		
		$config['last_link'] = FALSE;
		
		$config['next_link'] = FALSE;
		
		$config['prev_link'] = FALSE;
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page_number = $this->uri->segment(3);
		$data['images'] = $this->Admin_model->fetch_image($config['per_page'], $page_number);
		
		$data['total_num_pages'] = ceil($config['total_num_image'] / $config['per_page']);
		$data['total_num_rows'] = $config['total_num_image'];
		
		$url_segments = $this->uri->total_segments();
		$data['page_num'] = ($url_segments !== 3) ? 1 : $this->uri->segment(3);
		
		$data['header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/image_list', $data);
	}
	
	public function delete_property()
	{
		//get the table name of the id to be deleted. that will enable us know which view to redirect
		$table_name = $this->input->post('table');
		switch ($table_name) {
			case "admin":
				$redirection_path = "Admin/manage_admins";
				break;
			case "notification":
				$redirection_path = "Admin/notifications";
				break;
			default:
				$redirection_path = "";
		}
		if ($this->Admin_model->delete_property() === TRUE) {
			redirect($redirection_path);
		}else {
			redirect($redirection_path);
		}
	}
	
	
	public function settings()
	{
		
		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run('change-password') === FALSE) {
				
				$this->settings_template();
				
			}else {
				$result = $this->Admin_model->confirm_replace_password();
				
				if ($result === TRUE) {
					
					$data['create_admin_success_message'] = 'Password Changed Successfully';
					
					$this->settings_template($data);
				}else {
					
					$data['create_admin_error_message'] = 'Invalid Password Or No Session Found';
					
					$this->settings_template($data);
				}
			}
		}else {
			$this->settings_template();
		}
		
	}
	
	public function settings_template($data = array())
	{
		$this->admin_header();
		$data['header'] = $this->load->view('templates/admin_header', '', TRUE);
		$data['footer'] = $this->load->view('templates/admin_footer', '', TRUE);
		$this->load->view('admins/settings', $data);
	}
	
	public function logout() 
	{
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			//next delete the cookie from the browser
			if (!empty(get_cookie('learnhub'))) {
				delete_cookie('learnhub');
			}
			
			// user logout redirect to login page
			redirect('Admin/login');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('Admin/add_tags');
			
		}
		
	}
	
	
}

?>