<html>
<head>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>js/footer/footer.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PRATHA APARTMENT</title>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png">
<link rel="apple-touch-icon" href="<?php echo base_url(); ?>apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>apple-touch-icon-114x114.png">
<link href="<?php echo base_url(); ?>css/front/style.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>css/footer/footer.css" rel="stylesheet" media="screen">
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
</head>
<body>


<section class="contacts section">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title">Get <span class="text-primary">in touch</span></h2>
		</header>
		<div class="section-content">
			<div class="row-base row">
				<div class="col-address col-base col-md-4">
					<div class="icon">
						<i class="fa fa-phone"></i>&ensp;&ensp;(+91) 7405028059
						<br>
						<i class="fa fa-envelope"></i>&ensp;
						<a href="mailto:info@anupamds.com" target="_blank">riddhiborda974@gmail.com</a>
						<br> 
						<i class="fa fa-map-marker"></i>&ensp;&ensp;303, Sicilia Business Hub,<br>&ensp;&ensp;&ensp; Near bhaktinandan chowk,Motavarachha, Surat 395006.
					</div>
				</div>
				<div class="col-base  col-md-8">
<div class="status" id="status">

</div>		
<br>				
					<form method="post" id="contect" enctype="multipart/form-data">
		
				<div class="row-field row">
							<div class="col-field col-sm-4 col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="name" name="name" size="100" placeholder="Name *">
								</div>
								<div class="form-group">
									<input class="form-control" type="email" id="email" name="email" size="100" placeholder="Email *">
								</div>
								<div class="form-group">
									<input class="form-control" id="mobileno" type="text" name="mobileno" size="100" placeholder="Phone *">
								</div>
							</div>
							<div class="col-field col-sm-10 col-md-6 col-sm-height">
								<div class="form-group">
									<textarea class="form-control" id="msg" name="msg" placeholder="Message *" ></textarea>
								</div>
							</div>
						</div>
						<div class="g-recaptcha" data-sitekey="6LfIOyIUAAAAANLGq4UPjj2zORez_7hUUqwA174y" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired"></div>
						<input id="hidden-grecaptcha" name="hidden-grecaptcha" type="text" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/><br>



						<div class="form-submit text-right"><a class="btn btn-shadow-2" id="send" style="margin-top:-12%">send<i class="icon-next"></i></a></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


<footer id="footer" class="footer">
	<div class="container">
		<div class="row-base row">
			<div class="col-base text-center-md col-md-4">
				<br>
				<br>
				
			</div>
			<div class="text-center-md col-base col-md-4">
				©Copyright <?php date_default_timezone_set("Indian/Antananarivo"); echo date("Y"); ?> Pratha Apartment. All Rights Reserved.
				Design by
				<a href="http://www.techbitinfo.com/" class="author-link" target="_blank">
					Techbit Infotech
				</a>
			</div>

			
		</div>
	</div>
	<a href="#" class="scrollToTop"><i class="fa fa-toggle-up"></i></a>
</footer>
</body>
</html>
<script>
$(document).ready(function(){
	
	$.validator.addMethod("n", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    	}, "Enter valid name");
		
		
	$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^[789][0-9]{9}$/.test(value);
    	}, "Enter only digit");
	$.validator.addMethod("email_add", function(value, element) {
        
            return this.optional(element) || /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(value);
        }, "Enter valid email");

	
	$("#contect").validate({
		
		errorElement:'span',
		rules:{
			name:{
				required:true,
				n:true
			},
		email:{
                required:true,
                email_add:true
            },
			mobileno:{
				required:true,
				number:true
			},
				message: {
					required: true,
				},
				"hidden-grecaptcha": {
              required: true,
              minlength: "255"
            }
		},
		messages:{
			name:{
				required:"Enter name"
				
			},
			email:{
                required:"please enter email",
                email_add:"enter valid email address"
            },
				mobileno:{
					required:"Please enter mobileno",
					number:"Enter exectly 10 digit"
				},
				message: {
					required: "Enter message"
				},
				"hidden-grecaptcha":{
					required: "Verify you are human",
				}
		},
		
	});
	
});

	$('#send').click(function(){
		var name = $('#name').val();
		var email = $('#email').val();
		var mobileno = $('#mobileno').val();
		var msg = $('textarea#msg').val();
		             $.ajax({

                url:"<?php echo base_url(); ?>front_controller/contactus",
                type:"POST",
                dataType:'json',
                data:{
                	'name' : name,
                	'email' : email,
                	'msg' : msg,
                	'mobileno' : mobileno,

                },
                success:function(data)
                {
                   $('#status').html(data);

                }
             });
	
	});

</script>


