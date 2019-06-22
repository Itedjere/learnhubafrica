<!DOCTYPE HTML>
<html>
<head>
<title>LearnHub Africa:: IT &amp; Entrepreneurship</title>
 <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>"  type="image/x-icon">
<meta name="description" content=" LearnHub is Africa's biggest community for learning Digital, Vocational & Entrepreneurial skills. Learn skills that will help you win big in tomorrow's future. We believe in giving everyone (especially in Africa) the opportunity to prepare for a quickly advancing Digital world by simplifying the process of knowledge and Digital Skill acquisition. " />
 
<meta name="keywords" content=" LearnHub, Africa, Learn, Education, Online, Edutech, MOOC, Nigeria, Community, Youth, Students, School, Academics, Web, Design, Services, Development, Software, Hardware,  Technology, Branding, Graphics, Media, ERP, Programming, Social Media, SEO,  Internet, Applications, Promotion, Marketing, Digital, Computer," />
<?php echo $metas; ?>
<?php echo $header; ?>

<!----- start-header---->
<div id="home" class="header">
	<!--<div class="overlay-wrapper"></div>-->
    <div class="top-header">
        <div class="container">
            <div class="logo">
            	<a href="<?php echo site_url(); ?>"><h1><span>Learn</span>Hub</h1></a>
            </div>
            <?php echo $main_subheader; ?>
        </div>
    </div>
<!--- banner Slider starts Here --->
    <script src="<?php echo base_url('assets/js/responsiveslides.min.js'); ?>"></script>
 <script>
    // You can also use "$(window).load(function() {"
    $(function () {
      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
          nav:false,
        speed: 1000,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });

    });
  </script>
<!----//End-slider-script---->
<!-- Slideshow 4 -->
    <div  id="top" class="callbacks_container">
      <ul class="rslides" id="slider4">
        <li>
          <div class="slider-top">
                <h2>Power of Knowledge </h2>
                <p>According to Alvin Toffler "The illiterates of the 21st century will not be those who cannot read and write, but those who cannot learn, unlearn and relearn." Get Digital &amp; Entrepreneurial Skills.</p>
                <h6>Join the Knowledge community...</h6>
          </div>
        </li>
        <li>
        <div class="slider-top">
                <h2>Empowered Future  </h2>
                <p>Tomorrow will only exist for those who prepare for it. Learn the skills you need for your personal development and entrepreneurial journey; Be a part of the Ecosystem for Creativity & Innovation. </p>
                <h6>A Future for Everyone... </h6>
          </div>
        </li>
       
       
      </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!----- //End-slider---->

<!----start-slide-bottom--->
<div class="slide-bottom">
    <div class="slide-bottom-grids">
         <div class="container">
             <div class="col-xs-12 col-md-6 slide-bottom-grid">
                    <h3>Welcome!</h3>
                    <p>LearnHub is Africa's biggest community for learning Digital, Vocational & Entrepreneurial skills. Learn skills that will help you win big in tomorrow's future. Join our community for free today! </p>
             </div>
             <div class="col-xs-12 col-md-6 slide-bottom-grid">
                   <h3>Our Goal</h3>
                   <p> Give everyone (especially in Africa) the opportunity to prepare for a quickly advancing Digital world  by simplifying the process of knowledge and Digital Skill acquisition.  </p>
             </div>
               <div class="clearfix"></div>
         </div>
     </div>
</div>
<!--services-->
<div class="service-section">
    <div class="col-md-7 service-section-grids">
            <div class="container">
              <div class="serve-head">
                  <h3>Our Core</h3>
                  <h6> A future for everyone...</h6>
              </div>
         	</div>
            <div class="service-grid">
                <div class="service-section-grid">
                    <div class="icon">
                        <i class="book"> </i>
                    </div>
                    <div class="icon-text">
                        <h4>DIGITAL SKILLS</h4>
                        <p>The dawn of the digital age has affected life, business and society in general. To survive & remain relevant, one needs to become a Digital Literate. Build digital skills for tomorrow.  </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="service-section-grid">
                    <div class="icon">
                        <i class="pencil"> </i>
                    </div>
                    <div class="icon-text">
                        <h4>ENTREPRENEURSHIP</h4>
                        <p>Entrepreneurs have the power to create results; they understand the challenges of moving from problems to ideas to innovative solutions. Nigeria – Africa needs more of such people.  </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="service-section-grid">
                    <div class="icon">
                        <i class="award"> </i>
                    </div>
                    <div class="icon-text">
                        <h4>LIFESTYLE</h4>
                        <p>Social Media, Gadgets, Fashion, Culture etc. have steadily evolved with the times, so there is need for right balancing of attitude towards Trends & lifestyle. 'Connect, Work & Play' </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            </div>
        <div class="col-md-5 service-text">
              <p></p>
        </div>
     <div class="clearfix"> </div>
