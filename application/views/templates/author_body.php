<?php echo $home_header; ?>

<div class="authors-banner-container author-bg">
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

<div class="authors-profile-details">
	<div class="container">
    	<div class="col-s-12">
        	<h2>ABOUT AUTHOR</h2>
        </div>
    	<div class="col-sm-3">
        	<div class="authors-rounded-pic">
            	<img src="<?php echo base_url('assets/images/author/'.$singleAuthor[0]['author_pic']); ?>" width="100%" alt="description" >
            </div>
        </div>
        <div class="col-sm-9 centred-pos">
        	<h3><?php echo $singleAuthor[0]['author_name']; ?></h3>
            <p><?php echo $singleAuthor[0]['author_biography']; ?></p>
            <ul>
            	<li><a href="<?php echo $singleAuthor[0]['facebook']; ?>" target="<?php echo ($singleAuthor[0]['facebook'] == '#') ? '_self' : '_blank'; ?>">
                <i class="fa fa-facebook"></i></a></li>
                <li><a href="<?php echo $singleAuthor[0]['twitter']; ?>" target="<?php echo ($singleAuthor[0]['twitter'] == '#') ? '_self' : '_blank'; ?>">
                <i class="fa fa-twitter"></i></a></li>
                <li><a href="<?php echo $singleAuthor[0]['linkedin']; ?>" target="<?php echo ($singleAuthor[0]['linkedin'] == '#') ? '_self' : '_blank'; ?>">
                <i class="fa fa-linkedin"></i></a></li>
                <li><a href="<?php echo $singleAuthor[0]['instagram']; ?>" target="<?php echo ($singleAuthor[0]['instagram'] == '#') ? '_self' : '_blank'; ?>">
                <i class="fa fa-instagram"></i></a></li>
            </ul>
            <div class="authors_website">
            	<a href="<?php echo $singleAuthor[0]['website']; ?>" target="<?php echo ($singleAuthor[0]['website'] == '#') ? '_self' : '_blank'; ?>">Visit Website <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="authors-post ash-grey-bg">
	<div class="container">
    	<div class="col-sm-12">
        	<h2>AUTHOR'S POSTS</h2>
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