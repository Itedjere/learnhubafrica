<?php

$config = array(

		'login' => array(
				array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'trim|required'
				),
				array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required'
				)
		),
		'create-admin' => array(
						array(
								'field'	=> 'username',
								'label'	=>	'Username',
								'rules'	=>	'trim|required|alpha_numeric|is_unique[admin.username]'
						),
						array(
								'field'	=> 'password',
								'label'	=>	'Password',
								'rules'	=>	'trim|required|alpha_numeric|min_length[8]'
						),
						array(
								'field'	=> 'passconf',
								'label'	=>	'PasswordConfirmation',
								'rules'	=>	'trim|required|matches[password]'
						),
						array(
								'field'	=> 'phone',
								'label'	=>	'Phone Number',
								'rules'	=>	'trim|required|numeric'
						),
						array(
								'field'	=> 'email',
								'label'	=>	'Email',
								'rules'	=>	'trim|required|valid_email'
						)
		),
		'change-password' => array(
					array(
						'field'	=> 'curpassword',
						'label'	=>	'Current Password',
						'rules'	=>	'trim|required|alpha_numeric|min_length[8]'
					),
					array(
						'field'	=> 'newpassword',
						'label'	=>	'New Password',
						'rules'	=>	'trim|required|alpha_numeric|min_length[8]'
					),
					array(
						'field'	=> 'confpassword',
						'label'	=>	'ConfirmationPassword',
						'rules'	=>	'trim|required|matches[newpassword]'
					)
		),
		'contact-form' => array(
					array(
						'field'	=> 'firstName',
						'label'	=>	'Name',
						'rules'	=>	'trim|required|alpha_numeric_spaces'
					),
					array(
						'field'	=> 'userEmail',
						'label'	=>	'Email',
						'rules'	=>	'trim|valid_email'
					),
					array(
						'field'	=> 'userPhone',
						'label'	=>	'Phone',
						'rules'	=>	'trim|required|numeric'
					),
					array(
						'field'	=> 'userMessage',
						'label'	=>	'Message',
						'rules'	=>	'trim|required'
					)
		),
		'subscriber_form'	=>	array(
					array(
						'field'	=> 'email_address',
						'label'	=>	'Email',
						'rules'	=>	'trim|valid_email'
					)
		),
		'add_category-form' => array(
				array(
						'field' => 'category_name',
						'label' => 'Category Name',
						'rules' => 'required|alpha_numeric_spaces'
				),
				array(
						'field' => 'category_description',
						'label' => 'Category Description',
						'rules' => 'required'
				)
		),
		'add_author-form' => array(
				array(
						'field' => 'author_name',
						'label' => 'Author Name',
						'rules' => 'required'
				),
				array(
						'field' => 'author_bio',
						'label' => 'Author Biography',
						'rules' => 'required'
				),
				array(
						'field' => 'fb_url',
						'label' => 'Facebook Url',
						'rules' => 'required'
				),
				array(
						'field' => 'tw_url',
						'label' => 'Twitter Url',
						'rules' => 'required'
				),
				array(
						'field' => 'lk_url',
						'label' => 'LinkedIn Url',
						'rules' => 'required'
				),
				array(
						'field' => 'in_url',
						'label' => 'Instagram Url',
						'rules' => 'required'
				),
				array(
						'field' => 'website',
						'label' => 'Twitter Url',
						'rules' => ''
				)
		),
		'add_tags-form' => array(
				array(
						'field' => 'tag_name',
						'label' => 'Tag Name',
						'rules' => 'required'
				)
		),
		'create_blog-form' => array(
					array(
							'field' => 'category_id',
							'label' => 'Category',
							'rules' => 'required'
					),
					array(
							'field' => 'author_id',
							'label' => 'Author',
							'rules' => 'required'
					),
					array(
						'field'	=> 'blog_title',
						'label'	=>	'Post Title',
						'rules'	=>	'trim|required'
					),
					array(
						'field'	=> 'blog_body',
						'label'	=>	'Post Content',
						'rules'	=>	'trim|required'
					)
		),

);

?>