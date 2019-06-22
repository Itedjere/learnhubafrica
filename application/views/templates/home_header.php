<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="<?php echo site_url(); ?>">
            	<img src="<?php echo base_url('assets/images/9jaGreenArena_Logo_Icon.png'); ?>" width="100%" >
            </a>
	    </div>
	    <!--/.navbar-header-->
	    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
	        <ul class="nav navbar-nav">
            	<li class="dropdown">
		            <a href="<?php echo site_url(); ?>" class="<?php echo $home; ?>"><i class="fa fa-home" aria-hidden="true"></i>
<span>Home</span></a>
	          	</li>
		        <li class="dropdown">
		            <a href="<?php echo site_url('about_us'); ?>" class="<?php echo $about; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>About</span></a>
	          	</li>
		        <li class="dropdown">
              <a href="<?php echo site_url('blog'); ?>" class="<?php echo $blog; ?>"><i class="fa fa-rss" aria-hidden="true"></i>
<span>Blog</span></a>
		        	  <!--<ul class="dropdown-menu">
			            <li><a href="http://localhost/9jagreenarena/allCourses.php">Technology</a></li>
			            <li><a href="http://localhost/9jagreenarena/allCourses.php">Entrepreneurship</a></li>
			            <li><a href="http://localhost/9jagreenarena/allCourses.php">Lifestyle</a></li>
		              </ul>-->
		        </li>
		        <li class="dropdown">
		            <a href="<?php echo site_url('contact_us'); ?>" class="<?php echo $contact; ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i>
<span>Contact</span></a>
		             
		        </li>
       <!-- <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span>English</span></a>
		            <ul class="dropdown-menu">
			            <li><a href="#"><span><i class="flags us"></i><span>English</span></span></a></li>
			            <li><a href="#"><span><i class="flags newzland"></i><span>Newzland</span></span></a></li>
			        </ul>
		        </li>-->
		        <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i><span>Search</span></a>
		            <ul class="dropdown-menu search-form">
			           <form>        
                            <input type="text" class="search-text" name="s" placeholder="Search...">    
                            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                       </form>
			        </ul>
		        </li>
		    </ul>
	    </div>
	    <div class="clearfix"> </div>
	  </div>
	    <!--/.navbar-collapse-->
</nav>