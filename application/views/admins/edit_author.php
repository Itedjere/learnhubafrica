<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog Dashboard :: Edit Author</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admin'); ?>">Blog Dashboard</a> / Edit Authors</h3>
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
                        	<span><?php echo $total_num_category; ?></span>
                            <p>Total Number of Category</p>
                            <a href="<?php echo site_url('Admin/category_list/'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Edit Category List</a>
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
							<?php echo form_open_multipart('Admin/edit_author/'.$author_details->author_id, $attributes); ?>
                            <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">
                                	<label class="control-label col-sm-2" for="email">Name:</label>
                                    <div class="col-sm-10">
                                    	<input type="text" class="form-control" id="author_name" name="author_name" value="<?php echo $author_details->author_name; ?>">
                                        <input type="hidden" name="hidden_author_name" value="<?php echo $author_details->author_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-2" for="pwd">Author Biography:</label>
                                    <div class="col-sm-10">    
                                    	<textarea class="form-control" id="author_bio" name="author_bio"><?php echo $author_details->author_biography; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label class="control-label col-sm-2" for="pwd">Author's Photo:</label>
                                    <div class="col-sm-10">    
                                    	<input class="form-control" name="author_photo" id="author_photo" type="file" value="<?php echo $author_details->author_pic; ?>">
                                        <input type="hidden" name="hidden_author_photo" value="<?php echo $author_details->author_pic; ?>">
                                        <input type="hidden" name="hidden_author_slug" value="<?php echo $author_details->author_slug; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Facebook Link <i class="fa fa-facebook btn btn-sm btn-primary"></i> <small>use the # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="<?php echo $author_details->facebook; ?>" name="fb_url" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Twitter Link <i class="fa fa-twitter btn btn-sm bg-green"></i> <small>use the # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="<?php echo $author_details->twitter; ?>" name="tw_url" placeholder="Please enter your Twitter Contact link" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">LinkedIn Link <i class="fa fa-linkedin btn btn-sm bg-green"></i> <small>use the # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="<?php echo $author_details->linkedin; ?>" name="lk_url" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Instagram Link <i class="fa fa-instagram btn btn-sm bg-green"></i> <small>use the # if its null</small></label>
                                    <div class="col-sm-10">
										<input class="form-control" value="<?php echo $author_details->instagram; ?>" name="in_url" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-sm-2">Website Link </label>
                                    <div class="col-sm-10">
										<input class="form-control" value="<?php echo $author_details->website; ?>" name="website" type="text">
                                    </div>
								</div>
                                
                                <div class="form-group">        
                                    <div class="col-sm-offset-2 col-sm-10">
                                    	<button type="submit" class="btn btn-success">Edit Author <i class="fa fa-download"></i></button>
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