<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Learn Arena Blog :: Home</title>

<?php echo $blog_header; ?>
<?php echo $home_header; ?>

<div class="authors-banner-container">
	<div class="overlay"></div>
    <div class="container">
    	<div class="col-sm-12 text">
        	<h2>WAVELENGTH IPS BLOG</h2>
            <p>Get the latest insights and views on the power industry from our blog..</p>
        </div>
    </div>
    <div class="header-nav" id="showRightPush">
        <span class="menu-txt">MENU </span>
        <span class="menu-sandwhich"><span></span><span></span><span></span></span>
    </div>
</div>


<div class="featured-posts">
	<div class="container">
    	<div class="col-sm-8">
        	<div class="blog-details">
            	<div class="post-pic-container">
                	<img src="<?php echo base_url('assets/images/blog/'.$featured_blog[0]['image']); ?>" width="100%" alt="<?php echo $featured_blog[0]['title']; ?>" >
                </div>
                <div class="transparent-post-title">
                	<a href="<?php echo site_url('blog/'. $featured_blog[0]['category_slug'] . '/' . $featured_blog[0]['slug']); ?>"><?php echo $featured_blog[0]['title']; ?></a>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4 mobile-space-top">
        	<div class="blog-details bottom-margin-15px">
            	<div class="post-pic-container">
                	<img src="<?php echo base_url('assets/images/blog/'.$featured_blog[1]['image']); ?>" width="100%" alt="<?php echo $featured_blog[1]['title']; ?>" >
                </div>
                <div class="transparent-post-title">
                	<a href="<?php echo site_url('blog/'. $featured_blog[1]['category_slug'] . '/' . $featured_blog[1]['slug']); ?>"><?php echo $featured_blog[1]['title']; ?></a>
                    
                </div>
            </div>
            <div class="blog-details">
            	<div class="post-pic-container">
                	<img src="<?php echo base_url('assets/images/blog/'.$featured_blog[2]['image']); ?>" width="100%" alt="<?php echo $featured_blog[2]['title']; ?>" >
                </div>
                <div class="transparent-post-title">
                	<a href="<?php echo site_url('blog/'. $featured_blog[2]['category_slug'] . '/' . $featured_blog[2]['slug']); ?>"><?php echo $featured_blog[2]['title']; ?></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php if(count($blogMenusArray) > 0): ?>
<?php $c = 1; ?>
<?php for($x = 0; $x < count($blogMenusArray); $x++) { ?>
<?php $class_name = (($c%2) == 0) ? " white-bg" : " ash-grey-bg"; ?>
<div class="blog-category<?php echo $class_name; ?>">
	<div class="container">
    
    	<div class="col-sm-12 main-category-name">
        	<h3><a href="<?php echo site_url('blog/category/'.$blogMenusArray[$x][0]['category_slug']); ?>"><?php echo $blogMenusArray[$x][0]['category_name']; ?></a></h3>
        </div>
        
        <?php foreach($blogMenusArray[$x] as $blogArray) { ?>
    	<div class="col-xs-12 col-sm-6 col-md-4 bottom-margin-15px">
        	<div class="blog-details">
            	<div class="post-pic-container">
                	<a href="<?php echo site_url('blog/'.$blogArray['category_slug'].'/'.$blogArray['slug']); ?>">
                	<img src="<?php echo base_url('assets/images/blog/'. $blogArray['image']); ?>" width="100%" alt="<?php echo $blogArray['title']; ?>" >
                    </a>
                </div>
                <div class="post-date">
                	<span><i class="fa fa-clock-o"></i> <?php echo date('jS M Y', $blogArray['time']); ?></span>
                </div>
            </div>
            
            <div class="normal-post-title">
            	<a href="<?php echo site_url('blog/'.$blogArray['category_slug'].'/'.$blogArray['slug']); ?>"><?php echo strtoupper($blogArray['title']); ?></a>
            </div>
            
            <div class="post-author">
            	<a href="<?php echo site_url('author/'.$blogArray['author_slug']); ?>"><i class="fa fa-user"></i> &nbsp; <?php echo $blogArray['author_name']; ?></a>
            </div>
            
            <div class="post-description-snippet">
            	<?php echo character_limiter(strip_tags($blogArray['body']), 120); ?>
            </div>
            
            <div class="read-more">
            	<a href="<?php echo site_url('blog/'.$blogArray['category_slug'].'/'.$blogArray['slug']); ?>"><i class="fa fa-book"></i> Read More</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php $c++; ?>
<?php }; ?>
<?php endif; ?>


<?php echo $cta; ?>

<?php echo $footer; ?>


<?php echo $blog_footer; ?>
</body>
</html>
