<?php echo $home_header; ?>

<div class="search-banner-container">
	<div class="overlay"></div>
    <div class="container">
    	<div class="col-sm-12 text">
        	<h2>LEARNHUB IPS BLOG</h2>
            <p>Get the latest insights and views on the power industry from our blog..</p>
        </div>
    </div>
    <div class="header-nav" id="showRightPush">
        <span class="menu-txt">MENU </span>
        <span class="menu-sandwhich"><span></span><span></span><span></span></span>
    </div>
</div>

<div class="authors-post ash-grey-bg">
	<div class="container">
    	<div class="col-sm-12">
        	<h2>SEARCH RESULT FOR <em><?php echo strtoupper($tag_name); ?></em></h2>
        </div>
        <div class="col-sm-12 all-authors-posts">
        	<?php foreach($singleAuthor as $singleAut) : ?>
        	<div class="col-xs-12 col-sm-6 col-md-4 bottom-margin-30px">
            	<div class="post-pic-container">
            		<a href="<?php echo site_url('blog/' . $singleAut['category_slug'] . '/' . $singleAut['slug']); ?>"><img src="<?php echo base_url('assets/images/blog/' . $singleAut['image']); ?>" width="100%" alt="description"></a>
                </div>
                <p><a href="<?php echo site_url('blog/' . $singleAut['category_slug'] . '/' . $singleAut['slug']); ?>"><?php echo $singleAut['title']; ?></a></p>
            </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>
<?php echo $cta; ?>