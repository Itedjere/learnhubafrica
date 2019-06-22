<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>"  type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
<link rel='stylesheet' type='text/css' href="<?php echo base_url('assets/css/home_header.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/blog-nav.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/blog_learnhub.css'); ?>">

<script type="text/javascript" data-cfasync="false" src="//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js" data-shr-siteid="8f5644f2f7fa6ec3fea8b75fc76833dd" async="async"></script>

</head>

<body class="cbp-spmenu-push" id="home">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=145939922727854';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
    <h3>Menu</h3>
    <a href="<?php echo site_url(); ?>">Home</a>
    <a href="<?php echo site_url('blog'); ?>">Blog Page</a>
    <?php if(count($nav_categories) > 0) : ?>
    <?php foreach($nav_categories as $nav_ca): ?>
    <a href="<?php echo site_url('blog/category/' . $nav_ca['category_slug']); ?>">
    <?php echo $nav_ca['category_name']; ?></a>
    <?php endforeach; ?>
    <?php endif; ?>
</nav>