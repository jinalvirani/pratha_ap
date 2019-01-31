<html>
<head>
<style>
.login{
	margin-left:94.5%;
	position:absolute;
	margin-top:0%;
	z-index:2;
}
@media (max-width: 1100px)
{
	.login {
		margin-left:96%;
		margin-top:7%;
	}
}
@media (max-width: 1000px)
{
	.login {
		margin-left:95%;
		margin-top:7%;
	}
}
@media (max-width: 800px)
{
	.login {
		margin-left:94%;
		margin-top:7%;
	}
}
@media (max-width: 640px)
{
	.login {
		margin-left:93%;
		margin-top:7%;
	}
}
@media (max-width: 540px)
{
	.login {
		margin-left:92%;
		margin-top:12%;
	}
}
@media (max-width: 440px)
{
	.login {
		margin-left:89.5%;
		margin-top:12%;
	}
}
@media (max-width: 370px)
{
	.login {
		margin-left:88.5%;
		margin-top:12%;
	}
}
@media (max-width: 330px)
{
	.login {
		margin-left:86.5%;
		margin-top:12%;
	}
}
</style>
</head>
<body>
<header id="top" class="header-inner">
	<nav class="navbar-desctop visible-md visible-lg">
<div class="login" style="">
		<a href="<?php echo base_url(); ?>owner_controller/index">
			<center><i class="fa fa-user" style="font-size:30px;"></i></center>
			<p style="font-size:10px;">User login</p>
		</a>
	</div>	
	<div class="container">
			<a href="<?php echo base_url(); ?>front_controller/index" class="brand js-target-scroll col-md-2">
				<img src="<?php echo base_url(); ?>img/logo.jpeg" width="65%">
			</a>
			<ul class="navbar-desctop-menu col-md-11">
				<li class="t1" style="font-color:white">
					<a class="home" href="<?php echo base_url(); ?>front_controller/index">Home</a>
				</li>
				<li class="t2">
					<a class="aboutus">About us</a>
					<ul>
						<li><a href="<?php echo base_url(); ?>front_controller/about_us" class="profile">Profile</a></li>
						
					</ul>
				</li>
				
				<li class="t5">
					<a class="contactus" href="<?php echo base_url(); ?>front_controller/contact_us">Contact Us</a>
				</li>
			</ul>
		</div>
	</nav>
 
	<nav class="navbar-mobile">
		<a href="<?php echo base_url(); ?>front_controller/index" class="brand js-target-scroll">
			<img src="<?php echo base_url(); ?>img/logo.jpeg" width="20%">
		</a>
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-mobile">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav-mobile">
			<li class="t1">
				<a class="home" href="<?php echo base_url(); ?>front_controller/index">Home</a>
			</li>
			<li class="t2">
				<a class="aboutus" href="#">About us <i class="fa fa-angle-down"></i></a>
				<ul>
					<li><a href="<?php echo base_url(); ?>front_controller/about_us" class="profile">Profile</a></li>
					
				</ul>
			</li>
			<li class="t6">
				<a class="contactus" href="<?php echo base_url(); ?>front_controller/contact_us">Contacts</a>
			</li>
		</ul>
		</div>
	</nav>
</header>
</body>
</html>