</div>
<!--/services-->
<div class="news-section">
		<div class="container">
					<div class="news-head">
		               <h3>Projects</h3>
					   <p>Help more people develop Digital, Entreprenurial &amp; Positive Lifetsyle Skills...  </p>
					</div>
			<div class="news">
				<div class="col-md-4">
                	<div class="test-right01 test1">
                        <img src="<?php echo base_url('assets/images/9ja Green Arena -ICT_Today.jpg'); ?>" width="100%" alt="" />
                        <div class="textbox textbox1">
                            <h4 class="col-md-12 date">ICT FOUNDATIONZ (#ICT2dy)</h4>
                            <p class="col-md-12 news">A program designed to provide orientation on foundational understanding of ICT's/Digital Skills and how it affects everyday life.</p>
                            <!--<span class="readmore"><a href="http://localhost/9jagreenarena/project#pro1">Read More</a></span>-->
                            <div class="clearfix"> </div>
                        </div>
                    </div>
				</div>
				<div class="col-md-4">
					<div class="test-right01 test1">
                        <img src="<?php echo base_url('assets/images/9ja_Green_Arena_Female_Girls_Technology_Business_StartSmallToday.jpg'); ?>" width="100%" alt="" />
                        <div class="textbox textbox1">
                            <h4 class="col-md-12 date">START SMALL TODAY (#StartSmallToday)</h4>
                            <p class="col-md-12 news">Start Small Today is an Online event/seminar series designed to encourage young people Start a business even with limited resources...</p>
                            <!--<span class="readmore"><a href="http://localhost/9jagreenarena/project#pro2">Read More</a></span>-->
                            <div class="clearfix"> </div>
                        </div>
                    </div>
				</div>
				<div class="col-md-4">
					<div class="test-right01 test1">
                        <img src="<?php echo base_url('assets/images/9ja_Green_Arena_Female_Girls_Technology_Career4Today.jpg'); ?>" width="100%" alt="" />
                        <div class="textbox textbox1">
                            <h4 class="col-md-12 date">CAREER FOR TODAY (#Career4Today)</h4>
                            <p class="col-md-12 news">The Career For Today event is designed to provide career guidance, and mentorship for young people. </p>
                            <!--<span class="readmore"><a href="http://localhost/9jagreenarena/project#pro3">Read More</a></span>-->
                            <div class="clearfix"> </div>
                        </div>
                    </div>
				</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

<div class="featured-posts">
	<div class="container">
    	<div class="news-head">
           <h3>Our Blog</h3>
           <p>Get insightful posts across various categories from our blog... </p>
        </div>
    	<div class="col-sm-8">
        	<div class="blog-details margin-for-bottom">
            	<div class="post-pic-container">
                	<img src="<?php echo base_url('assets/images/blog/'.$featured_blog[0]['image']); ?>" width="100%" alt="<?php echo $featured_blog[0]['title']; ?>" >
                </div>
                <div class="transparent-post-title">
                	<a href="<?php echo site_url('blog/'. $featured_blog[0]['category_slug'] . '/' . $featured_blog[0]['slug']); ?>"><?php echo $featured_blog[0]['title']; ?></a>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
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
<div class="clearfix" style="padding-bottom:50px;"> </div>

<h1 class="headings">OUR COMMUNITY</h1>
<div class="bg_2">
  <div class="container">
     <div class="col-md-6 service_2-left">
          <h2>Knowledge Becomes More Powerful When It Is Shared!</h2>
     </div>
     <div class="col-md-6 service_2-right">
        <p>"Lifelong learning must now be a part of everyone's career plans." The LearnHub Business & Technology Facebook community is designed to provide an ecosystem for Knowledge sharing across a wide range of sectors. Connect with experts, share and collaborate on ideas, and most importantly become equipped with Digital Skils needed for tomorrows' future.</p>
        <a href="https://web.facebook.com/groups/LearnHub.Africa/" target="_blank">Join Now!</a>
     </div>
     <div class="clearfix"> </div>
  </div>
</div>

<!--<div class="courses">
	<div class="wrapper">
    	<h1 class="headings">TOP COURSES</h1>
    	<div class="col-xs-12 col-sm-6 col-md-4">
        	<div class="course">
            	<a href="#">
                	<div class="shadow">
                    	<div class="course_bgimg">
                        	<img src="<?php //echo base_url('assets/images/9jaGreenArena_DigitalSkills.jpg'); ?>" width="100%" alt="" >
                        	<div class="course_bg">
                            	<span>New!</span>
                            </div>
                        </div>
                        <div class="course_content">
                        	<h4>Digital Literacy - Basic </h4>
                            <p>This course will take you from level zero to a level where you become digitally literate & active. </p>
                        </div>
                        <div class="facilreadmore">
                        	<div class="facil">
                            	<ul>
                                	<li><img src="<?php //echo base_url('assets/images/s1.jpg'); ?>" height="25px" alt="" ></li>
                                    <li><img src="<?php //echo base_url('assets/images/s2.jpg'); ?>" height="25px" alt="" ></li>
                                </ul>
                                <p>2 Weeks</p>
                            </div>
                            <div class="read">
                            	<span>Learn More</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
        	<div class="course">
            	<a href="#">
                	<div class="shadow">
                    	<div class="course_bgimg">
                        	<img src="<?php //echo base_url('assets/images/9jaGreenArena_PC_Engineering.jpg'); ?>" width="100%" alt="" >
                        	<div class="course_bg">
                            	<span>New!</span>
                            </div>
                        </div>
                        <div class="course_content">
                        	<h4>PC Maintenance Engineering</h4>
                            <p>This course teaches the operations of a PC; how to trouble-shoot and fix both hardware & Software problems. </p>
                        </div>
                        <div class="facilreadmore">
                        	<div class="facil">
                            	<ul>
                                	<li><img src="<?php //echo base_url('assets/images/s3.jpg'); ?>" height="17px" alt="" ></li>
                                    <li><img src="<?php //echo base_url('assets/images/s5.jpg'); ?>" height="25px" alt="" ></li>
                                </ul>
                                <p>4 Weeks</p>
                            </div>
                            <div class="read">
                            	<span>Learn More</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
        	<div class="course">
            	<a href="#">
                	<div class="shadow">
                    	<div class="course_bgimg">
                        	<img src="<?php //echo base_url('assets/images/9jaGreenArena_Handcraft_Bead.jpg'); ?>" width="100%" alt="" >
                        	<div class="course_bg">
                            	<span>New!</span>
                            </div>
                        </div>
                        <div class="course_content">
                        	<h4>Fashion - HandCraft</h4>
                            <p>Bring out the creative and fashionista spirit in you.  Learn to Make professional dress and accessories. </p>
                        </div>
                        <div class="facilreadmore">
                        	<div class="facil">
                            	<ul>
                                	<li><img src="<?php //echo base_url('assets/images/s6.jpg'); ?>" height="25px" alt="" ></li>
                                    <li><img src="<?php //echo base_url('assets/images/s4.jpg'); ?>" height="25px" alt="" ></li>
                                </ul>
                                <p>3 Weeks</p>
                            </div>
                            <div class="read">
                            	<span>Learn More</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>-->

<!--<div class="culture-section">
    <div class="container">
             <div class="culture">
                        <div class="col-md-6 culture-grids">
                        <div class="culture-head">
                            <h3>Events</h3>
                        </div>
                          <a href="single.html"> <img src="<?php //echo base_url('assets/images/9jaGreenArena_Event_Warri_IT.jpg'); ?>" width="100%" alt="" /></a>
                            <div class="e_date">
                                 <h4>15<br> <span>Oct</span></h4>
                            </div>
                              <a href="http://updates.9jagreenarena.org/p/freestyle-arena.html" target="_blank"><h5>WARRI FOR IT (#WaFIT) MOVEMENT</h5></a>
                            <p>Can the famous Oil city of Warri become the IT capital of Nigeria? Can it lead cities such as Lagos, Abuja and Port Harcourt in innovation? This is the question the Warri For IT movement sets out to answer. 9jaGreenArena collaborates with the Warri For IT ( #WaFIT ) movement.  </p>
                        </div>
                        <div class="col-md-6 culture-grids">
                        <div class="culture-head">
                            <h3>Trending Blog Post</h3>
                        </div>
                            <a href="single.html"> <img src="<?php //echo base_url('assets/images/9jaGreenArena_7_Business_Tips.jpg'); ?>" width="100%" alt="" /></a>
                            <div class="e_date">
                                <h4>15<br> <span>March</span></h4>
                            </div>
                              <a href="http://updates.9jagreenarena.org/2017/03/how-to-manage-business-in-school.html" target="_blank"><h5>HOW TO MANAGE A BUSINESS IN SCHOOL</h5></a>
                            <p>The problem with education today is that, it leaves the student with little opportunity for starting or even managing a business while he or she is still embroiled in academic activities. Becoming Entrepreneurial is a very important skill to develop even while in school. </p>

                        </div>
                        <div class="clearfix"> </div>
                   </div>
             </div>
        </div>-->
<?php echo $footer; ?>
</body>
</html>