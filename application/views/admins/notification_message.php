<!DOCTYPE html>
<html lang="en"><head>
<title>Blog Dashboard :: Notification Message</title>

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
                <h3><i class="fa fa-home"></i> <a href="<?php echo site_url('Admin/notification_list'); ?>">Blog Notifications</a> / Notification Message</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
            	
                <div class="x_panel container-space">
                    <div class="col-sm-12 x_content div_pad_12">
                            <div class="header-top-border">
                                <i class="fa fa-angle-double-right"></i> Notification List
                            </div>
                            <div class="content_body">
                            	<div class="row">
                                    <div class="col-md-12 notify">
                                        <h2>Name</h2>
                                        <p><?php echo $notification_details->firstName; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 notify">
                                        <h2>Phone</h2>
                                        <p><?php echo $notification_details->phone; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 notify">
                                        <h2>Email</h2>
                                        <p><?php echo $notification_details->email; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 notify">
                                        <h2>Message</h2>
                                        <p><?php echo $notification_details->message; ?></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>