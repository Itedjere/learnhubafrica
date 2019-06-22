<?php echo $home_header; ?>

<div class="authors-banner-container" style="background-image: url(<?php echo base_url('assets/images/category/'.$singleCategory[0]['category_banner']); ?>);">
	<div class="overlay"></div>
    <div class="container">
    	<div class="col-sm-12 text">
        	<h2><?php echo strtoupper($singleCategory[0]['category_name']); ?></h2>
            <p><?php echo $singleCategory[0]['category_description']; ?></p>
        </div>
    </div>
    <div class="header-nav" id="showRightPush">
        <span class="menu-txt">MENU </span>
        <span class="menu-sandwhich"><span></span><span></span><span></span></span>
    </div>
</div>

<div class="blog-category">
	<div class="container">
    
    	<div class="col-sm-12 main-category-name">
        	<h3><?php echo $singleCategory[0]['category_name']; ?></h3>
        </div>
        
        <?php if(count($singleCategory) > 0): ?>
        <?php foreach($singleCategory as $singleCat): ?>
    	<div class="col-xs-12 col-sm-6 col-md-4 bottom-margin-30px">
        	<div class="blog-details">
            	<div class="post-pic-container">
                <a href="<?php echo site_url('blog/'.$singleCat['category_slug'].'/'.$singleCat['slug']); ?>">
                	<img src="<?php echo base_url('assets/images/blog/'. $singleCat['image']); ?>" width="100%" alt="<?php echo $singleCat['title']; ?>" >
                    </a>
                </div>
                <div class="post-date">
                	<span><i class="fa fa-clock-o"></i> <?php echo date('jS M Y', $singleCat['time']); ?></span>
                </div>
            </div>
            
            <div class="normal-post-title">
            	<a href="<?php echo site_url('blog/'.$singleCat['category_slug'].'/'.$singleCat['slug']); ?>"><?php echo strtoupper($singleCat['title']); ?></a>
            </div>
            
            <div class="post-author">
            	<a href="<?php echo site_url('blog/author/'.$singleCat['author_slug']); ?>"><i class="fa fa-user"></i> &nbsp; <?php echo $singleCat['author_name']; ?></a>
            </div>
            
            <div class="post-description-snippet">
            	<?php echo character_limiter(strip_tags($singleCat['body']), 120); ?>
            </div>
            
            <div class="read-more">
            	<a href="<?php echo site_url('blog/'.$singleCat['category_slug'].'/'.$singleCat['slug']); ?>"><i class="fa fa-book"></i> Read More</a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
</div>

<?php echo $cta; ?>