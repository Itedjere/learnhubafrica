<!DOCTYPE html>
<html class=" " lang="en"><head>
<title>LearnHub Africa :: Tags List</title>

<meta name="keywords" content="">
<meta name="description" content="">

<?php echo $header; ?>
   
<div class="right_col" role="main" style="min-height: 859px;">

    <div class="box_padding_all">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-home"></i> <a href="index.php">Dashboard</a> / Manage Tag List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	<div class="modal fade" id="bs-example-modal-sm2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        	<?php $attributes = array('role'	=>	'form'); ?>
							<?php echo form_open('Admin/delete_tag', $attributes); ?>
                            <!--<form action="Admin/delete_orders" method="POST">-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Delete Tag</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" value="" name="hidden_tag_id" id="hidden_tag_id">
                                     <p>Do You Wish To Delete Tag?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" name="add_testimony" class="btn btn-primary"><i class="fa fa-plus"></i> Yes, Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        	<?php $attributes = array('role'	=>	'form'); ?>
							<?php echo form_open('Admin/edit_tag', $attributes); ?>
                            <!--<form action="Admin/delete_orders" method="POST">-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Edit Tag Name</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="text" value="" name="edit_tag_name" id="edit_tag_name">
                                    <input type="hidden" name="edit_hidden_tag_id" id="edit_hidden_tag_id" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" name="add_testimony" class="btn btn-primary"><i class="fa fa-plus"></i> Edit Name</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            	
                <div class="x_panel container-space">
                    <!--<div class="x_title">
                        <h2>Add Brand</h2>
                        <div class="clearfix"></div>
                    </div>-->
                    <div class="col-sm-12 x_content div_pad_12">
                    	<div class="header-bottom-border">
                        	<form class="markets-insider-search" method="GET">
                                <input class="markets-insider-search-input" name="_search" value="" placeholder="Search For Tags" type="text">
                                <a href="#" class="markets-insider-search-submit"><i class="fa fa-search"></i></a>
                            </form>
                        </div>
                        <div class="content_body">
                        	<?php if ($total_num_rows > 0): ?>
                            	<?php foreach($tags as $tag): ?>
                                    <span class="tag_container">
                                        <a href="#" class="edit_tags"><?php echo $tag->tag_name; ?></a>
                                        <a href="#" class="delete_tags"><i class="fa fa-times"></i></a>
                                        <input type="hidden" name="tag_id" value="<?php echo $tag->id; ?>" id="tag_id">
                                    </span>
                            	<?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>