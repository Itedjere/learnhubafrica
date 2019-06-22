<!DOCTYPE html>
<html class=" " lang="en"><head>
<title>Change Your Password</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admin'); ?>">Home</a> / <a href="<?php echo site_url('Admin/manage_admins'); ?>">Admins</a> / Change Password</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	
                <div class="x_panel container-space">
                    <!--<div class="x_title">
                        <h2>Add Brand</h2>
                        <div class="clearfix"></div>
                    </div>-->
                    <div class="col-sm-12 x_content div_pad_12">
                    	<div class="header-bottom-border">
                        	<i class="fa fa-download"></i> Change Password
                        </div>
                        <div class="content_body">
                        	<?php
								if (isset($create_admin_error_message)) {
									echo '<div class="alert alert-danger col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
									echo $create_admin_error_message;
									echo '</div>';
								}
								if (isset($create_admin_success_message)) {
									echo '<div class="alert alert-success col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
									echo $create_admin_success_message;
									echo '</div>';
								}
							?>
							<?php echo validation_errors('<div class="alert alert-danger col-sm-offset-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); ?>
                            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'add_admin', 'role'	=>	'form'); ?>
							<?php echo form_open('Admin/settings', $attributes); ?>
                            <!--<form class="form-horizontal" role="form">-->
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for"property-location-state">Current Password</label>
                                    <div class="col-sm-11">
                                        <input type="text" name="curpassword" class="form-control" id"property-location-state" value="<?php echo set_value('curpassword'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for"property-location-area">New Password</label>
                                    <div class="col-sm-11">
                                    	<input type="text" name="newpassword" class="form-control" id"property-location-area" value="<?php echo set_value('newpassword'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for"property-sales-cost">Re-type Password</label>
                                    <div class="col-sm-11">
                                    	<input type="text" name="confpassword" class="form-control" id"property-sales-cost" value="<?php echo set_value('confpassword'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">        
                                    <div class="col-sm-offset-1 col-sm-11">
                                    	<button type="submit" class="btn btn-success">Change Password <i class="fa fa-download"></i></button>
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