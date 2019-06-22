<!DOCTYPE html>
<html lang="en"><head>
<title>Blog Dashboard :: Notification List</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admin/'); ?>">Blog Dashboard</a> / Notification List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	<div class="modal fade" tabindex="-1" id="bs-example-modal-sm" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        	<?php $attributes = array('role'	=>	'form'); ?>
							<?php echo form_open('Admin/delete_notifications', $attributes); ?>
                            <!--<form action="Admin/delete_orders" method="POST">-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Delete Notification(s)</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" value="" name="hidden_order_ids" id="hidden_order_ids">
                                     <p>Do You Wish To Delete?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" name="add_testimony" class="btn btn-primary"><i class="fa fa-plus"></i> Yes, Delete</button>
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
                        	<span><?php echo $total_num_category; ?></span>
                            <p>Total Number of Category</p>
                            <a href="<?php echo site_url('Admin/add_category'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Category</a>
                        </div>
                    </div>
                    <div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span><?php echo $total_num_blogs; ?></span>
                            <p>Total Number Of Blogs</p>
                            <a href="<?php echo site_url('Admin/create_blog'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Blog</a>
                        </div>
                    </div>
                    <div class="col-sm-12 x_content div_pad_12">
                    	<form role="form" name="orders">
                            <div class="header-top-border">
                                <div class="col-sm-4">
                                	<i class="fa fa-angle-double-right"></i> Blog List
                                </div>
                                <div class="col-sm-4">
                                	<div id="showloadingicon" style="display: none; color: #F00;">
                                        <img src="<?php echo base_url('assets/images/loading.gif'); ?>" width="32" height="32" />
                                        Submitting Your Request To The Server...
                                    </div>
                                </div>
                                <div class="col-sm-4" style="text-align: right;">
                                	<a href="#" id="delete_orders" class="btn btn-danger btn-xs" style="float: right;">Delete</a>
                                </div>
                            </div>
                            <div class="content_body">
                            	<table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%">ID</th>
                                            <th style="width: 20%">Name</th>
                                            <th style="width: 15%">Phone</th>
                                            <th style="width: 15%">Email</th>
                                            <th style="width: 10%">Time</th>
                                            <th style="width: 10%">View</th>
                                        </tr>
                                    </thead>
                                    <?php if ($total_num_rows > 0): ?>
                                    <?php $x = 1; ?>
                                    <tbody>
                                        <?php foreach($notifications as $category): ?>
                                        <tr>
                                            <td class="text-center">
                                            	<input type="checkbox" name="orderId" id="checkbox-nested-<?php echo $category->id; ?>" value="<?php echo $category->id; ?>" class="beautiful-checkbox">
                                            	<label for="checkbox-nested-<?php echo $category->id; ?>" class="beautiful-label-for-checkbox"><?php echo $x; ?></label>
                                            </td>
                                            <td><?php echo $category->firstName; ?></td>
                                            <td><?php echo $category->phone; ?></td>
                                            <td><?php echo $category->email; ?></td>
                                            <td><?php echo date('jS M Y', $category->time); ?></td>
                                            <td class="text-center"><a href="<?php echo site_url('Admin/view_notification/'.$category->id); ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php $x++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
						</form>
                        <?php if ($total_num_rows == 0): ?>
                        <div class="alert alert-info">
                          <strong>Info!</strong> Notification Has Not Been Received Yet.
                        </div>
                        <?php endif; ?>
                        
                        <div class="col-sm-12" id="total_food_item_found">
                            <p class="category-pagination-sign"><?php echo $total_num_rows;  ?> result found.
                            Showing Page <?php echo $page_num; ?> of <?php echo $total_num_pages; ?>. <br>
                            Page is Grouped in 10</p>
                        </div>
                        <div class="col-sm-12">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>