<?php echo $home_header; ?>

<div class="authors-banner-container" style="background-image: url(<?php echo base_url('assets/images/category/'.$singleBlog['category_banner']); ?>);">
	<div class="overlay"></div>
    <div class="container">
    	<div class="col-sm-12 text">
        	<h2><?php echo strtoupper($singleBlog['category_name']); ?></h2>
            <p><?php echo $singleBlog['title']; ?></p>
        </div>
    </div>
    <div class="header-nav" id="showRightPush">
        <span class="menu-txt">MENU </span>
        <span class="menu-sandwhich"><span></span><span></span><span></span></span>
    </div>
</div>

<div class="email-overlay-wrapper" id="email_overlay_wrapper">
	<div class="close_modal_overlay"></div>
	<div class="container" id="the_modal_container">
    	<div class="email-inner-container" id="email_inner_container">
        	<div class="col-sm-12 email-title bottom-margin-30px">
            	<p>Enhance your Digital Skills with this <em>FREE</em> E-book. Get started from basics while also learning Expert Computer Tips.</p>
            </div>
            <div class="col-sm-4 learnhub-logo">
            	<img src="<?php echo base_url('assets/images/LinkOrionTech_Logo_Social_Media_Company3.png'); ?>" width="220" alt="">
            </div>
            <div class="col-sm-8 email-form">
            	<p>Enter your 'Email' and click 'Confirm' to get copy.</p>
				<?php $attributes = array('id' => 'subscriber_form', 'role'	=>	'form'); ?>
                <?php echo form_open('blog/thank_you_for_subscribing', $attributes); ?>
                 <!--<form role="form">-->
                    <div class="form-group">
                    	<input type="email" placeholder="Enter Your Email" class="form-control" id="email_address" name="email_address">
                        <input type="hidden" name="this_blog_id" value="<?php echo $singleBlog['id']; ?>">
                        <span class="email-format-indicator" id="email_format_indicator"></span>
                    </div>
                    <input type="submit" disabled name="submit_email" id="submit_email" value="Yes, I want it. Confirm!" >
				</form>
            </div>
            <div class="close-modal">
                <a href="#" id="close_the_modal"><i class="fa fa-times" arial-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>



<div class="single-blog-wrapper">
	<div class="container">
    	<div class="col-sm-8">
        	<div class="single-blog-content">
            	<div class="single-blog-title bottom-margin-15px">
                	<h1><?php echo $singleBlog['title']; ?></h1>
                </div>
                
                <div class="single-blog-author">
                	<div class="author-pic">
                    	<a href="<?php echo site_url('blog/author/' . $singleBlog['author_slug']); ?>">
                    	<img src="<?php echo base_url('assets/images/author/' . $singleBlog['author_pic']); ?>" width="100%" alt="" >
                        </a>
                    </div>
                    <div class="name-date">
                    	<p class="name"><a href="<?php echo site_url('blog/author/' . $singleBlog['author_slug']); ?>"><?php echo $singleBlog['author_name']; ?></a></p>
                        <p class="date"><?php echo date('jS M Y', $singleBlog['time']); ?></p>
                    </div>
                </div>
                <div class="blog-photo">
                    <img src="<?php echo base_url('assets/images/blog/' . $singleBlog['image']); ?>" width="100%" alt="<?php echo $singleBlog['title']; ?>" >
                </div>
                <div class="blog-contents">
                    <?php echo $singleBlog['body']; ?>
				</div>
                <div class="shareaholic-canvas" data-app="share_buttons" data-app-id="27867577"></div>
                
                <div class="post-tags">
                	<p>
                    	<span>Related Tags:</span>
                        <?php foreach($tags as $tag): ?>
                        <a href="<?php echo site_url('search/?tag=' . $tag['tag_name']); ?>"><?php echo $tag['tag_name']; ?></a>
                        <?php endforeach; ?>
                    </p>
                </div>
                
                <!--FB Comments Start-->
				<div class="facebook_comment">
				
                    <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-width="100%" data-numposts="7"></div>
				</div>
                <!--FB Comments Ends-->
                
                <div class="recommended-posts">
                	<h3 class="headings-with-border">Recommended For You</h3>
                    <div class="the-recommendeds">
                    	<?php if (count($recommended_blogs) > 0): ?>
                        <?php foreach($recommended_blogs as $recommended_blog): ?>
                        <div class="col-sm-3">
                            <a href="<?php echo site_url('blog/'.$recommended_blog['category_slug'].'/'.$recommended_blog['slug']); ?>">
                                <img src="<?php echo base_url('assets/images/blog/' . $recommended_blog['image']); ?>" width="100%" alt="<?php echo $recommended_blog['title']; ?>">
                                <?php echo $recommended_blog['title']; ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="category-section">
            	<h3 class="headings-with-border">Categories</h3>
                <?php foreach($categories as $category): ?>
            	<div class="the-categories">
                	<div class="category-pic">
                    	<a href="<?php echo site_url('blog/category/' . $category['category_slug']); ?>">
                        	<img src="<?php echo base_url('assets/images/category/' . $category['category_banner']); ?>" width="100%" alt="describe">
                        </a>
                    </div>
                    <div class="category-name">
                    	<p><a href="<?php echo site_url('blog/category/' . $category['category_slug']); ?>"><?php echo $category['category_description']; ?></a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="category-section">
            	<h3 class="headings-with-border">More Posts</h3>
            	<?php foreach($recent_blogs as $recent_blog): ?>
            	<div class="the-categories">
                	<div class="category-pic">
                    	<a href="<?php echo site_url('blog/'.$recent_blog['category_slug'].'/'.$recent_blog['slug']); ?>">
                        	<img src="<?php echo base_url('assets/images/blog/' . $recent_blog['image']); ?>" width="100%" alt="<?php echo $recent_blog['title']; ?>">
                        </a>
                    </div>
                    <div class="category-name">
                    	<p><a href="<?php echo site_url('blog/'.$recent_blog['category_slug'].'/'.$recent_blog['slug']); ?>"><?php echo $recent_blog['title']; ?></a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!--Free Guide Subscciption Start-->
            <div class="free-guide">
            	<h3 class="headings-with-border">Digital Foundation <br /> (GET FREE EBOOK) </h3>
                <p>Enhance your Digital/Computer Skills. This free e-book gets you started from the basics while also providing tips that even experts will find invaluable. </p>
                <a href="#" id="show_the_email_modal">Get It Now</a>
            </div>
            <!--Free Guide Subscription SEnds Here-->
            
            <?php echo $advert_page; ?>
            
            <!--Email Subscription Starts Here-->
            <div class="email-subscription">
            	<h3 class="headings-with-border">Don't Miss Out!</h3>
                <p>Get the latest updates, reports and plenty of freebies delivered right into your email when you subscribe. </p>
                <?php $attributes = array('class' => 'markets-insider-search'); ?>
                <?php echo form_open('blog/thank_you_for_subscribing', $attributes); ?>
                <!--<form class="markets-insider-search" method="GET" action="http://markets.businessinsider.com/searchresults?">-->
                    <input class="markets-insider-search-input" name="email_address" placeholder="Enter Your Email Address" type="text">
                    <input type="hidden" name="this_blog_id" value="<?php echo $singleBlog['id']; ?>">
                    <input type="submit" disabled class="markets-insider-search-submit" id="markets-insider-search-submit" value="SUBSCRIBE NOW">
                </form>
            </div>
            <!--Email Subscription Ends Here-->
            
           
            
        </div>
    </div>
</div>

<?php echo $cta; ?>