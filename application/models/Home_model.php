<?php


class Home_model extends CI_Model {
	
	public $total_num_rows;
	public $db_query_string = "";
	public $db_query;

	public function __construct()
	{
		$this->load->database();
	}
	
	public function fetch_all_rows($table_name)
	{
		return $this->db->count_all($table_name);
	}
	
	public function total_num_rows()
	{
		return $this->total_num_rows;
	}
	
	public function db_query_string() 
	{
		return $this->db_query;
	}
	
	public function fetch_menu_name_by_food_id($food_id) {
		$this->db->select('food_category_id');
		$this->db->where('food_id', $food_id);
		$query = $this->db->get('food');
		
		$row = $query->row();
		//menu id
		$menu_id = $row->food_category_id;
		
		//now use the menu id to get its name from the menu table
		$this->db->select('category_name');
		$this->db->where('category_id', $menu_id);
		$query = $this->db->get('category');
		
		$row = $query->row();
		//menu name
		return $row->category_name;
	}
	
	public function insert_customer()
	{
		$customer = array(
			'order_id' 	=> '',
			'name' 		=> $this->input->post('name'),
			'phone' 	=> $this->input->post('phone'),
			'email' 	=> $this->input->post('email'),
			'address' 	=> $this->input->post('address'),
			'status'	=> 'open',
			'time'		=> time()
		);
		
		$this->db->insert('order', $customer);
		
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	   // Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('order_details', $data);
	}
	
	public function insert_contact_form_details()
	{
		$data = array(
				'id' => '',
				'firstName'=> $this->input->post('firstName'),
				'phone' => $this->input->post('userPhone'),
				'email' => $this->input->post('userEmail'),
				'message' => $this->input->post('userMessage'),
				'time' => time()
		);
		
		$this->db->insert('notification', $data);
		
		return TRUE;
	}
	
	public function fetch_all_category_and_blog()
	{
		//the total categories and their posts
		$this->db->distinct();
		$query = $this->db->select('category_id');
		$this->db->order_by('category_id', 'DESC');
		$query = $this->db->get('blog');
		$blogMenusArray = $query->result_array();
		
		//set an empty array that will contain all the food details under each menu
		$menusFood = array();
		
		//next loop round with this vendor menus to get the different foods attached to them
		for($x = 0;  $x < count($blogMenusArray); $x++) {
			
			$this->db->select('blog.id, blog.title, blog.slug, blog.body, blog.image, blog.time, authors.author_name, authors.author_slug, category.category_name, category.category_slug');
			$this->db->from('blog');
			$this->db->join('authors', 'blog.author_id = authors.author_id');
			$this->db->join('category', 'blog.category_id = category.category_id');
			
			$array = array('blog.category_id' => $blogMenusArray[$x]['category_id']);
			
			$this->db->order_by('blog.id', 'DESC');
			$this->db->where($array);
			
			$this->db->limit(3);
			
			$query = $this->db->get();
			$menusFood[$x] = $query->result_array();
		}
		
		//at the end return the array
		return $menusFood;
			
	}
	
	public function fetch_single_category_details($vendorUrl)
	{
		$this->db->select('category_id');
		$this->db->where('category_slug', $vendorUrl);
		$query = $this->db->get('category');
		
		
		
		if ($query->num_rows() > 0) {
			//get the vendor id fitst
			$row = $query->row();
			$vendorId = $row->category_id;
			
			//next get the vendor menus
			$this->db->select('blog.id, blog.title, blog.slug, blog.body, blog.image, blog.time, category.category_name, category.category_slug, category.category_description, category.category_banner, authors.author_name, authors.author_slug');
			$this->db->from('blog');
			$this->db->join('authors', 'blog.author_id = authors.author_id');
			$this->db->join('category', 'blog.category_id = category.category_id');
			
			
			$this->db->order_by('blog.id', 'DESC');
			$this->db->where('blog.category_id', $vendorId);
			
			$query = $this->db->get();
			
			return $query->result_array();
			
		}else {
			return FALSE;
		}
	}
	
