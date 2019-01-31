<!DOCTYPE html>
<html>

<head>
 <title> REGISTRATION | PRATHA </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

    
<style>
#showHide {
  width: 15px;
  height: 15px;
  float: left;
}
#showHideLabel {
  float: left;
  padding-left: 5px;
}
.logo{
    opacity: 0.3;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo  base_url(); ?>js/dist/jquery.validate.js"></script>
<script>
		$(document).ready(function() {
		  $("#showHide").click(function() {
			if ($(".password").attr("type") == "password") {
			  $(".password").attr("type", "text");

			} else {
			  $(".password").attr("type", "password");
			}
		  });
		});

$(document).ready(function(){
    
    $.validator.addMethod("n", function(value, element) {
        
            return this.optional(element) || /^[a-zA-Z]+$/.test(value);
        }, "Enter only character");
    $.validator.addMethod("usernm", function(value, element) {
        
            return this.optional(element) || /^[a-zA-Z0-9._]+$/.test(value);
        }, "enter valid username");
    $.validator.addMethod("pass", function(value, element) {
        
            return this.optional(element) || /^[a-zA-Z0-9!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]+$/.test(value);
        }, "at least 6 character length");
        $.validator.addMethod("age_number", function(value, element) {
        
            return this.optional(element) || /^[0-9]{2}$/.test(value);
        }, "Enter only digit");

        $.validator.addMethod("land_number", function(value, element) {
        
            return this.optional(element) || /^[0-9]{8}$/.test(value);
        }, "Enter only digit");
        $.validator.addMethod("mobile_number", function(value, element) {
        
            return this.optional(element) || /^[789]\d{9}$/.test(value);
        }, "Enter only digit");
         $.validator.addMethod("address1", function(value, element) {
        
            return this.optional(element) || /^[1-9a-zA-Z -]+$/.test(value);
        }, "Enter valid address");
         $.validator.addMethod("email_add", function(value, element) {
        
            return this.optional(element) || /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(value);
        }, "Enter valid email");
    $("#form1").validate({
        rules:{
            firstname:{
                required:true,
                n:true
            },
            lastname:{
                required:true,
                n:true
            },
            username:{
                required:true,
                usernm:true
            },
            password:
            {
                required:true,
                pass:true
            },
            wing_no:{
                required:true,
            },
            home_no:{
                required:true,
            },
            city:{
                required:true,
            },
            age:{
                required:true,
                age_number:true
            },
            mobile_no:{
                required:true,
                mobile_number:true
            },
            land_line_no:{
                required:true,
                land_number:true
            },
            address:{
                required:true,
                address1:true
            },
            file:{
                required:true,
                
            },
            email:{
                required:true,
                email_add:true
            },
           
           
           


            
        },
        messages:{
            firstname:{
                required:"Please enter Firstname",
                n:"Enter valid  owner firstname"
            },
            lastname:{
                required:"Please enter Lastname",
                n:"Enter valid owner lastname"
            },
            username:{
                required:"Please enter username",
                usernm:"Enter valid username"
            },
            password:{
                required:"please enter Password",
                pass:"at least 6 character"
            },
            wing_no:{
                required:"Please select wingno",
            },
            home_no:{
                required:"Please select homeno",
            },
            city:{
                required:"Please select city",
            },
            age:{
                required:"Please enter Age",
                age_number:"enter valid age"
            },
            mobile_no:{
                required:"Please enter mobile number",
                mobile_number:"enter valid mobile_number"
            },
            land_line_no:{
                required:"Please land line number",
                land_number:"enter valid land_number"
            },
            address:{
                required:"Please enter address",
                address1:"enter valid address"
            },
            file:{
                required:"Please select profile_pic",
            },
              email:{
                required:"please enter email",
                email_add:"enter valid email address"
            },
           
            
            
            
            
        }
    });
});
$(document).ready(function(){
    $('#imgdiv').hide();
});


        function readURL(input) {
            if (input.files && input.files[0]) {
                $('#imgdiv').show();
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#user_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


</script>

</head>

<body class="gray-bg">
	<div class=" text-center loginscreen   animated fadeInDown">
<div class="logo">
    <h1 style="font-size: 70px;font-weight: 800;"><font color="gray">PRATHA</font></h1>
	  <h1 style="font-size: 30px;font-weight: 500;">APARTMENT</font></h1>
</div>
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
		
            
            <h3>owner register to PRATHA</h3>
            
            <form class="m-t" role="form" action="<?php echo base_url(); ?>owner_controller/register_cont" method="post" enctype="multipart/form-data" id="form1">
            	 <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" required="">
                </div>
                 <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" >
                </div>
                <?php if($invalid1 = $this->session->flashdata('username')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid1; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                <div class="form-group">
                    <input type="password" class="password form-control" name="password" placeholder="password" minlength="6" >
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" >
                </div>
                <div class="form-group">
       				<label class="radio-inline">
     			 		<input type="radio" name="gender" value="female">female
   					 </label>
   					 <label class="radio-inline">
      					<input type="radio" name="gender" value="male" checked>male
   					 </label>
				</div>
				<div class="form-group">
                     <input type="number" class="form-control" placeholder="Age" name="age">	
				</div>
               
				
				 <div class="form-group">
                     <input type="number" class="form-control" placeholder="Mobile_No" name="mobile_no" >	
				</div>
				<div class="form-group">
                     <input type="number" class="form-control" placeholder="Land_Line_No" name="land_line_no" >	
				</div>				
					
			
				 <div class="form-group">
                     <select name="wing_no" class="form-control" id="wing_no">
                     	<option hidden value="">--select wing_No--</option>
                         <?php 
            foreach($wing  as $row)
            { 
              echo '<option value="'.$row->wing_id.'">'.$row->wing_name.'</option>';
                
            }
            ?>
                     </select>
				</div>
				<div class="form-group">
                     <select name="home_no" class="form-control" id="home_no">
                     <option hidden value="">select_home_no</option>
                     	
                     </select>
				</div>
                <?php if($invalid1 = $this->session->flashdata('wing_home')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid1; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                 <div class="form-group">
                     <select name="city" class="form-control">
                        <option hidden value="">--select city--</option>
                        <?php 
            foreach($city  as $row1)
            { 
              echo '<option value="'.$row1->city_id.'">'.$row1->city_name.'</option>';
                
            }
            ?>
                     </select>
                </div>
                <div class="form-group">
                     <textarea class="form-control" placeholder="Address" name="address" ></textarea>    
                </div>
                <?php if($invalid = $this->session->flashdata('image_error')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
				<div class="form-group">
                     <input type="file" name="file" onchange="readURL(this);">	
                     
				</div>
				<div id="imgdiv">
				<img src="" name="display_pic" class="img-responsive" height="100" width="100" id="user_image">

				</div>



						<input type="checkbox" id="showHide"/>
						<label for="showHide" id="showHideLabel">Show Password</label>
						<br>
						<br>
						<br>
                
        
                <button type="submit"  name="register" class="btn btn-primary block full-width m-b">Register</button>
                <br>
                <br>

            </form>
              <a href="<?php echo base_url(); ?>owner_controller/index"> <button  name="login" class="btn btn-primary block full-width m-b">Login</button></a>

               
            
               
			   <small>
			   <div class=" text-center">&#169; Copyright <?php date_default_timezone_set("Indian/Antananarivo"); echo date("Y"); ?>   Anupam Architecture.<br>All Rights Reserved.
			   <small>
			  <br> Design by Webster Technologies
			  </div>
			  
            
        
    </div>
    <!-- Mainly scripts -->
 <!--   <script src="<?php echo base_url(); ?>js/jquery-2.1.1.js"></script>-->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo  base_url(); ?>js/plugins/pace/pace.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <script type="text/javascript">


   $(document).ready(function(){
    $('#wing_no').on('change',function(){
        var wing_id=$(this).val();
        
        if(wing_id == '')
        {
            $('#home_no').prop('disabled',true);
        }
        else
        {
             $('#home_no').prop('disabled',false);
             $.ajax({

                url:"<?php echo base_url() ?>owner_controller/fillhome_cont",
                type:"POST",
               
                data:{
                    'wing_id' : wing_id, 
                },
                 dataType:'json',
                success:function(data)
                {
                   $('#home_no').html(data);

                },
                 error:function()
                {
                    $('#homeno').html();
                }

             });
        }
       
    });

   });
</script>

   
</body>

</html>
