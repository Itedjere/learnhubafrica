<script src="<?php echo base_url('assets/js/blog-nav.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script>
var showRightPush = document.getElementById( 'showRightPush' ),
					menuRight = document.getElementById( 'cbp-spmenu-s2' ),
					body = document.body;
	
showRightPush.onclick = function() {
	classie.toggle( this, 'active' );
	classie.toggle( body, 'cbp-spmenu-push-toleft' );
	classie.toggle( menuRight, 'cbp-spmenu-open' );
};

jQuery(document).ready(function($) {
	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
	});
});
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/email_subscription.js'); ?>"></script>