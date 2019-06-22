<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog Dashboard :: Edit Blog</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admins'); ?>">Blog Dashboard</a> / Edit Blog</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel container-space">
                    <div class="col-sm-12 x_content div_pad_12">
                    	<div class="header-bottom-border">
                        	<i class="fa fa-download"></i> <a href="#bs-example-modal-sm" data-toggle="modal">Edit Blog Post</a>
                        </div>
                        <div class="content_body">
                            <?php
								if (isset($error) && !empty($error)) {
									echo $error;
								}
								if (isset($msg) && !empty($msg)) {
									echo $msg;
								}
							?>
                        	<?php echo validation_errors('<div class="alert alert-danger col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); ?>
                            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'edit_blog', 'role'	=>	'form'); ?>
							<?php echo form_open_multipart('Admin/edit_blog/'.$blog->id, $attributes); ?>
                            <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="blog_title">Title:</label>
                                    <div class="col-sm-11">
                                    	<input type="text" class="form-control" id="blog_title" name="blog_title" value="<?php echo $blog->title; ?>">
                                        <input type="hidden" name="hidden_blog_title" value="<?php echo $blog->title; ?>">
                                        <input type="hidden" name="hidden_slug" value="<?php echo $blog->slug; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="blog_photo">Photo:</label>
                                    <div class="col-sm-11">    
                                    	<input class="form-control" name="blog_photo" id="blog_photo" type="file" value="<?php echo $blog->image; ?>">
                                        <input type="hidden" name="hidden_blog_photo" value="<?php echo $blog->image; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1">Body:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control blog_body" id="textarea" name="blog_body" placeholder"Enter Blog Body" ><?php echo $blog->body; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="category">Category list:</label>
                                    <div class="col-sm-11">
                                        <select class="form-control" id="category" name="category_id">
                                        	<option value="">Select Category</option>
                                            <?php foreach($categorys as $category): ?>
                                            <option value="<?php echo $category->category_id; ?>" <?php echo ($category->category_id == $blog->category_id) ? 'selected="selected"' : ''; ?> >
											<?php echo $category->category_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="authors">Authors list:</label>
                                    <div class="col-sm-11">
                                        <select class="form-control" id="authors" name="author_id">
                                        	<option value="">Select Author</option>
                                            <?php foreach($authors as $author): ?>
                                            <option value="<?php echo $author->author_id; ?>" <?php echo ($author->author_id == $blog->author_id) ? 'selected="selected"' : ''; ?>><?php echo $author->author_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="page_title">Page Title:</label>
                                    <div class="col-sm-11">
                                    	<input type="text" class="form-control" id="page_title" name="page_title" value="<?php echo $blog->page_title; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="page_description">Page Description:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control" id="page_description" name="page_description" ><?php echo $blog->page_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="page_keywords">Page Keywords:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control" id="page_keywords" name="page_keywords"><?php echo $blog->page_keywords; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="tags">Tags:</label>
                                    <div class="col-sm-11">
                                        <select multiple class="form-control" id="tags" name="tags[]">
                                        	<option value="">Add New Tags</option>
                                            <?php 
											foreach($tags as $tag) {
												$tagAvailable = array();
												foreach($tag_ids as $tag_id) {
													if ($tag->id == $tag_id->tag_id) {
														array_push($tagAvailable, "yes");
													}else {
														array_push($tagAvailable, "no");
													}
												}
												$selectedOrNot = (in_array("yes", $tagAvailable)) ? 'selected="selected"' : '';
											?>
                                            <option value="<?php echo $tag->id; ?>" <?php echo $selectedOrNot; ?> ><?php echo $tag->tag_name; ?></option>
                                            <?php 
											}
											?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="add_new_tags">Wanna Add New Tags?:</label>
                                    <div class="col-sm-11">    
                                    	<input type="checkbox" name="add_new_tags" id="add_new_tags" value="yes" />
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="tag_name">Add New Tags:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control" id="tag_name" name="tag_name">#tech#AI#digiatal marketing#bloging#catering#programming</textarea>
                                    </div>
                                </div>
                                <div class="form-group">        
                                    <div class="col-sm-offset-1 col-sm-11">
                                    	<button type="submit" class="btn btn-success">Edit Blog <i class="fa fa-download"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>