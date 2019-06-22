<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog Dashboard :: Create A Blog</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="index.php">Blog Dashboard</a> / Create Blog</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel container-space">
                    <div class="col-sm-12 x_content div_pad_12">
                    	<div class="header-bottom-border">
                        	<i class="fa fa-download"></i> <a href="#bs-example-modal-sm" data-toggle="modal">Create A New Blog</a>
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
                            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'create-blog', 'role'	=>	'form'); ?>
							<?php echo form_open_multipart('Admin/create_blog', $attributes); ?>
                            <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="email">Title:</label>
                                    <div class="col-sm-11">
                                    	<input type="text" class="form-control" id="blog_title" name="blog_title" placeholder="Enter Blog Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="pwd">Photo:</label>
                                    <div class="col-sm-11">    
                                    	<input class="form-control" name="blog_photo" id="blog_photo" type="file">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="pwd">Body:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control blog_body" id="textarea" name="blog_body" placeholder"Enter Blog Body" ></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="sel1">Category list:</label>
                                    <div class="col-sm-11">
                                        <select class="form-control" id="sel1" name="category_id">
                                        	<option value="">Select Category</option>
                                            <?php foreach($categorys as $category): ?>
                                            <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="sel1">Authors list:</label>
                                    <div class="col-sm-11">
                                        <select class="form-control" id="sel1" name="author_id">
                                        	<option value="">Select Author</option>
                                            <?php foreach($authors as $author): ?>
                                            <option value="<?php echo $author->author_id; ?>"><?php echo $author->author_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="page_title">Page Title:</label>
                                    <div class="col-sm-11">
                                    	<input type="text" class="form-control" id="page_title" name="page_title" placeholder="Enter Page Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="page_description">Page Description:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control" id="page_description" name="page_description" placeholder"Enter Page Description" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="page_keywords">Page Keywords:</label>
                                    <div class="col-sm-11">    
                                    	<textarea class="form-control" id="page_keywords" name="page_keywords" placeholder"Enter Page Keywords" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="tags">Tags:</label>
                                    <div class="col-sm-11">
                                        <select multiple class="form-control" id="sel2" name="tags[]">
                                        	<option value="">Add New Tags</option>
                                            <?php foreach($tags as $tag): ?>
                                            <option value="<?php echo $tag->id; ?>"><?php echo $tag->tag_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-1" for="pwd">Wanna Add New Tags?:</label>
                                    <div class="col-sm-11">    
                                    	<input type="checkbox" name="add_new_tags" value="yes" />
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
                                    	<button type="submit" class="btn btn-success">Create Blog <i class="fa fa-download"></i></button>
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