<!DOCTYPE HTML>
<html>
<head>
<title>9ja Green Arena :: IT &amp; Entrepreneurship </title>
<meta name="description" content=" We are one of the best IT and business servicing company in Warri, Delta state Nigeria. We satisfy our customers with professional services in the areas of Web design/development, Digital marketing, Software (ERP/Web applications), Branding and Business development services. " /> 
<meta name="keywords" content=" Web, Design, Services, Development, Software, Hardware, Solution, Technology, Branding, Graphics, Media, ERP, Programming, Social Media, SEO, Online, Internet, Presence, Applications, Promotion, Marketing, Digital, SEM, Reputation, Computer, ICT, Warri, Delta, Nigeria, Best, Top, Leading, Content, LinkOrionTech, LinkOrion" />

<?php echo $metas; ?>

<?php echo $header; ?>
<!--start-home-->
<!----- start-header---->
<div id="home" class="header two">
        <div class="top-header two">	
            <div class="container">
            <div class="logo">
                <a href="<?php echo site_url(); ?>"><h1><span>9ja</span>Green<span>Arena</span></h1></a>
            </div>
        	<?php echo $main_subheader; ?>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!----- //End-slider---->
<div class="login-wrapper">
	<div class="container">
    	<div class="col-sm-offset-4 col-sm-4">
			<?php
                if (isset($login_error_message)) {
                    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo $login_error_message;
                    echo '</div>';
                }
            ?>
            <?php echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4 col-sm-offset-4">
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form'); ?>
            <?php echo form_open('Admin/login', $attributes); ?>
                <div class="form-group">
                    <label for="email">Username:</label>
                    <input type="text" name="username" class="form-control" id="email" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                </div>
                <div class="form-group">
                        <div class="checkbox">
                          <label><input type="checkbox" name="remember" value="YES"> Remember me</label>
                        </div>
                </div>
                <div class="form-group">        
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
	<?php echo $footer; ?>
</body>
</html>