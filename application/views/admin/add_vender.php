<!DOCTYPE html>
<html>
<head>
<title> VENDER |  PRATHA </title>
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
    	
    	    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    	}, "Enter only character");
	$.validator.addMethod("add", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9 .,_-]+$/.test(value);
    	}, "enter valid Address");
		$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^[789][0-9]{9}$/.test(value);
    	}, "Enter only digit");
	$("#f1").validate({
		rules:{
			servicename:{
				required:true,
				n:true
			},
			vendername:{
				required:true,
				n:true
			},
			mobileno:{
				required:true,
				number:true
			},
			address:
			{
				required:true,
				add:true
			},

			
		},
		messages:{
			servicename:{
				required:"Please enter servicename",
				n:"Enter valid servicename"
			},
			vendername:{
				required:"Please enter vendername",
				n:"Enter valid vendername"
			},
			mobileno:{
				required:"Please enter mobileno",
				number:"Enter exectly 10 digit"
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
   <?php include('vender_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Vendor</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/venderinsert_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Service Name</label> 
									<input  type="text" name="servicename" size="50" placeholder="Enter Service Name" class="form-control" required=""></div>
									<div class="form-group"><label>Vendor Name</label> 
									<input  type="text" name="vendername" size="50" placeholder="Enter vender Name" class="form-control" required=""></div>
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobileno" size="50" placeholder="Enter vender Mobile Number" class="form-control" required=""></div>
									<div class="form-group"><label>Vender Address</label> 
									<input  type="text" name="address" placeholder="Enter vender Address" class="form-control" required=""></div>
									<?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Vendor Pic</label>
									<input type="file" name="file" size="50" placeholder="Select Image"  required="" onchange="readURL(this);"></div>
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="asso_img">
									</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo  base_url(); ?>admin_controller/vender_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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