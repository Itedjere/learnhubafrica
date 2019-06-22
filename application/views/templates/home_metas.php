<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('assets/css/home_header.css'); ?>" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('assets/css/blog_learnhub.css'); ?>" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('assets/css/learnhub.css'); ?>" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet"> 
<link href='//fonts.googleapis.com/css?family=Arvo:400,700,400italic|PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
</head>
<body>