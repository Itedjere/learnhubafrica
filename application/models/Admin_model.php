<?php


class Admin_model extends CI_Model {

	public function __construct()
	{
		
	}
	
	public function fetch_all_rows($table_name)
	{
		return $this->db->count_all($table_name);
	}
	
	public function return_total_rows($table_name, $where_field="", $where_value="") 
	{
		if ($where_field !== "" && $where_value !== "") {
			$this->db->where($where_field, $where_value);
		}
		$query = $this->db->get($table_name);
		return $query->num_rows();
	}
	
	public function return_single_row($table_name, $where_field="", $where_value="") 
	{
		if ($where_field !== "" && $where_value !== "") {
			$this->db->where($where_field, $where_value);
		}
		$query = $this->db->get($table_name);
		return $query->result_array();
	}
	
	public function fetch_all_rows_datas($primary_key, $tablename)
	{
		$this->db->order_by($primary_key, 'DESC');
		$query = $this->db->get($tablename);
		return $query->result();
	}
	
	
	
	
	public function fetch_notification($limit="", $page_number="")
	{
		//grab all the category details from the category table
		$this->db->order_by('id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$this->db->from('notification');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function fetch_notification_message($notification_id)
	{
		$this->db->where('id', $notification_id);
		$query = $this->db->get('notification');
		if ($query->num_rows() == 1) {
			return $query->row();
		}else {
			return FALSE;
		}
	}
	
	public function delete_notification_details($categoryId)
	{
		$this->db->delete('notification', array('id' => $categoryId));
	}
	
	
	public function check_session_cookie()
	{
		if (empty($this->session->userdata('username'))) 
		{
			$this->db->where('username', get_cookie('learnhub'));
			$query = $this->db->get('admin');
			
			if ($query->num_rows() == 1) 
			{
				$row = $query->row();
				//set up a session for the user
				$newdata = array(
						'admin_id'	=>	$row->id,
						'username'  => $row->username,
						'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);
				
				$query->free_result();   // The $query result object will no longer be available
				
				return TRUE;
			}
			else 
			{
				return FALSE;
			}
		}
		else 
		{
			return TRUE;
		}
	}
	
	public function confirm_replace_password()
	{
		$username = $this->session->userdata('username');
		
		//check if the password attached to this username corresponds with the one from the form
		$this->db->where('username', $username);
		$query = $this->db->get('admin');
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			
			//get the password from the form
			$password = $this->input->post('curpassword');
			
			$admin_id = $row->id;
			$db_password = $row->password;
			$secret_salt = strtolower($row->username);
			$hs_password = hash_hmac("sha256", $password, $secret_salt);
			
			if ($hs_password == $db_password) {
				//get the password from the form
				$newpassword = $this->input->post('newpassword');
				$newhs_password = hash_hmac("sha256", $newpassword, $secret_salt);
				
				$data = array(
					'password' => $newhs_password
				);
				
				$this->db->where('id', $admin_id);
				$this->db->update('admin', $data);
				
				return TRUE;
			}else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
	}
	
	public function confirm_admin_login()
	{
		//get the username from the input field
		$username = $this->input->post('username');
		
		
		//run a query to check if this username exists
		$this->db->where('username', $username);
		$query = $this->db->get('admin', 1);
		
		//check if the query fetched any result
		if ($query->num_rows() == 1) {
			//get the salt and password from the database;
			$row = $query->row();
			
			//get the password from the input field
			$password = $this->input->post('password');
			
			$db_password = $row->password;
			$secret_salt = strtolower($row->username);
			$hs_password = hash_hmac("sha256", $password, $secret_salt);
			
			if ($hs_password == $db_password) {
				//set up a session for the user
				$newdata = array(
						'admin_id'	=>	$query->row()->id,
						'username'  => $username,
						'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);
				
				//if the user checked remember, then store a cookie
				if ($this->input->post('remember') == 'YES') {
					$cookie = array(
							'name'   => 'learnhub',
							'value'  => $username,
							'expire' => '259200',
							'domain' => '',
							'path'   => '/'
					);
					
					$this->input->set_cookie($cookie);
				}
				
				return TRUE;
			}else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
		
		
	}
	
	public function add_new_admin()
	{
		//grab the username from the form
		$username = $this->input->post('username');
		
		//check if the username already exists
		$this->db->where('username', $username);
		$query = $this->db->get('admin');
		
		if ($query->num_rows() == 0) {
			$row = $query->row();
			
			$password = $this->input->post('password');
			$secret_salt = strtolower($username);
			$hs_password = $hashed = hash_hmac("sha256", $password, $secret_salt);
			
			$data = array(
					'id' => '',
					'username' => $username,
					'password' => $hs_password,
					'phone'	=> $this->input->post('phone'),
					'email'	=> $this->input->post('email')
			);
			
			$this->db->insert('admin', $data);
			
			//Check the number of affected rows
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}
		}else {
			return FALSE;
		}
	}
	
	public function fetch_all_admins()
	{
		$query = $this->db->get('admin');
		return $query->result();
	}	
	
	
	public function fetch_image($limit="", $page_number="")
	{
		//grab all the category details from the category table
		$this->db->order_by('id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$this->db->from('blog_images');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function insert_image($img_data)
	{
		
		
		$data = array(
				'id' => '',
				'image_path'	=>	$img_data['file_name']
		);
		
		$this->db->insert('blog_images', $data);
		
		//Check the number of affected rows
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	public function insert_category($img_data)
	{
		/*we copy the vendors template from vendors.php into the new file we are going to create*/
		//First give the file a name
		/*$page_name = $property_id . "_" . url_title($part_page_name, 'underscore', TRUE) . ".php";*/
		$slug = url_title($this->input->post('category_name'), 'dash', TRUE);
		$page_name = $slug . ".php";
		
		//next fetch the template [property.php] details and copy into this new file
		$data = file_get_contents('./application/views/templates/category.php');
		
		//now copty the data above into the new page
		$fp = fopen('./application/views/public/category/'.$page_name, "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);
		
		$data = array(
				'category_id' => '',
				'category_name' => $this->input->post('category_name'),
				'category_slug' => $slug,
				'category_description'	=> $this->input->post('category_description'),
				'category_banner'	=>	$img_data['category_banner']
		);
		
		$this->db->insert('category', $data);
		
		//Check the number of affected rows
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	public function fetch_category($limit="", $page_number="")
	{
		//grab all the category details from the category table
		$this->db->order_by('category_id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$this->db->from('category');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function fetch_category_details($category_id)
	{
		$this->db->where('category_id', $category_id);
		$query = $this->db->get('category');
		if ($query->num_rows() == 1) {
			return $query->row();
		}else {
			return FALSE;
		}
	}
	
	public function update_categoy_details($category_id, $imgData = array())
	{
		//set the category banner name
		if (count($imgData) !== 0) {
			$category_banner = $imgData['category_banner'];
			
			//then delete the old vendor logo
			$old_category_banner = "./assets/images/category/" . $this->input->post('hidden_category_banner');
			unlink($old_category_banner);
		}
		else
		{
			$category_banner = $this->input->post('hidden_category_banner');
		}
		
		//set the category name
		if ($this->input->post('category_name') !== $this->input->post('hidden_category_name')) {
			
			$category_name = $this->input->post('category_name');
			$slug = url_title($category_name, 'dash', TRUE);
			$page_name = $slug . ".php";
			
			//next fetch the template [property.php] details and copy into this new file
			$data = file_get_contents('./application/views/templates/category.php');
			
			//now copty the data above into the new page
			$fp = fopen('./application/views/public/category/'.$page_name, "w");
			flock($fp, LOCK_EX);
			fwrite($fp, $data);
			flock($fp, LOCK_UN);
			fclose($fp);
			
			//then delete the old category logo
			$old_category_page = "./application/views/public/category/" . $this->input->post('hidden_category_slug') . ".php";
			unlink($old_category_page);
			
		}else {
			$category_name = $this->input->post('hidden_category_name');
			$slug = $this->input->post('hidden_category_slug');
		}
		
		$data = array(
				'category_name' => $category_name,
				'category_slug'	=>	$slug,
				'category_description'	=>	$this->input->post('category_description'),
				'category_banner'	=>	$category_banner
		);
		
		$this->db->where('category_id', $category_id);
		$this->db->update('category', $data);
		
		return TRUE;
	}
	
	public function delete_category_details($categoryId)
	{
		//first select the vendor details first
		$this->db->where('category_id', $categoryId);
		$query = $this->db->get('category');
		if ($query->num_rows() == 1) {
			$row = $query->row();
			
			//Category Slug
			$categorySlug = $row->category_slug;
			//Category Banner
			$categoryBanner = $row->category_banner;
			
			//update all the blogs where the category is present.
			$data = array(
					'category_id' => 0
			);
			
			$this->db->where('category_id', $categoryId);
			$this->db->update('blog', $data);
			
			//next delete the category banner and page
			
			//category banner
			$categoryBannerLocation = "./assets/images/category/" . $categoryBanner;
			unlink($categoryBannerLocation);
			
			//category page
			$categoryPageLocation = "./application/views/public/category/" . $categorySlug . ".php";
			unlink($categoryPageLocation);
			
			//finally delete the vendor from the vendor table
			$this->db->delete('category', array('category_id' => $categoryId));
		}
	}
	
	
	
	public function insert_author($img_data)
	{
		/*we copy the vendors template from vendors.php into the new file we are going to create*/
		//First give the file a name
		/*$page_name = $property_id . "_" . url_title($part_page_name, 'underscore', TRUE) . ".php";*/
		$slug = url_title($this->input->post('author_name'), 'dash', TRUE);
		$page_name = $slug . ".php";
		
		//next fetch the template [property.php] details and copy into this new file
		$data = file_get_contents('./application/views/templates/author.php');
		
		//now copty the data above into the new page
		$fp = fopen('./application/views/public/author/'.$page_name, "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);
		
		$data = array(
				'author_id' => '',
				'author_name' => $this->input->post('author_name'),
				'author_slug' => $slug,
				'author_pic' => $img_data['author_photo'],
				'author_biography' => $this->input->post('author_bio'),
				'facebook' => $this->input->post('fb_url'),
				'twitter' => $this->input->post('tw_url'),
				'linkedin'	=> $this->input->post('lk_url'),
				'instagram'	=>	$this->input->post('in_url'),
				'website'	=>	$this->input->post('website')
		);
		
		$this->db->insert('authors', $data);
		
		//Check the number of affected rows
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	public function fetch_author($limit="", $page_number="")
	{
		//grab all the category details from the category table
		$this->db->order_by('author_id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$this->db->from('authors');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function fetch_author_details($author_id)
	{
		$this->db->where('author_id', $author_id);
		$query = $this->db->get('authors');
		if ($query->num_rows() == 1) {
			return $query->row();
		}else {
			return FALSE;
		}
	}
	
	public function update_author_details($author_id, $imgData = array())
	{
		//set the author banner name
		if (count($imgData) !== 0) {
			$author_photo = $imgData['author_photo'];
			
			//then delete the old author logo
			$old_author_photo = "./assets/images/author/" . $this->input->post('hidden_author_photo');
			unlink($old_author_photo);
		}
		else
		{
			$author_photo = $this->input->post('hidden_author_photo');
		}
		
		//set the author name
		if ($this->input->post('author_name') !== $this->input->post('hidden_author_name')) {
			
			$author_name = $this->input->post('author_name');
			$slug = url_title($author_name, 'dash', TRUE);
			$page_name = $slug . ".php";
			
			//next fetch the template [property.php] details and copy into this new file
			$data = file_get_contents('./application/views/templates/author.php');
			
			//now copty the data above into the new page
			$fp = fopen('./application/views/public/author/'.$page_name, "w");
			flock($fp, LOCK_EX);
			fwrite($fp, $data);
			flock($fp, LOCK_UN);
			fclose($fp);
			
			//then delete the old author page
			$old_category_page = "./application/views/public/author/" . $this->input->post('hidden_author_slug') . ".php";
			unlink($old_category_page);
			
		}else {
			$author_name = $this->input->post('hidden_author_name');
			$slug = $this->input->post('hidden_author_slug');
		}
		
		$data = array(
				'author_name' => $author_name,
				'author_slug' => $slug,
				'author_pic' => $author_photo,
				'author_biography' => $this->input->post('author_bio'),
				'facebook' => $this->input->post('fb_url'),
				'twitter' => $this->input->post('tw_url'),
				'linkedin'	=> $this->input->post('lk_url'),
				'instagram'	=>	$this->input->post('in_url'),
				'website'	=>	$this->input->post('website')
		);
		
		$this->db->where('author_id', $author_id);
		$this->db->update('authors', $data);
		
		return TRUE;
	}
	
	public function delete_author_details($authorId)
	{
		//first select the vendor details first
		$this->db->where('author_id', $authorId);
		$query = $this->db->get('authors');
		if ($query->num_rows() == 1) {
			$row = $query->row();
			
			//Author Slug
			$authorSlug = $row->author_slug;
			//Author Banner
			$authorBanner = $row->author_pic;
			
			//update all the blogs where the category is present.
			$data = array(
					'author_id' => 0
			);
			
			$this->db->where('author_id', $authorId);
			$this->db->update('blog', $data);
			
			//next delete the category banner and page
			
			//category banner
			$authorBannerLocation = "./assets/images/author/" . $authorBanner;
			unlink($authorBannerLocation);
			
			//category page
			$authorPageLocation = "./application/views/public/author/" . $authorSlug . ".php";
			unlink($authorPageLocation);
			
			//finally delete the vendor from the vendor table
			$this->db->delete('authors', array('author_id' => $authorId));
		}
	}
	
	
	
	
	public function insert_tags()
	{
		//get the inserted tags
		$tags = $this->input->post('tag_name');
		
		//check if # symbol is present
		$hash_present = strpos($tags, "#");
		
		if ($hash_present === false) {
			//set an empty array to hold tag
			$tagsArray = array();
			
			//here means we do not have multiple tags but one tag we will push the tag into our empty array
			array_push($tagsArray, $tags);
		}else {
			//here means we have multiple hash tags
			$tagsArray = explode("#", $tags);
		}
		
		//run a for loop to insert the tags into the table
		for ($x = 0; $x < count($tagsArray); $x++) {
			//check to see that the tag is not empty
			if ($tagsArray[$x] !== "") {
				$data = array(
						'id' => '',
						'tag_name' => $tagsArray[$x]
				);
				
				$this->db->insert('tags', $data);
			}
		}
		
		return TRUE;
	}
	
	public function fetch_tags($limit="", $page_number="")
	{
		//grab all the category details from the category table
		$this->db->order_by('id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$this->db->from('tags');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function delete_tag_details()
	{
		//first select the vendor details first
		$tagId = $this->input->post('hidden_tag_id');
		
		$this->db->where('id', $tagId);
		$query = $this->db->get('tags');
		if ($query->num_rows() == 1) {
			
			//delete the tag from the tag_and_blog table
			$this->db->delete('blog_and_tags', array('tag_id' => $tagId));
			
			//delete the tag from the tags table
			$this->db->delete('tags', array('id' => $tagId));
			
		}
	}
	
	public function edit_tag_details()
	{
		//first select the vendor details first
		$tagId = $this->input->post('edit_hidden_tag_id');
		$tag_name = $this->input->post('edit_tag_name');
		
		$this->db->where('id', $tagId);
		$query = $this->db->get('tags');
		if ($query->num_rows() == 1) {
			
			//delete the tag from the tag_and_blog table
			$data = array(
					'tag_name' => $tag_name
			);
			
			$this->db->where('id', $tagId);
			$this->db->update('tags', $data);
			
			return TRUE;
			
		}
	}
	
	
	
	
	public function insert_blog($img_data)
	{
		/*we copy the vendors template from vendors.php into the new file we are going to create*/
		//First give the file a name
		/*$page_name = $property_id . "_" . url_title($part_page_name, 'underscore', TRUE) . ".php";*/
		$title = $this->input->post('blog_title');
		$slug = url_title($title, 'dash', TRUE);
		$page_name = $slug . ".php";
		
		//next fetch the template [property.php] details and copy into this new file
		$data = file_get_contents('./application/views/templates/singleblog.php');
		
		//now copty the data above into the new page
		$fp = fopen('./application/views/public/blogs/'.$page_name, "w");
		flock($fp, LOCK_EX);
		fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);
		
		//next check to see if tags were selected for the blog
		//first create an empty array that will later hold all the tags
		$tagsArray = array();
		$selectedTags = $this->input->post('tags');
		//now check if tags were selected
		if ($selectedTags !== NULL) {
			foreach($selectedTags as $tag_id) {
				array_push($tagsArray, $tag_id);
			}
		}
		
		//next check to see if new tags were added
		$addNewTags = $this->input->post('add_new_tags');
		if ($addNewTags !== NULL) {
			$newTagsAdded = $this->input->post('tag_name');
			//check if the new tags field is not empty
			if ($newTagsAdded != "") {
				
				//check if # symbol is present
				$hash_present = strpos($newTagsAdded, "#");
				
				if ($hash_present === false) {
					//set an empty array to hold tag
					$arrayForTags = array();
					
					//here means we do not have multiple tags but one tag we will push the tag into our empty array
					array_push($arrayForTags, $newTagsAdded);
				}else {
					//here means we have multiple hash tags
					$arrayForTags = explode("#", $newTagsAdded);
				}
				
				//run a for loop to insert the tags into the table
				for ($x = 0; $x < count($arrayForTags); $x++) {
					if ($arrayForTags[$x] !== "") {
						$data = array(
								'id' => '',
								'tag_name' => $arrayForTags[$x]
						);
						
						$this->db->insert('tags', $data);
						
						//grab the inserted ids from the table and insert them into the tags array
						array_push($tagsArray, $this->db->insert_id());
					}
					
				}
			}
		}
		
		$data = array(
				'id' => '',
				'title' => $title,
				'slug' => $slug,
				'body'	=> $this->input->post('blog_body'),
				'image'	=> $img_data['file_name'],
				'page_title'	=>	$this->input->post('page_title'),
				'page_keywords'	=>	$this->input->post('page_keywords'),
				'page_description'	=>	$this->input->post('page_description'),
				'time'	=>	time(),
				'author_id'	=>	$this->input->post('author_id'),
				'category_id'	=>	$this->input->post('category_id')
		);
		
		$this->db->insert('blog', $data);
		$insertedBlogId = $this->db->insert_id();
		
		//now that we have all the tags for this blog in a tags array we can now add them into the table
		foreach($tagsArray as $theTagsId) {
			$data = array(
					'bat_id' => '',
					'blog_id' => $insertedBlogId,
					'tag_id' => $theTagsId
			);
			
			$this->db->insert('blog_and_tags', $data);
		}
		
		return TRUE;
	}
	
	public function updata_blog_details($blog_id, $img_data)
	{
		//set the author banner name
		if (count($img_data) !== 0) {
			$blog_photo = $img_data['blog_photo'];
			
			//then delete the old author logo
			$old_blog_photo = "./assets/images/blog/" . $this->input->post('hidden_blog_photo');
			unlink($old_blog_photo);
		}
		else
		{
			$blog_photo = $this->input->post('hidden_blog_photo');
		}
		//the post slug
		if (url_title($this->input->post('blog_title'), 'dash', TRUE) !== $this->input->post('hidden_slug')) {
			$title = $this->input->post('blog_title');
			$slug = url_title($title, 'dash', TRUE);
			
			//then delete the old blog page
			$old_blog_page = "./application/views/public/blog/" . $this->input->post('hidden_slug') . ".php";
			unlink($old_blog_page);
			
			
			$page_name = $slug . ".php";
			//next fetch the template [property.php] details and copy into this new file
			$data = file_get_contents('./application/views/templates/singleblog.php');
			
			//now copty the data above into the new page
			$fp = fopen('./application/views/public/blog/'.$page_name, "w");
			flock($fp, LOCK_EX);
			fwrite($fp, $data);
			flock($fp, LOCK_UN);
			fclose($fp);
		}else {
			$title = $this->input->post('hidden_blog_title');
			$slug = $this->input->post('hidden_slug');
		}
		
		//next check to see if tags were selected for the blog
		//first create an empty array that will later hold all the tags
		$tagsArray = array();
		$selectedTags = $this->input->post('tags');
		//now check if tags were selected
		if ($selectedTags !== NULL) {
			foreach($selectedTags as $tag_id) {
				array_push($tagsArray, $tag_id);
			}
		}
		
		//next check to see if new tags were added
		$addNewTags = $this->input->post('add_new_tags');
		if ($addNewTags !== NULL) {
			$newTagsAdded = $this->input->post('tag_name');
			//check if the new tags field is not empty
			if ($newTagsAdded != "") {
				
				//check if # symbol is present
				$hash_present = strpos($newTagsAdded, "#");
				
				if ($hash_present === false) {
					//set an empty array to hold tag
					$arrayForTags = array();
					
					//here means we do not have multiple tags but one tag we will push the tag into our empty array
					array_push($arrayForTags, $newTagsAdded);
				}else {
					//here means we have multiple hash tags
					$arrayForTags = explode("#", $newTagsAdded);
				}
				
				//run a for loop to insert the tags into the table
				for ($x = 0; $x < count($arrayForTags); $x++) {
					$data = array(
							'id' => '',
							'tag_name' => $arrayForTags[$x]
					);
					
					$this->db->insert('tags', $data);
					
					//grab the inserted ids from the table and insert them into the tags array
					array_push($tagsArray, $this->db->insert_id());
				}
			}
		}
		
		//delete all the old tags attached to this blog id
		$this->db->delete("blog_and_tags", array('blog_id' => $blog_id));
		
		//now that we have all the tags for this blog in a tags array we can now add them into the table
		foreach($tagsArray as $theTagsId) {
			$data = array(
					'bat_id' => '',
					'blog_id' => $blog_id,
					'tag_id' => $theTagsId
			);
			
			$this->db->insert('blog_and_tags', $data);
		}
		
		$data = array(
				'title' => $title,
				'slug' => $slug,
				'body'	=> $this->input->post('blog_body'),
				'image'	=> $blog_photo,
				'page_title'	=>	$this->input->post('page_title'),
				'page_keywords'	=>	$this->input->post('page_keywords'),
				'page_description'	=>	$this->input->post('page_description'),
				'author_id'	=>	$this->input->post('author_id'),
				'category_id'	=>	$this->input->post('category_id')
		);
		
		$this->db->where('id', $blog_id);
		$this->db->update('blog', $data);
		
		return TRUE;
	}
	
	public function fetch_blog($limit="", $page_number="")
	{
		//grab all the food details from the food table
		$this->db->order_by('id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$this->db->select('*');
		$this->db->from('blog');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function fetch_blog_details($blog_id)
	{
		$this->db->where('id', $blog_id);
		$query = $this->db->get('blog');
		if ($query->num_rows() == 1) {
			return $query->row();
		}else {
			return FALSE;
		}
	}
	
	public function fetch_tags_tied_to_blog($blog_id) 
	{
		$this->db->select('tag_id');
		$this->db->where('blog_id', $blog_id);
		$this->db->from('blog_and_tags');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function delete_blog_details($blogId)
	{
		//first select the vendor details first
		$this->db->where('id', $blogId);
		$query = $this->db->get('blog');
		if ($query->num_rows() == 1) {
			$row = $query->row();
			
			//Author Slug
			$blogSlug = $row->slug;
			//Author Banner
			$blogBanner = $row->image;
			
			//finally delete the blog_id from the blog_and_tags table
			$this->db->delete('blog_and_tags', array('blog_id' => $blogId));
			
			//next delete the category banner and page
			
			//category banner
			$authorBannerLocation = "./assets/images/blog/" . $blogBanner;
			unlink($authorBannerLocation);
			
			//category page
			$authorPageLocation = "./application/views/public/blogs/" . $blogSlug . ".php";
			unlink($authorPageLocation);
			
			//finally delete the vendor from the vendor table
			$this->db->delete('blog', array('id' => $blogId));
		}
	}
	
	public function add_remove_featured_blog($blog_id, $feature_status) 
	{
		$data = array(
				'featured' => $feature_status
		);
		
		$this->db->where('id', $blog_id);
		if ($this->db->update('blog', $data)) {
			return true;
		}else {
			return false;
		}
		
	}
	
	
	
	
	public function delete_property()
	{
		$table_name = $this->input->post('table');
		$property_id = $this->input->post('delete-property-id');
		
		$this->db->where('id', $property_id); 
		$query = $this->db->get($table_name);
		
		if ($query->num_rows() == 1) {
			
			$this->db->delete($table_name, array('id' => $property_id));
	
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	public function fetch_vendor_menus_and_foods($vendorsId)
	{
		$this->db->distinct();
		$query = $this->db->select('food_category_id');
		$this->db->where('food_brand_id', $vendorsId);
		$query = $this->db->get('food');
		return $query->result_array();
		
	}
	
	public function fetch_the_food_array($menuId) 
	{
		//$this->db->where('food_category_id', $menuId);
		//$query = $this->db->get('food');
		
		$this->db->select('food.food_id, food.food_name, food.food_price, food.food_picture, food.food_description, food.food_category_id, category.category_name');
		$this->db->from('food');
		$this->db->join('category', 'category.category_id = food.food_category_id');
		$this->db->where('food.food_category_id', $menuId);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_remove_food_home() {
		
		$columnName = $this->input->post('columnName');
		$columnValue = $this->input->post('columnValue');
		$primaryValue = $this->input->post('productId');
		$tableName = $this->input->post('tableName');
		
		
		if ($this->input->post('tableName') == "blog") {
			$where_field = "id";
		}else {
			$where_field = "category_id";
		}
		
		
		$data = array(
				$columnName => $columnValue
		);
		$this->db->where($where_field, $primaryValue);
		
		$this->db->update($tableName, $data);
			
	}
	
	public function fetch_customized_search($sentArrays, $fetch_what)
	{
		
		if ($fetch_what == "fetch_vendors") {
			$fetch = "food.food_brand_id";
		}
		else 
		{
			$fetch = "food.food_category_id";
		}
		
		
		$this->db->select('food.food_id, food.food_name, food.food_price, category.category_name, vendors.vendor_name');
		$this->db->from('food');
		$this->db->join('category', 'category.category_id = food.food_category_id');
		$this->db->join('vendors', 'vendors.vendor_id = food.food_brand_id');
		
		for($i = 0; $i < count($sentArrays); $i++) {
			if ($sentArrays[$i] !== null) {
				$this->db->or_where($fetch, $sentArrays[$i]);
			}
		} 
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function fetch_brands($limit="", $page_number="")
	{
		//grab all the landed properties from the land table
		$this->db->order_by('vendor_id', 'DESC');
		
		if ($limit !== "" && $page_number !== "") {
			$this->db->limit($limit, $page_number);
		}
		
		$query = $this->db->get('vendors');
		return $query->result();
	}
	
	public function fetch_vendor_array()
	{
		//grab all the landed properties from the land table
		$this->db->order_by('vendor_id', 'DESC');
		$query = $this->db->get('vendors');
		return $query->result_array();
	}
	
	public function fetch_brand_details($brand_id)
	{
		$this->db->where('vendor_id', $brand_id);
		$query = $this->db->get('vendors');
		if ($query->num_rows() == 1) {
			return $query->row();
		}else {
			return FALSE;
		}
	}
	
	public function update_brand_details($brand_id)
	{
		//grab all the sale properties from the land table
		$this->db->where('vendor_id', $brand_id);
		$query = $this->db->get('vendors');
		$result =  $query->row();
		
		//check to see if the slug is different
		$slug = url_title($this->input->post('brand_name'), 'dash', TRUE);
		if ($slug !== $result->vendor_slug) {
			//then delete the old slug and put in the new one
			$oldVendorLocation = "./application/views/vendors/" . $result->vendor_slug . ".php";
			unlink($oldVendorLocation);
			
			//next fetch the template [property.php] details and copy into this new file
			$data = file_get_contents('./application/views/templates/vendor.php');
			
			//new page name
			$page_name = $slug . ".php";
			
			//now copty the data above into the new page
			$fp = fopen('./application/views/vendors/'.$page_name, "w");
			flock($fp, LOCK_EX);
			fwrite($fp, $data);
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		
		//set the logo name and the banner name
		if (!empty($_FILES['brand_img']['name'][0])) {
			$vendor_logo = $_FILES['brand_img']['name'][0];
			
			//then delete the old vendor logo
			$oldVendorLogo = "./assets/images/vendors/" . $this->input->post('hidden_brand_logo');
			unlink($oldVendorLogo);
		}
		else
		{
			$vendor_logo = $this->input->post('hidden_brand_logo');
		}
		
		
		if (!empty($_FILES['brand_img']['name'][1])) {
			$vendor_Banner = $_FILES['brand_img']['name'][1];
			
			//then delete the old vendor logo
			$oldVendorBanner = "./assets/images/vendors/" . $this->input->post('hidden_brand_banner');
			unlink($oldVendorBanner);
		}
		else
		{
			$vendor_Banner = $this->input->post('hidden_brand_banner');
		}
		
		$data = array(
				'vendor_name' => $this->input->post('brand_name'),
				'vendor_slug' => $slug,
				'vendor_address'	=> $this->input->post('brand_address'),
				'vendor_bio'	=>	$this->input->post('brand_bio'),
				'vendor_niche'	=>	$this->input->post('brand_niche'),
				'vendor_logo'	=>	$vendor_logo,
				'vendor_banner'	=> $vendor_Banner
		);
		
		$this->db->where('vendor_id', $brand_id);
		$this->db->update('vendors', $data);
		
		return TRUE;
	}
	
	public function inactivate_vendor($vendor_id, $vendor_status) 
	{
		$data = array(
				'vendor_status' => $vendor_status
		);
		
		$this->db->where('vendor_id', $vendor_id);
		$this->db->update('vendors', $data);
	}
	
	public function add_remove_vendor_home($vendor_id, $vendor_status) 
	{
		$data = array(
				'add_home' => $vendor_status
		);
		
		$this->db->where('vendor_id', $vendor_id);
		if ($this->db->update('vendors', $data)) {
			return true;
		}else {
			return false;
		}
		
	}
	
	public function unavailabulate_menu($menu_id) 
	{
		$data = array(
				'menu_status' => 'unavailable'
		);
		
		$this->db->where('category_id', $menu_id);
		$this->db->update('category', $data);
	}
	
	public function fetch_new_orders($limit, $page_number)
	{
		//grab all the landed properties from the land table
		$this->db->order_by('time', 'DESC');
		$this->db->limit($limit, $page_number);
		
		$this->db->where('status', 'open');
		$query = $this->db->get('order');
		return $query->result();
	}
	
	public function fetch_closed_orders($limit, $page_number)
	{
		//grab all the landed properties from the land table
		$this->db->order_by('time', 'DESC');
		$this->db->limit($limit, $page_number);
		
		$this->db->where('status', 'closed');
		$query = $this->db->get('order');
		return $query->result();
	}
	
	public function fetch_order_details() 
	{
		//grab the order Id From The Ajax Post
		$order_id = $this->input->post('order_id');
		//combine all the necessay tables
		
		$this->db->select('*');
		$this->db->from('order');
		$this->db->join('order_details', 'order.order_id = order_details.order_id');
		$this->db->join('food', 'order_details.food_id = food.food_id');
		$this->db->join('category', 'food.food_category_id = category.category_id');
		$this->db->join('vendors', 'food.food_brand_id = vendors.vendor_id AND order.order_id = ' . $order_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function delete_order_details($order_id) 
	{
		
		$this->db->delete('order_details', array('order_id' => $order_id));
		
		$this->db->delete('order', array('order_id' => $order_id));
		
	}
	
	public function close_order($order_id) 
	{
		$data = array(
				'status' => 'closed'
		);
		
		$this->db->where('order_id', $order_id);
		$this->db->update('order', $data);
		return true;
	}
	
	public function delete_food($order_id) 
	{
		//first we need to run a query to get the image of the food and delete it.
		$this->db->where('food_id', $order_id); 
		$query = $this->db->get('food');
		
		if ($query->num_rows() == 1) {
			
			$row = $query->row();
			
			//delete the food image
			$foodImage = $row->food_picture;
			$propertyLocation = "./assets/images/foods/" . $foodImage;
			unlink($propertyLocation);
			
			$this->db->delete("food", array('food_id' => $order_id));
			
		}
	}
	
}

?>