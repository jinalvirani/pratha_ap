<html>
<head>
<style>
a.home,a.aboutus,a.gallary,a.contactus,a.testimonial,a.projects,a.career {color:#fff;}
</style>
<script src="<?php echo base_url(); ?>lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>dist/jquery.validate.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SITEMAP | PRATHA APARTMENT </title>
 
<link rel="shortcut icon" href="favicon.png">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
 
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/front/style.css" rel="stylesheet" media="screen">
</head>
<body>

<div class="loader">
<div class="loader-brand">
<div class="sk-folding-cube">
<div class="sk-cube1 sk-cube"></div>
<div class="sk-cube2 sk-cube"></div>
<div class="sk-cube4 sk-cube"></div>
<div class="sk-cube3 sk-cube"></div>
</div>
</div>
</div>

<?php
include("arc.php");
include("header.php");
?>

<div class="layout">
 
<main class="main main-inner bg-about" data-stellar-background-ratio="0.6">
<div class="container">
<header class="main-header">
<h1>Sitemap</h1>
</header>
</div>

</main>
</div>
<div class="list">
<ul class="sitemap-list">
<li>
<a href="<?php echo base_url(); ?>front_controller/index">Home</a>
</li>
<li>
<font color="white">About us</font>
	<ul>
	<li><a href="<?php echo base_url(); ?>front_controller/about_us">Profile</a></li>
	
	</ul>
</li>
<li>
<a href="<?php echo base_url(); ?>front_controller/contact_us">Contact Us</a>
</li>
</ul>
</div>
</div>

<?php
include("footer.php");
?>

<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/smoothscroll.js"></script>
<script src="<?php echo base_url(); ?>js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.stellar.min.js"></script>
<script src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
 <script src="<?php echo base_url(); ?>js/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/jquery.themepunch.revolution.min.js"></script>
 
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.actions.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.kenburn.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.layeranimation.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.migration.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.navigation.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.parallax.min.js"></script>
<script src="j<?php echo base_url(); ?>s/rev-slider/revolution.extension.slideanims.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/revolution.extension.video.min.js"></script>
<script src="<?php echo base_url(); ?>js/interface.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98714794-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>