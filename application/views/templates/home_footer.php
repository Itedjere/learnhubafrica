<!--address-->
	<div id="contact" class="address">
		<div class="col-md-7 gray-bg">
        	<div class="address-left">
                 <div class="products">
                     <h3>Quick Link</h3>
                     <ul>
                          <li><a href="<?php echo site_url(); ?>">Home</a></li>
                         <li><a href="<?php echo site_url('about_us'); ?>">About</a></li>
                         <li><a href="<?php echo site_url('contact_us'); ?>">Contact</a></li>
                     </ul>
                 </div>
                 <div class="company-adout">
                     <h3>LearnHub</h3>
                     <ul>
                         <li><a href="<?php echo site_url('blog'); ?>">Blog</a></li>
                         <li><a href="https://web.facebook.com/groups/LearnHub.Africa">Community</a></li>
                         <li><a href="#">Resource</a></li>
                     </ul>
                 </div>
                 <div class="clearfix"></div>
                 <p> LearnHub is Africa's fastest growing community for learning Digital, Vocational & Entrepreneurial skills.
                     LearnHub helps to simplify the process of knowledge and Digital Skill acquisition.
                </p>
            </div>
		</div>
		<div class="col-md-5 green-bg">
        	<div class="address-right">
                <h3>Get in Touch</h3>
                <p> ADDRESS: G4a Ck Value City Plaza,</p>
                <p>Warri, Delta State. </p>
                <p>Nigeria </p>
                <ul class="bottom">
                     <li>PHONE: +234 816 188 3397</li>
                     <li> +234 812 383 9501</li>
                     
                </ul>
                
                <ul class="social-icons">
                    <li class="fac"><a href="https://www.facebook.com/9jagreenarena" target="_blank"></a></li>
                    <li class="tw"><a href="https://twitter.com/9jagreenarena" target="_blank"></a></li>
                    <li class="yo"><a href="https://www.youtube.com/channel/UC3cZIxsxu1cwKvyE5WmcrlQ" target="_blank"></a></li>
                    <li class="go"><a href="https://www.google.com/+9jagreenarenaBlogspotGplusPage" target="_blank"></a></li>
                    <li class="li"><a href="https://www.linkedin.com/company/9jagreenarena" target="_blank"></a></li>
                </ul>
            </div>
		</div>
		<div class="clearfix"></div>
	</div>
	<!--//address-->
		<!----footer--->
			<div class="footer">
				<div class="container">
					<div class="copy">
		              <p>Copyright &copy; 2017 9jaGreenArena. All rights reserved | Developed by: <a href="http://linkorion.com" target="_blank">LinkOrion Technology</a></p>
		            </div>
					
				</div>
			</div>
	<!--start-smoth-scrolling-->
    		<script type="text/javascript" src="<?php echo base_url('assets/js/agentscript2.js'); ?>"></script>
			<script type="text/javascript">
								jQuery(document).ready(function($) {
									$(".scroll").click(function(event){		
										event.preventDefault();
										$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
									});
								});
								</script>
							<!--start-smoth-scrolling-->
						<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
		<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>