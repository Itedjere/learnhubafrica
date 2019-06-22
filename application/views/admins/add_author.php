<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog Dashboard :: Add An Author</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admin'); ?>">Blog Dashboard</a> / Add Authors</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel container-space">
                    <div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span><?php echo $total_num_authors; ?></span>
                            <p>Total Number of Authors</p>
                            <a href="<?php echo site_url('Admin/authors_list/'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Edit Authors List</a>
                        </div>
                    </div>
                    <div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span><?php echo $total_num_blog; ?></span>
                            <p>Total Number Of Blogs</p>
                            <a href="<?php echo site_url('Admin/add_blog/'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Blogs</a>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 x_content div_pad_12">
                    	<div class="header-bottom-border">
                        	<i class="fa fa-download"></i> <a href="#bs-example-modal-sm" data-toggle="modal">Add A New Author</a>
                        </div>
                        <div class="content_body">
                        	<?php
								if (isset($msg) && !empty($msg)) {
									echo $msg;
								}
							?>
                        	<?php echo validation_errors('<div class="alert alert-danger col-sm-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); ?>
                            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'add_author', 'role'	=>	'form'); ?>
							<?php echo form_open_multipart('Admin/add_author', $attributes); ?>
                            <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">
                                	<label class="control-label col-sm-2" for="email">Name:</label>
                                    <div class="col-sm-10">
                                    	<input type="text" class="form-control" id="author_name" name="author_name" placeholder="Enter Author's Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-2" for="pwd">Author Biography:</label>
                                    <div class="col-sm-10">    
                                    	<textarea class="form-control" id="author_bio" name="author_bio" placeholder"Enter Author's Biography" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-2" for="pwd">Author's Photo:</label>
                                    <div class="col-sm-10">    
                                    	<input class="form-control" name="author_photo" id="author_photo" type="file">
                                    </div>
                                </div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Facebook Link <i class="fa fa-facebook btn btn-sm btn-primary"></i> <small>replace with # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="http://facebook.com/" name="fb_url" placeholder="Please enter your Facebook Contact link" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Twitter Link <i class="fa fa-twitter btn btn-sm bg-green"></i> <small>replace with # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="http://twitter.com/" name="tw_url" placeholder="Please enter your Twitter Contact link" type="text">
                                    </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-sm-2">LinkedIn Link <i class="fa fa-linkedin btn btn-sm bg-green"></i> <small>replace with # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="http://linkedin.com/" name="lk_url" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Instagram Link <i class="fa fa-instagram btn btn-sm bg-green"></i> <small>replace with # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="http://instagram.com/" name="in_url" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Website Link <i class="fa fa-instagram btn btn-sm bg-green"></i> <small>replace with # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="#" name="website" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">        
                                    <div class="col-sm-offset-2 col-sm-10">
                                    	<button type="submit" class="btn btn-success">Add Author <i class="fa fa-download"></i></button>
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