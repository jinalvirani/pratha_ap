<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="about anupam architecture,about anupam design studio,details of anupamds,company profile of anupamds,anupamds company profile">
<meta name="description" content="Multi-disciplinary consultancy - Architecture, Surveying, Engineering, Town Planning and Valuation Services. Position: Architect Duties: Design, documentation and administration of commercial, industrial, residential.">
<title>PRTHA PROFILE</title>
 
<link rel="shortcut icon" href="favicon.png">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>apple-touch-icon-114x114.png">
 
<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/animate.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/hover.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/magnific-popup.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/idangerous.swiper.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/owl.carousel.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/owl.transitions.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/settings.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/layers.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/navigation.css" rel="stylesheet" media="screen">

<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/front/style.css" rel="stylesheet" media="screen">

<link href="<?php echo base_url();?>css/index/index.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/projects/pro.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/projects/pro2.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>css/projects/pro3.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>css/about/about.css" rel="stylesheet" media="screen">
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
				<h1>PRATHA Profile</h1>
			</header>
		</div>
	</main>
	<div class="content">
 
		<section id="about" class="about">
			<div class="container">
				<div class="entry">
					<p class="entry-text">
						PRATHA is a densely populated upper middle class locality in surat, India, close to maharaja farm. It has over a 10 residential buildings from 10 floors high and forthcoming constructions are promised to be higher. Also, PRTHA has its own swimming pool & club house. There is ground and kids play area which provide playing areas for the children as well as meeting areas during festivals.There is also one club house where residents play game or use for other activity.lounge that is used for relaxing and entertaining for guests or usually residents sitting in lounge and watching the T.V. . For any event,prize distribution etc organize in Banqute hall.
					</p>
				</div>
			</div>
		</section>
 
		<section id="services" class="services section">
			<div class="container">
				<header class="section-header">
					<h2 class="section-title">Our<span class="text-primary"> Specialization</span></h2>
				</header>
				<div class="section-content">
					<div class="row-services row-base row">
						<div class="col-base col-service col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
							<div class="arch" style="margin-left:15%;margin-right:-15%">

								<img alt="" src="<?php echo base_url(); ?>img/front/slider/creditcard.jpg"" width="100">
									<h4 style="text-transform:capitalize;">Payment gateway transaction</h4>
										<p class="entry-text">
											
										</p>
							
							
							</div>
						</div>
						<div class="col-base col-service col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
							<div class="interior">
							
								<img alt="" src="<?php echo base_url(); ?>img/front/slider/dues.png" width="100">
									<h4 style="text-transform:capitalize;">Dues management</h4>
										<p class="entry-text">
											
										</p>
							
							
							</div>
						</div>
						<div class="clearfix visible-sm"></div>
						<div class="col-base col-service col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="0.6s">
							<div class="graph" style="margin-left:-15%;margin-right:15%">
							
								<img alt="" src="<?php echo base_url(); ?>img/front/slider/communication.png" width="100">
									<h4 style="text-transform:capitalize;">neighbor network</h4>
										<p class="entry-text">
											
										</p>
							
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	
	<section class="projects section">
	<div class="container">
		<h2 class="section-title">Associative <span class="text-primary">Member</span></h2>
	</div>
	<div class="section-content">
		<div class="projects-carousel js-projects-carousel js-projects-gallery">
			<?php
			$associative = $this->front_model->get_associative_mdl();
			if($associative)
			{
				$data['associatives'] = $this->front_model->get_associative_mdl();
			}
				if($associative)
				{
					foreach($associative as $f)
				{ 
			?>
					<div class="project project-light">
						<a  title="<?php echo $f->firstname; ?>">
							<figure>
								<img alt="<?php echo $f->firstname; ?>" src="<?php echo base_url(); ?>img/admin/<?php echo $f->pic;  ?>">
								<figcaption>
									<h3 class="project-title">
									<?php echo $f->firstname; ?>
									</h3>
									
									<div class="project-zoom"></div>
								</figcaption>
							</figure>
						</a>
					</div>
			<?php
		
				} }
			?>
		</div>
	</div>
</section>
	<?php
	include("footer.php");
	?>
 
	</div>
</div>

</body>

<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/smoothscroll.js"></script>

<script src="<?php echo base_url(); ?>js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.stellar.min.js"></script>
<script src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
 
<script src="<?php echo base_url(); ?>js/rev-slider/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url(); ?>js/rev-slider/jquery.themepunch.revolution.min.js"></script>
 
<script src="<?php echo base_url(); ?>js/interface.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98714794-1', 'auto');
  ga('send', 'pageview');

</script>
</html>