	public function fetch_featured_blog_details()
	{
		$this->db->select('blog.title, blog.slug, blog.body, blog.image, category.category_slug');
		
		
		$this->db->from('blog');
		$this->db->join('category', 'blog.category_id = category.category_id');
		
		$this->db->where('blog.featured', 'yes');
		$this->db->limit(3);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function fetch_single_author_details($vendorUrl)
	{
		$this->db->select('author_id');
		$this->db->where('author_slug', $vendorUrl);
		$query = $this->db->get('authors');
		
		
		
		if ($query->num_rows() > 0) {
			//get the vendor id fitst
			$row = $query->row();
			$vendorId = $row->author_id;
			
			//next get the vendor menus
			$this->db->select('blog.title, blog.slug, blog.image, category.category_slug, authors.author_name, authors.author_pic, authors.author_biography, authors.facebook, authors.twitter, authors.linkedin, authors.instagram, authors.website');
			$this->db->from('blog');
			$this->db->join('authors', 'blog.author_id = authors.author_id');
			$this->db->join('category', 'blog.category_id = category.category_id');
			
			
			$this->db->order_by('blog.id', 'DESC');
			$this->db->where('blog.author_id', $vendorId);
			
			$query = $this->db->get();
			
			return $query->result_array();
			
		}else {
			return FALSE;
		}
	}
	
	public function fetch_single_blog_details($blogUrl, $categoryUrl)
	{
		
		//first check if category url is valid
		$this->db->select('category_id');
		$this->db->where('category_slug', $categoryUrl);
		$query = $this->db->get('category');
		
		if ($query->num_rows() > 0) {
			
			//next check if category url is valid
			$this->db->select('id');
			$this->db->where('slug', $blogUrl);
			$query = $this->db->get('blog');
			
			if ($query->num_rows() > 0) {
				
				//get the blog id fitst
				$row = $query->row();
				$blogId = $row->id;
				
				//next get the vendor menus
				$this->db->select('blog.id, blog.title, blog.image, blog.time, blog.body, blog.page_title, blog.page_keywords, blog.page_description, category.category_name, category.category_banner, category.category_description,authors.author_name, authors.author_pic, authors.author_slug');
				$this->db->from('blog');
				$this->db->join('authors', 'blog.author_id = authors.author_id');
				$this->db->join('category', 'blog.category_id = category.category_id');
				
				$this->db->where('blog.id', $blogId);
				
				$query = $this->db->get();
				
				return $query->row_array();
				
				
			}else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
	}
	
	
	public function fetch_three_categories($limit = "")
	{
		//grab all the landed properties from the land table
		$this->db->order_by('category_id', 'DESC');
		
		if ($limit !== ""){
			$this->db->limit($limit);
		}
		
		$query = $this->db->get('category');
		return $query->result_array();
	}
	
	public function fetch_three_recent_blogs() 
	{
		
		//next get the vendor menus
		$this->db->select('blog.title, blog.slug, blog.image, category.category_slug');
		$this->db->from('blog');
		$this->db->join('category', 'blog.category_id = category.category_id');
		
		
		//grab all the landed properties from the land table
		$this->db->order_by('id', 'DESC');
		
		$this->db->limit(3);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function fetch_blog_tags_details($blogUrl) 
	{
		
		//next check if category url is valid
		$this->db->select('id');
		$this->db->where('slug', $blogUrl);
		$query = $this->db->get('blog');
		
		if ($query->num_rows() > 0) {
			
			//get the blog id fitst
			$row = $query->row();
			$blogId = $row->id;
			
			//next get the vendor menus
			$this->db->select('tags.tag_name');
			$this->db->from('tags');
			$this->db->join('blog_and_tags', 'tags.id = blog_and_tags.tag_id');
			
			$this->db->where('blog_and_tags.blog_id', $blogId);
			
			$query = $this->db->get();
			return $query->result_array();
			
		}
	}
	
	public function fetch_recommended_blogs($blogUrl) 
	{
		
		//next check if category url is valid
		$this->db->select('id');
		$this->db->where('slug', $blogUrl);
		$query = $this->db->get('blog');
		
		if ($query->num_rows() > 0) {
			
			//get the blog id fitst
			$row = $query->row();
			$blogId = $row->id;
			
			//next get the tag id for this blog
			$this->db->select('tag_id');
			$this->db->from('blog_and_tags');
			$this->db->where('blog_id', $blogId);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				//next use the tag ids to get the recommended blogs
				$this->db->distinct();
				$this->db->select('blog_id');
				$this->db->from('blog_and_tags');
				
				foreach ($query->result() as $row)
				{
					$this->db->or_where('tag_id', $row->tag_id);
				}
				
				$query = $this->db->get();
				
				//next insert the whole blog_ids into a new array apart from the current blog id we are dealing with
				$recommendedBlogArray = array();
				foreach ($query->result() as $row)
				{
					if ($row->blog_id != $blogId) {
						array_push($recommendedBlogArray, $row->blog_id);
					}
				}
				
				
				
				//if there where recommended blogs fetch their details
				if (count($recommendedBlogArray) > 0) {
					
					//shuffle the array
					shuffle($recommendedBlogArray);
					
					
					//next get the vendor menus
					$this->db->select('blog.title, blog.slug, blog.image, category.category_slug');
					$this->db->from('blog');
					$this->db->join('category', 'blog.category_id = category.category_id');
					
					//check if the total blog id in the array is greater or less than 4
					
					if (count($recommendedBlogArray) > 4) {
						for($x = 0; $x < 4; $x++) {
							$this->db->or_where('blog.id', $recommendedBlogArray[$x]);
							//$y .= $recommendedBlogArray[$x] . ", ";
						}
					}else {
						foreach($recommendedBlogArray as $recommendedBlog) {
							$this->db->or_where('blog.id', $recommendedBlog);
						}
					}
					
					$query = $this->db->get();
					return $query->result_array();
					
					
				}else {
					return FALSE;
				}
			}else {
				return FALSE;
			}
			
		}else {
			return FALSE;
		}
	}
	
	public function fetch_searched_blogs($tagname) 
	{
		
		//next check if category url is valid
		$this->db->select('id');
		$this->db->where('tag_name', $tagname);
		$query = $this->db->get('tags');
		
		if ($query->num_rows() > 0) {
			
			//get the blog id fitst
			$row = $query->row();
			$tagId = $row->id;
			
			//next get the blog id for this tag
			$this->db->distinct();
			$this->db->select('blog_id');
			$this->db->from('blog_and_tags');
			$this->db->where('tag_id', $tagId);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				//next insert the whole blog_ids into a new array apart from the current blog id we are dealing with
				$recommendedBlogArray = array();
				foreach ($query->result() as $row)
				{
					array_push($recommendedBlogArray, $row->blog_id);
				}
				//if there where recommended blogs fetch their details
				if (count($recommendedBlogArray) > 0) {
					
					
					//next get the vendor menus
					$this->db->select('blog.title, blog.slug, blog.image, category.category_slug');
					$this->db->from('blog');
					$this->db->join('category', 'blog.category_id = category.category_id');
					
					foreach($recommendedBlogArray as $recommendedBlog) {
						$this->db->or_where('blog.id', $recommendedBlog);
					}
					
					$query = $this->db->get();
					return $query->result_array();
					
					
				}else {
					return FALSE;
				}
			}else {
				return FALSE;
			}
			
		}else {
			return FALSE;
		}
	}
	
	public function insert_subscriber_email_address()
	{
		$data = array(
				'id' => '',
				'email'=> $this->input->post('email_address')
		);
		
		$this->db->insert('subscribers', $data);
		
		return TRUE;
	}
	
	public function fetch_other_blogs($blogId) 
	{
		
		//next get the vendor menus
		$this->db->select('blog.title, blog.slug, blog.image, category.category_slug');
		$this->db->from('blog');
		$this->db->join('category', 'blog.category_id = category.category_id');
		
		$this->db->where('blog.id !=', $blogId);
		
		//grab all the landed properties from the land table
		$this->db->order_by('id', 'DESC');
		
		$this->db->limit(3);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function fetch_current_blog($blogId) 
	{
		
		//next get the vendor menus
		$this->db->select('blog.title, blog.slug, blog.image, category.category_slug');
		$this->db->from('blog');
		$this->db->join('category', 'blog.category_id = category.category_id');
		
		$this->db->where('blog.id', $blogId);
		
		$query = $this->db->get();
		return $query->row_array();
	}
}


?>