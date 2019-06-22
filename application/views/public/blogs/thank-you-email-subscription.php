<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Learn Arena Blog :: Single Blog</title>


<?php echo $blog_header; ?>


<?php echo $home_header; ?>

<div class="authors-banner-container">
	<div class="overlay"></div>
    <div class="container">
    	<div class="col-sm-12 thankyou">
        	<h2>THANK YOU FOR SUBSCRIBING</h2>
        </div>
        <div class="col-sm-12 join_facebook_title">
            <div class="bottom-margin-15px">
                <h3>JOIN OUR FACEBOOK COMMUNITY</h3>
            </div>
            
            <div class="join_facebook_link">
                <a href="#">JOIN US</a>
            </div>
        </div>
        <div class="col-sm-12 social-icons-follow">
            <span>Stay in touch with us on : </span>
            <ul>
                <li><a href="https://web.facebook.com/WavelengthIPS" target="_blank" class="twitter"><i class="fa fa-facebook"></i> </a></li>
                <li><a href="https://twitter.com/Wavelength_IPS" target="_blank" class="facebook"><i class="fa fa-twitter"></i> </a></li>
                <li><a href="https://www.linkedin.com/organization/11105150" target="_blank" class="google"><i class="fa fa-linkedin"></i> </a></li>
                <li><a href="https://plus.google.com/u/5/b/100035423056604288829" target="_blank" class="google"><i class="fa fa-google-plus"></i> </a></li>
                <li><a href="https://www.youtube.com/channel/UCsW5DWVhRMumB2vakIMN2Lg " target="_blank" class="google"><i class="fa fa-youtube"></i> </a></li>
            </ul>
        </div>
    </div>
    <div class="header-nav" id="showRightPush">
        <span class="menu-txt">MENU </span>
        <span class="menu-sandwhich"><span></span><span></span><span></span></span>
    </div>
</div>

<div class="single-blog-wrapper">
	<div class="container">
        <div class="col-sm-12">
        	<div class="exciting-blogs">
                <h3>READ MORE EXCITING STUFFS FROM OUR BLOG</h3>
                <div class="the-recommendeds">
                	
                    <div class="col-sm-3">
                        <a href="<?php echo site_url('blog/' . $current_blog['category_slug']. '/'. $current_blog['slug']); ?>">
                            <img src="<?php echo base_url('assets/images/blog/' . $current_blog['image']); ?>" width="100%" alt="">
                            <p><?php echo $current_blog['title']; ?></p>
                        </a>
                    </div>
                    
                    <?php foreach($other_blogs as $other_blog): ?>
                    <div class="col-sm-3">
                        <a href="<?php echo site_url('blog/' . $other_blog['category_slug']. '/'. $other_blog['slug']); ?>">
                            <img src="<?php echo base_url('assets/images/blog/' . $other_blog['image']); ?>" width="100%" alt="">
                            <p><?php echo $other_blog['title']; ?></p>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo $footer; ?>


<?php echo $blog_footer; ?>
</body>
</html>
