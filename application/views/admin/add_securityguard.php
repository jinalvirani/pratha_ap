<!DOCTYPE html>
<html>
<head>
<title> SECURITY GUARD |  PRATHA </title>
<style>
		form .error{
			font-weight: bold;
			color:#cc5965;
			border-color:blue;
		}
</style>
 
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
<script>
$(document).ready(function(){
	
	$.validator.addMethod("n", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z]+$/.test(value);
    	}, "Enter only character");
	$.validator.addMethod("usernm", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9._]+$/.test(value);
    	}, "enter valid username");
	$.validator.addMethod("quali", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9 .-]+$/.test(value);
    	}, "enter valid Qualification");
	$.validator.addMethod("add", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9 .,_-]+$/.test(value);
    	}, "enter valid Address");
	$.validator.addMethod("pass", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]+$/.test(value);
    	}, "at lest 6 character length");
	 $.validator.addMethod("email_add", function(value, element) {
        
            return this.optional(element) || /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(value);
        }, "Enter valid email");
		$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^[789][0-9]{9}$/.test(value);
    	}, "Enter only digit");
	$("#f1").validate({
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
			mobileno:{
				required:true,
				number:true
			},
			 email:{
                required:true,
                email_add:true
            },
			shift:{
				required:true,
			},
			qualification:
			{
				required:true,
				quali:true
			},
			address:
			{
				required:true,
				add:true
			},

			
		},
		messages:{
			firstname:{
				required:"Please enter Firstname",
				n:"Enter valid admin firstname"
			},
			lastname:{
				required:"Please enter Lastname",
				n:"Enter valid admin lastname"
			},
			username:{
				required:"Please enter username",
				usernm:"Enter valid username"
			},
			password:{
				required:"please enter Password",
				pass:"at least 6 character"
			},
			mobileno:{
				required:"Please enter mobileno",
				number:"Enter exectly 10 digit"
			},
			 email:{
                required:"please enter email",
                email_add:"enter valid email address"
            },
			shift:{
				required:"Please select shift",
			},
			qualification:{
				required:"please enter qualification",
				qualification:"Eneter valid Qualification"
			},
			address:{
				required:"please enter address",
				add:"Eneter valid address"
			}
			
			
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
                    $('#asso_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>

</head>

<body>
   <div id="wrapper">
   <?php include('securityguard_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Security Guard</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/guardinsert_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Guard Firstname</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Guard Firstname" class="form-control" required=""></div>
									<div class="form-group"><label>Guard Lastrame</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Guard Lastname" class="form-control" required=""></div>
									<?php if($invalid = $this->session->flashdata('username_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Guard Username</label> 
									<input  type="text" name="username" size="50" placeholder="Enter Guard Username" class="form-control" required=""></div>
									<div class="form-group"><label>Guard Password</label> 
									<input  type="password" name="password" size="50" placeholder="Enter Guard Password" class="form-control" required="" minlength="6"></div>
									<div class="form-group"><label>Email</label>
					                    <input type="email" class="form-control" name="email" placeholder="Email" >
					                </div>
									<div class="form-group"><label>Gender</label> <br>
									<label class="radio-inline">
									      <input type="radio" name="gender" value="male" checked>Male
									    </label>
									    <label class="radio-inline">
									      <input type="radio" name="gender" value="female">Female
									    </label>
									</div>
									<div class="form-group"><label>Guard Qualification</label> 
									<input  type="text" name="qualification" placeholder="Enter Guard Qualification" class="form-control" required=""></div>
									<div class="form-group"><label>Guard Address</label> 
									<input  type="text" name="address" placeholder="Enter Guard Address" class="form-control" required=""></div>
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobileno" size="50" placeholder="Enter guard Mobile Number" class="form-control" required=""></div>
								<div class="form-group"><label>Shift</label> <br>
									<select name="shift" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--select--</option>
										<option value="day" >Day</option>
										<option value="night">Night</option>
									</select>
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
									<div class="form-group"><label>Guard Pic</label>
									<input type="file" name="file" size="50" placeholder="Select Image"  required="" onchange="readURL(this);"></div>
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="asso_img">
									</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo  base_url(); ?>admin_controller/guard_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                    </div>
                    </div>
                
            </div>
            </div>
			</div>
			 <!-- Custom and plugin javascript -->
   <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>
  
<?php include("footer.php");?>
</body>
</html>