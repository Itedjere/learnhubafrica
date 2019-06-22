<!DOCTYPE html>
<html lang="en"><head>
<title>Blog Dashboard :: Manage Blog List</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>


<!-- The Modal -->
<div id="myModal" class="img_modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admins'); ?>">Blog Dashboard</a> / Blogs List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	<div class="modal fade" tabindex="-1" id="bs-example-modal-sm" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        	<?php $attributes = array('role'	=>	'form'); ?>
							<?php echo form_open('Admin/delete_blogs', $attributes); ?>
                            <!--<form action="Admin/delete_orders" method="POST">-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Delete Blog(s)</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" value="" name="hidden_order_ids" id="hidden_order_ids">
                                     <p>Do You Wish Delete?</p>
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
                        	<span><?php echo $total_num_rows; ?></span>
                            <p>Total Number of Blogs</p>
                            <a href="<?php echo site_url('Admin/create_blog/'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Blog</a>
                        </div>
                    </div>
                    <div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span><?php echo $total_num_tags; ?></span>
                            <p>Total Number Of Tags</p>
                            <a href="<?php echo site_url('Admin/add_tag/'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Tags</a>
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
                                            <th style="width: 10%"></th>
                                            <th style="width: 10%">Banner</th>
                                            <th style="width: 50%">Title</th>
                                            <th style="width: 10%">Date</th>
                                            <th style="width: 10%">Feature?</th>
                                            <th style="width: 10%">Option</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php if ($total_num_rows > 0): ?>
                                    <?php $x = 1; ?>
                                    <tbody>
                                    	<?php foreach($blogs as $blog): ?>
                                        <tr>
                                            <td class="text-center">
                                            	<input type="checkbox" name="orderId" id="checkbox-nested-<?php echo $blog->id; ?>" value="<?php echo $blog->id; ?>" class="beautiful-checkbox">
                                            	<label for="checkbox-nested-<?php echo $blog->id; ?>" class="beautiful-label-for-checkbox"></label>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url('assets/images/blog/' . $blog->image); ?>" width="50" height="50" onClick="popupimage(this)" alt="<?php echo $blog->title; ?>" style="cursor: pointer;">
                                            </td>
                                            <td><?php echo $blog->title; ?> </td>
                                            <td>
                                            <?php 
											echo date('jS M Y', $blog->time);
											?>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="featuredId" id="best-<?php echo $blog->id; ?>" value="blog|featured|<?php echo $blog->id; ?>" class="featured-checkbox" onChange="featureBlogOrNot(this)" <?php echo ($blog->featured == "yes") ? "checked" : ""; ?> >
                                                <label for="best-<?php echo $blog->id; ?>" class="featured-label-for-checkbox"></label>
                                                </td>
                                            <td class="text-center"><a href="<?php echo site_url('Admin/edit_blog/'.$blog->id); ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
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
                          <strong>Info!</strong> No Blog Item Added Yet.
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