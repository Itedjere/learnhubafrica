<!DOCTYPE HTML>
<html>
<head>

<title>Contact :: LearnHub.Africa </title>
<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>"  type="image/x-icon">


<meta name="description" content=" Contact LearnHub.Africa. We are Africa's fastest growing community for learning Digital, Vocational & Entrepreneurial skills. We believe in giving everyone (especially in Africa) the opportunity to prepare for a quickly advancing Digital world by simplifying the process of knowledge and Digital Skill acquisition. " />
 
<meta name="keywords" content=" Contact, LearnHub, Africa, Learn, Education, Online, Edutech, MOOC, Nigeria, Community, Youth, Students, School, Academics, Web, Design, Services, Development, Software, Hardware,  Technology, Branding, Graphics, Media, ERP, Programming, Social Media, SEO,  Internet, Applications, Promotion, Marketing, Digital, Computer " />

<?php echo $metas; ?>
<?php echo $header; ?>
<!--start-home-->
<!----- start-header---->
<div id="home" class="header two">
        <div class="top-header two">	
            <div class="container">
            <div class="logo">
                <a href="<?php echo site_url(); ?>"><h1><span>Learn</span>Hub</h1></a>
            </div>
        	<?php echo $main_subheader; ?>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!----- //End-slider---->
<!---start-slide-bottom--->
	 <div class="contact">
	 	<div class="container">
        <div class="contact-head">
            <h3>Get In Touch</h3>
            <p>Drop us a message.. </p>
        </div>
		<div class="contact-top">
		     <div class="col-sm-12 col-md-6">
             	<div class="contact-text">
                	<div class="cont-grid">
                        <div class="con-icon">
                            <i class="loca"> </i>
                        </div>
                        <div class="con-text">
                            <h4>ADDRESS</h4>
                            <p>G4a Ck Value City Plaza,
                                Delta State.
                                Nigeria </p>
                            <p>0009 123 456</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="cont-grid">
                        <div class="con-icon">
                            <i class="net"> </i>
                        </div>
                        <div class="con-text">
                            <h4>PHONE</h4>
                            <p>+234 816 188 3397</p>
                            
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="cont-grid">
                        <div class="con-icon">
                            <i class="mail"> </i>
                        </div>
                        <div class="con-text">
                            <h4>M@IL US</h4>
                            <p><a href="mailto:example@mail.com">hello@learnhub.africa</a></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
			 </div>
			 <div class="col-sm-12 col-md-6">
                 <div class="contact-form">
                 	 <?php
						if (isset($error) && !empty($error)) {
							echo $error;
						}
					?>
					<?php echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); ?>
					<?php echo form_open('contact_us', 'id="contactForm"'); ?>
                        <input type="text" class="textbox" name="firstName" placeholder="Name" >
                        <input type="text" class="textbox" name="userEmail" placeholder="Email" >
                        <input type="text" class="textbox" name="userPhone" placeholder="Phone" >
                        <textarea name="userMessage"></textarea>
                        <input type="submit" value="Send Now">
                    </form>
                    <div id="contactFormErrorMessage" style="margin-top: 3em; display: none;">
                        <div class="alert alert-info">
                          <span><img src="<?php echo base_url('assets/images/loading.gif'); ?>" width="32" height="32"></span> Please Hold On While We Forward Your Message.
                        </div>
                    </div>
                 </div>
			</div>
			  <div class="clearfix"></div>
		</div>
	</div>
		<div class="map">
		 	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4722.821361593204!2d5.8146916!3d5.506952999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1041b2271d9310a9%3A0x9522867e35b33d98!2sLinkorion+Technology+Ltd!5e0!3m2!1sen!2sng!4v1489358157457""> </iframe>
            
		 </div>

</div>

<?php echo $footer; ?>

</body>
</html>