<!DOCTYPE html>
<html lang="en"><head>
<title>Blog Dashboard :: Manage Authors' List</title>

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
                <h3><i class="fa fa-home"></i> <a href="index.php">Blog Dashboard</a> / <a href="#">Authors List</a></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	<div class="modal fade" tabindex="-1" id="bs-example-modal-sm" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        	<?php $attributes = array('role'	=>	'form'); ?>
							<?php echo form_open('Admin/delete_authors', $attributes); ?>
                            <!--<form action="Admin/delete_orders" method="POST">-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Delete Author(s)</h4>
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
                        	<span><?php echo $total_num_rows; ?></span>
                            <p>Total Number of Authors</p>
                            <a href="<?php echo site_url('Admin/add_author'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Authors</a>
                        </div>
                    </div>
                    <div class="col-sm-6 show_items header-div-6">
                    	<div class="col-xs-2">
                        	<i class="fa fa-android"></i>
                        </div>
                        <div class="col-xs-10">
                        	<span><?php echo $total_num_tags; ?></span>
                            <p>Total Number Of Tags</p>
                            <a href="<?php echo site_url('Admin/add_tag'); ?>" class="btn btn-success btn-md"> <i class="fa fa-eye"></i> Add New Tags</a>
                        </div>
                    </div>
                    <div class="col-sm-12 x_content div_pad_12">
                    	<form role="form" name="orders">
                            <div class="header-top-border">
                                <i class="fa fa-angle-double-right"></i> Authors List
                                <a href="#" id="delete_orders" class="btn btn-danger btn-xs" style="float: right;">Delete</a>
                            </div>
                            <div class="content_body">
                            	<table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%"></th>
                                            <th style="width: 20%">Name</th>
                                            <th style="width: 12%">Pic/Bio</th>
                                            <th style="width: 12%">Facebook</th>
                                            <th style="width: 12%">Twitter</th>
                                            <th style="width: 12%">LinkedIn</th>
                                            <th style="width: 12%">Website</th>
                                            <th style="width: 10%">Option</th>
                                        </tr>
                                    </thead>
                                    <?php if ($total_num_rows > 0): ?>
                                    <?php $x = 1; ?>
                                    <tbody>
                                    	<?php foreach($authors as $author): ?>
                                        <tr>
                                            <td class="text-center">
                                            	<input type="checkbox" name="orderId" id="checkbox-nested-<?php echo $author->author_id; ?>" value="<?php echo $author->author_id; ?>" class="beautiful-checkbox">
                                            	<label for="checkbox-nested-<?php echo $author->author_id; ?>" class="beautiful-label-for-checkbox"></label>
                                            </td>
                                            <td><?php echo $author->author_name; ?></td>
                                            <td>
                                                <img src="<?php echo base_url('assets/images/author/'.$author->author_pic); ?>" width="50" height="50" alt="<?php echo $author->author_biography; ?>" style="cursor: pointer;" onClick="popupimage(this)">
                                            </td>
                                            <td><a href="<?php echo $author->facebook; ?>" target="<?php echo ($author->facebook == '#') ? '_self' : '_blank'; ?>" class="btn btn-default btn-xs">View</a></td>
                                            <td><a href="<?php echo $author->twitter; ?>" target="<?php echo ($author->facebook == '#') ? '_self' : '_blank'; ?>" class="btn btn-default btn-xs">View</a></td>
                                            <td><a href="<?php echo $author->linkedin; ?>" target="<?php echo ($author->facebook == '#') ? '_self' : '_blank'; ?>" class="btn btn-default btn-xs">View</a></td>
                                            <td><a href="<?php echo $author->website; ?>" target="<?php echo ($author->facebook == '#') ? '_self' : '_blank'; ?>" class="btn btn-default btn-xs">View</a></td>
                                            <td class="text-center"><a href="<?php echo site_url('Admin/edit_author/'.$author->author_id); ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Edit</a></td>
                                        </tr>
                                        <?php $x++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>