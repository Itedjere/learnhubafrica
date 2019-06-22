<!DOCTYPE html>
<html class=" " lang="en"><head>
<title>Manage Administrative Staffss</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admin'); ?>">Home</a> / Admins</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	<div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
							<?php echo form_open('Admin/delete_property'); ?>
                            <!--<form action="" name="testimony_form" method="POST">-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Delete Admin</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" value="" name="delete-property-id">
                                    <input type="hidden" value="" name="table">
                                     <p>Do You Wish Delete This Admin?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" name="add_testimony" class="btn btn-primary"><i class="fa fa-plus"></i> Delete Admin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="x_panel container-space">
                    <div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span><?php echo $total_num_admins; ?></span>
                            <p>Total Number Of Admin Staffs</p>
                            <a href="<?php echo site_url('Admin/create_admin'); ?>" class="btn btn-success btn-md"> <i class="fa fa-plus"></i> Create New Admin</a>
                        </div>
                    </div>
                    <!--<div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span></span>
                            <p>Total Number Of Admin Staffs</p>
                        </div>
                    </div>-->
                    <div class="col-sm-12 x_content div_pad_12">
                        <div class="header-top-border">
                            <i class="fa fa-angle-double-right"></i> Administrative Staffs
                        </div>
                        <div class="content_body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 20%">Username</th>
                                        <th style="width: 20%">Phone</th>
                                        <th style="width: 20%">Email</th>
                                        <th style="width: 10%">Delete</th>
                                    </tr>
                                </thead>
                                <?php if ($total_num_admins > 0): ?>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($admins as $admin_details):
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td> <?php echo $admin_details->username; ?></td>
                                        <td> <?php echo $admin_details->phone; ?></td>
                                        <td> <?php echo $admin_details->email; ?></td>
                                        <td>
                                        <form action="" name="">
                                            <input type="hidden" name="property_id" value="<?php echo $admin_details->id; ?>">
                                            <input type="hidden" name="table_name" value="admin">
                                            <button type="submit" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#bs-example-modal-sm"><i class="fa fa-exclamation-triangle"></i> Delete </button>
                                        </form>
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                    endforeach;
                                    ?>
                                     
                                </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>