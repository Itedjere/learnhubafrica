<div class="top-menu">
    <span class="menu"> </span>
    <ul class="cl-effect-16">
        <li><a class="<?php echo $home; ?>" href="<?php echo site_url(); ?>" data-hover="Home">Home</a></li>
        <li><a class="<?php echo $about; ?>" href="<?php echo site_url('about_us'); ?>" data-hover="About">About</a></li>
        <!--<li><a href="http://localhost/9jagreenarena/project/" data-hover="Project">Project</a></li>-->
        <!--<li><a href="http://localhost/9jagreenarena/learn-arena/" data-hover="Learn-Arena">Learn-Arena</a></li>-->
        <li><a class="<?php echo $blog; ?>" href="<?php echo site_url('blog'); ?>" data-hover="blog">Blog</a></li>
        <li><a class="<?php echo $contact; ?>" href="<?php echo site_url('contact_us'); ?>" data-hover="Contact">Contact</a></li>
        <div class="clearfix"></div>
    </ul>
</div>
<!-- script-for-menu -->
<script>
    $("span.menu").click(function(){
        $(".top-menu ul").slideToggle("slow" , function(){
        });
    });
</script>
<!-- script-for-menu -->
<div class="clearfix"> </div>