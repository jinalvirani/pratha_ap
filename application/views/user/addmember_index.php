<!DOCTYPE html>
<html>
<head>
<title>MEMBER | PRATHA</title>
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
    	
    	    return this.optional(element) || /^([a-zA-Z]?)+$/.test(value);
    	}, "Enter only character");
		$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^[789]\d{9}$/.test(value);
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
			mobile_no:
			{
				
				number:true,
			},
			file:
			{
				required:true,
			},
			member_type:
			{
				required:true,
			
			},
			
		},
		messages:{
			firstname:{
				required:"Please enter member name",
				n:"Enter valid member name"
			},
			lastname:{
				required:"Please enter member name",
				n:"Enter valid member name"
			},
			mobile_no:
			{
				
				number:"Enter valid phone number",
			},
			file:
			{
				required:"please select image of member",
			},
			member_type:{
				required:"select member_type",


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
                    $('#user_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</head>

<body>
   <div id="wrapper">
   <?php include('myunit_index.php'); ?> 

   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Family Members</h3>
                    </div>
			<div class="ibox-content">
				
                               	    <form action="<?php echo base_url(); ?>owner_controller/add_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Member First Name</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Member First Name" class="form-control" required=""></div>
									 <div class="form-group"><label>Member Last Name</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Member Last Name" class="form-control" required=""></div>
									<div class="form-group"><label>Gender</label> <br>
									<label class="radio-inline">
								    <input type="radio" name="gender" value="male" checked>Male
									    </label>
									    <label class="radio-inline">
									      <input type="radio" name="gender" value="female">Female
									    </label>
									</div>
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobile_no" size="50" placeholder="Enter Member Mobile Number" class="form-control"></div>	
									<?php if($invalid = $this->session->flashdata('image_error')) { ?>	
									<div class="row">
                                     

                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>						
							       <div class="form-group"><label>Member Pic</label>
				                     <input type="file"   name="file" onchange="readURL(this);">	
									</div>
									<div id="imgdiv">
									<img src="" name="display_pic" class="img-responsive" height="100" width="100" id="user_image">

									</div>


									<div class="form-group"><label>Member Type</label> <br>
									<select name="member_type" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--Select--</option>
										<option>Child</option>
										<option>Adult</option>
										<option>Senior-Citizen</option>
									</select>
								</div>
                               		
										<?php 
											$f=1;
											if(isset($emergency_count))

											{
												if($emergency_count <= 1)
											
											{
										?>
									<div class="form-group">
									<input type="checkbox" name="emergency_status" value="yes"><strong>&nbsp;&nbsp;Make Emergency Contact</strong>
									</div>
									<?php
											 }

									else
									{
									 ?>

										 <div class="form-group">
										<input type="checkbox" name="emergency_status" value="no" disabled ><strong>&nbsp;&nbsp;Make Emergency Contact</strong>
									</div>

									<?php }  } 

									$f=0;

									if($f == 1)
									{   ?>
										<div class="form-group">
									<input type="checkbox" name="emergency_status" value="yes"><strong>&nbsp;&nbsp;Make Emergency Contact</strong>
									</div>	
							<?php		}
									?>

									 <?php if($invalid = $this->session->flashdata('emergency')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong> NOTICE:</strong><?php echo $invalid; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        				<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
									</div><br><br><br>
									</form>
					<center><p> <a href="<?php echo base_url(); ?>owner_controller/display_memberlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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