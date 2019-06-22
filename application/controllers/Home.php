<?php

class Home extends CI_controller {
	
	public $userEmail = array('meraldstar@outlook.com');
	//public $userEmail = array('itedjereg77@gmail.com');
	public $admin_form_subject = "A Client Sent You A Message";
	public $contact_form_subject = "Thank You For Contacting Us";
	public $subscribers_subject = "Thank You For Subscribing";
	
	public function __construct()
	{
		parent::__construct();
		
		//load form validation library
		$this->load->library('form_validation');
		
		//load Admin_model model
		$this->load->model('Home_model');
		
		//load form validation library
		$this->load->library('pagination');
	}
	
	public function index()
	{
		$show_active_link = array( 'home' => 'active', 'about' => ' ', 'blog' => ' ', 'contact' => ' ');
		
		//next get the vendor details using its slug url
		$data['featured_blog'] = $this->Home_model->fetch_featured_blog_details();
		
		$data['metas'] = $this->load->view('templates/home_metas', '', TRUE);
		$data['header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
		$data['main_subheader'] = $this->load->view('templates/main_subheader', $show_active_link, TRUE);
		$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
		
		$this->load->view('public/index', $data);
	}
	
	public function about_us()
	{
		$show_active_link = array( 'home' => ' ', 'about' => 'active', 'blog' => ' ', 'contact' => ' ');
		
		$data['metas'] = $this->load->view('templates/home_metas', '', TRUE);
		$data['header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
		$data['main_subheader'] = $this->load->view('templates/main_subheader', $show_active_link, TRUE);
		$data['cta'] = $this->load->view('templates/cta', '', TRUE);
		$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
		
		$this->load->view('public/about', $data);
	}
	
	public function contact_us()
	{
		
		if((isset($_POST) && (!empty($_POST)))){
			$this->send_email();
		}else {
			
			$this->contact_template();
		}
	}
	
	public function contact_template($msg = "")
	{
		$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => ' ', 'contact' => 'active');
		
		$data['error'] = $msg;
		$data['metas'] = $this->load->view('templates/home_metas', '', TRUE);
		$data['header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
		$data['main_subheader'] = $this->load->view('templates/main_subheader', $show_active_link, TRUE);
		$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
		
		$this->load->view('public/contact', $data);
	}
	
	public function send_email()
	{
		if ($this->input->post('ajax') != 1) {
			if ($this->form_validation->run('contact-form') === FALSE)
			{
				$this->contact_template();
			}
		}
		
		
		/*$email_config = Array(
			'protocol'  => 'smtp',
			'smtp_host' => 'localhost',
			'smtp_port' => '25',
			'smtp_user' => 'info@meraldstar.com',
			'smtp_pass' => 'wavelength1',
			'mailtype'  => 'html',
			'starttls'  => true,
			'newline'   => "\r\n"
		);

		$this->load->library('email', $email_config);
		
		$this->email->from('info@meraldstar.com', 'MeraldStar');
		
		$data = array(
			 'firstName' => $this->input->post('firstName'),
			 'userPhone' => $this->input->post('userPhone'),
			 'userEmail' => $this->input->post('userEmail'),
			 'userMessage' => $this->input->post('userMessage')
				 );
			 
				 
		$this->email->to($this->userEmail);  // replace it with receiver mail id
		$this->email->subject($this->admin_form_subject); // replace it with relevant subject
   
		$body = $this->load->view('templates/contact_form_body', $data, TRUE);
		$this->email->message($body);  
		
		
		if ($this->email->send(FALSE)) {
			
			if (!empty($data['userEmail'])) {
				$this->email->to($data['userEmail']);  // replace it with senders mail id
				$this->email->subject($this->contact_form_subject); // replace it with relevant subject
				
				$autoBody = $this->load->view('templates/auto_response_body', $data ,TRUE);
				$this->email->message($autoBody); 
				
				$this->email->send(); //send an auto response message to the client
			}*/
			
			if ($this->Home_model->insert_contact_form_details() === TRUE) {
				if ($this->input->post('ajax') != 1) {
			
					$msg = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Your Message Has Been Sent Successfully.</div>';
					
					$this->contact_template($msg);
				}else {
					echo "sent";
				}
			}
		/*}*/
	}
	
	public function blog()
	{
		$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
		
		//get the total category and three of their latest blog post
		$data['blogMenusArray'] =  $this->Home_model->fetch_all_category_and_blog();
		
		//fetch categories for the navigation side bar
		$data['nav_categories'] = $this->Home_model->fetch_three_categories(5);
		
		//next get the vendor details using its slug url
		$data['featured_blog'] = $this->Home_model->fetch_featured_blog_details();
		
		$data['home_header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
		$data['blog_header'] = $this->load->view('templates/blog-header', $data, TRUE);
		$data['cta'] = $this->load->view('templates/cta', '', TRUE);
		$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
		$data['blog_footer'] = $this->load->view('templates/blog-footer', '', TRUE);
		
		$this->load->view('public/blogs/index', $data);
		
		
	}
	
	public function category()
	{
		//first check if the uri query string is empty apart from the controller name
		$url = (!empty($this->uri->segment(3))) ? $this->uri->segment(3) : "";
		
		//use the url to get the vendor id
		$singleCategoryArray = $this->Home_model->fetch_single_category_details($url);
		
		
		
		if ($singleCategoryArray !== FALSE) {
			
			$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
			
			//fetch categories for the navigation side bar
			$data['nav_categories'] = $this->Home_model->fetch_three_categories(5);
			
			//retrieve and store the vendor foods in their menus
			$data['singleCategory'] = $singleCategoryArray;
			
			$data['home_header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
			$data['blog_header'] = $this->load->view('templates/blog-header', $data, TRUE);
			$data['cta'] = $this->load->view('templates/cta', '', TRUE);
			$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
			$data['blog_footer'] = $this->load->view('templates/blog-footer', '', TRUE);
			$data['category_body'] = $this->load->view('templates/category-body', $data, TRUE);
			
			$this->load->view('public/category/'. $url, $data);
			
		}else {
			redirect('blog');
		}
	}
	
	public function author()
	{
		//first check if the uri query string is empty apart from the controller name
		$url = (!empty($this->uri->segment(3))) ? $this->uri->segment(3) : "";
		
		//use the url to get the vendor id
		$singleAuthorArray = $this->Home_model->fetch_single_author_details($url);
		
		//echo $url;
		/*echo "<pre>";
		print_r($singleAuthorArray);
		echo "</pre>";*/
		
		if ($singleAuthorArray !== FALSE) {
			
			$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
			
			//fetch categories for the navigation side bar
			$data['nav_categories'] = $this->Home_model->fetch_three_categories(5);
			
			//retrieve and store the vendor foods in their menus
			$data['singleAuthor'] = $singleAuthorArray;
			
			$data['home_header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
			$data['blog_header'] = $this->load->view('templates/blog-header', $data, TRUE);
			$data['cta'] = $this->load->view('templates/cta', '', TRUE);
			$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
			$data['blog_footer'] = $this->load->view('templates/blog-footer', '', TRUE);
			$data['author_body'] = $this->load->view('templates/author_body', $data, TRUE);
			
			$this->load->view('public/author/'. $url, $data);
			
			/*echo "<pre>";
			print_r($singleAuthorArray);
			echo "</pre>";*/
			
		}else {
			redirect('blog');
		}
	}
	
	public function single_blog()
	{
		//first check if the uri query string is empty apart from the controller name
		$category_url = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : "";
		$blog_url = (!empty($this->uri->segment(3))) ? $this->uri->segment(3) : "";
		
		if ($category_url == "" || $blog_url == "") {
			redirect('blog');
		}
		
		//use the url to get the vendor id
		$singleBlogArray = $this->Home_model->fetch_single_blog_details($blog_url, $category_url);
		
		
		if ($singleBlogArray !== FALSE) {
			//retrieve and store the blog details
			$data['singleBlog'] = $singleBlogArray;
			
			//retrieve the first three category
			$data['categories'] = $this->Home_model->fetch_three_categories(3);
			
			//retrieve the most recent blog posts
			$data['recent_blogs'] = $this->Home_model->fetch_three_recent_blogs();
			
			//retrieve the tags for this blog
			$data['tags'] = $this->Home_model->fetch_blog_tags_details($blog_url);
			
			//retrieve the recommended blogs
			$recommended_blog = $this->Home_model->fetch_recommended_blogs($blog_url);
			
			/*echo "<pre>";
			print_r($data['recommended_blogs']);
			echo "</pre>";*/
			
			if ($recommended_blog !== FALSE) {
				$data['recommended_blogs'] = $recommended_blog;
			}else {
				$data['recommended_blogs'] = array();
			}
			
			$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
			
			//fetch categories for the navigation side bar
			$data['nav_categories'] = $this->Home_model->fetch_three_categories(5);
			
			$data['home_header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
			$data['blog_header'] = $this->load->view('templates/blog-header', $data, TRUE);
			$data['cta'] = $this->load->view('templates/cta', '', TRUE);
			$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
			$data['blog_footer'] = $this->load->view('templates/blog-footer', '', TRUE);
			$data['advert_page'] = $this->load->view('templates/advert-page', '', TRUE);
			$data['blog_body'] = $this->load->view('templates/blog-body', $data, TRUE);
			
			$this->load->view('public/blogs/'. $blog_url, $data);
			
		}else {
			redirect('blog');
		}
	}
	
	public function submit_subscriber_email()
	{
		$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
		
		$blogId = $this->input->post('this_blog_id');
		
		$subscribers_email = $this->input->post('email_address');
		
		/*$email_config = Array(
			'protocol'  => 'smtp',
			'smtp_host' => 'localhost',
			'smtp_port' => '25',
			'smtp_user' => 'info@meraldstar.com',
			'smtp_pass' => 'wavelength1',
			'mailtype'  => 'html',
			'starttls'  => true,
			'newline'   => "\r\n"
		);

		$this->load->library('email', $email_config);
		
		$this->email->from('info@meraldstar.com', 'MeraldStar');
		
		$this->email->to($subscribers_email);  
		$this->email->subject($this->subscribers_subject);
		
		$autoBody = $this->load->view('templates/auto_response_body', $data ,TRUE);
		$this->email->message($autoBody); 
		
		$this->email->send(); */
		
		$this->Home_model->insert_subscriber_email_address();
		
		//fetch categories for the navigation side bar
		$data['nav_categories'] = $this->Home_model->fetch_three_categories(5);
		
		$data['current_blog'] = $this->Home_model->fetch_current_blog($blogId);
		
		$data['other_blogs'] = $this->Home_model->fetch_other_blogs($blogId);
		
		$data['home_header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
		$data['blog_header'] = $this->load->view('templates/blog-header', $data, TRUE);
		$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
		$data['blog_footer'] = $this->load->view('templates/blog-footer', '', TRUE);
		
		$this->load->view('public/blogs/thank-you-email-subscription', $data);
	}
	
	public function search()
	{
		//first check if the uri query string is empty apart from the controller name
		if (!$this->input->get('tag') || $this->input->get('tag') == "") {
			redirect('blog');
		}
		
		$data['tag_name'] = $tag_name = $this->input->get('tag');
		
		//use the url to get the vendor id
		$singleAuthorArray = $this->Home_model->fetch_searched_blogs($tag_name);
		
		//echo $url;
		/*echo "<pre>";
		print_r($singleAuthorArray);
		echo "</pre>";*/
		
		if ($singleAuthorArray !== FALSE) {
			
			$show_active_link = array( 'home' => ' ', 'about' => ' ', 'blog' => 'active', 'contact' => ' ');
			
			//fetch categories for the navigation side bar
			$data['nav_categories'] = $this->Home_model->fetch_three_categories(5);
			
			//retrieve and store the vendor foods in their menus
			$data['singleAuthor'] = $singleAuthorArray;
			
			$data['home_header'] = $this->load->view('templates/home_header', $show_active_link, TRUE);
			$data['blog_header'] = $this->load->view('templates/blog-header', $data, TRUE);
			$data['cta'] = $this->load->view('templates/cta', '', TRUE);
			$data['footer'] = $this->load->view('templates/home_footer', '', TRUE);
			$data['blog_footer'] = $this->load->view('templates/blog-footer', '', TRUE);
			$data['search_body'] = $this->load->view('templates/search_body', $data, TRUE);
			
			$this->load->view('templates/search', $data);
			
			/*echo "<pre>";
			print_r($singleAuthorArray);
			echo "</pre>";*/
			
		}else {
			redirect('blog');
		}
	}
	
}

?>