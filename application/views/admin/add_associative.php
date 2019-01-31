<!DOCTYPE html>
<html>
<head>
<title> ASSOCIATIVE | PRATHA </title>
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
                    $('#asso_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>

</head>

<body>
   <div id="wrapper">
   <?php include('associative_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Associative Member Information</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>/admin_controller/addassociative_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Associative Firstname</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Associative Firstname" class="form-control" required=""></div>
									<div class="form-group"><label>Associative Lastname</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Associative Lastname" class="form-control" required=""></div>

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
									<input  type="number" name="mobileno" size="50" placeholder="Enter Associative Mobile Number" class="form-control" required=""></div>
									<?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Associative Pic</label>
									<input type="file" name="file"  placeholder="Select Image"  required="" onchange="readURL(this);"></div>
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="asso_img">
									</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo  base_url(); ?>admin_controller/associative_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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