<!DOCTYPE html>
<html>
<head>
<title> ADMIN |  PRATHA </title>
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
			email:{
                required:true,
                email_add:true
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
			wingno:{
				required:true,
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
			 email:{
                required:"please enter email",
                email_add:"enter valid email address"
            },
			password:{
				required:"please enter Password",
				pass:"at least 6 character"
			},
			mobileno:{
				required:"Please enter mobileno",
				number:"Enter exectly 10 digit"
			},
			wingno:{
				required:"Please select wingno",
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
                    $('#adminimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</head>

<body>
   <div id="wrapper">
   <?php include('admin_show_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Admin Information</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url();?>admin_controller/changeadmin_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Admin Firstname</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Admin Firstname" class="form-control" required=""></div>
									<div class="form-group"><label>Admin Lastname</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Admin Lastname" class="form-control" required=""></div>

									<?php if($invalid = $this->session->flashdata('username_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>

									<div class="form-group"><label>Admin Username</label> 
									<input  type="text" name="username" size="50" placeholder="Enter Admin Username" class="form-control" required=""></div>
									<div class="form-group"><label>Admin Password</label> 
									<input  type="password" name="password" size="50"  minlength="6" placeholder="Enter Admin Password" class="form-control" required=""></div>
									<div class="form-group"><label>Email</label>
					                    <input type="email" class="form-control" name="email" placeholder="Email" >
					                </div>
									<?php if($invalid = $this->session->flashdata('wing_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Wing Number</label> <br>
									<select name="wingno" id="wingno" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										
										<option value="" hidden>--Select wing_No--</option>
                       					  <?php 
								            foreach($wing  as $row)
								            { 
								              echo '<option value="'.$row->wing_id.'">'.$row->wing_name.'</option>';
								                
								            }
								          ?>
									</select>
								</div>
								
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobileno" size="50" placeholder="Enter Admin Mobile Number" class="form-control" required=""></div>
									<?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
		                        
									<div class="form-group"><label>Admin Pic</label>
									<input type="file" name="file" size="50" placeholder="Select Image"  required="" onchange="readURL(this);"></div>
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="adminimg">
									</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="change"><strong>Change</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo base_url(); ?>admin_controller/newadmin_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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