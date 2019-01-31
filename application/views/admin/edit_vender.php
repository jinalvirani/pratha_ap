<?php

	if(isset($vender_info))
	{
		foreach($vender_info as $vender)
		{
			$vender_id = $vender->vender_id;
			$vender_snm = $vender->service_name;
			$vender_vnm = $vender->vender_name;
			$vender_mno = $vender->mobile_no;
			$vender_add = $vender->address;
			$vender_img = $vender->pic;
		}
	}
?>
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
            	$("#realimg").hide();
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
   <?php include('vender_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Edit Vender</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/venderedit_cont" method="post" enctype="multipart/form-data" id="f1">
                               	<input type="text" value="<?php if(isset($vender_id)) { echo $vender_id; } ?>" name="updateid" hidden>
                                    <div class="form-group"><label>Service Name</label> 
									<input  type="text" name="servicename" size="50" placeholder="Enter Service Name" class="form-control" required="" value="<?php if(isset($vender_snm)) { echo $vender_snm; } ?>"></div>
									<div class="form-group"><label>Vender Name</label> 
									<input  type="text" name="vendername" size="50" placeholder="Enter vender Name" class="form-control" required="" value="<?php if(isset($vender_vnm)) { echo $vender_vnm; } ?>"></div>
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobileno" size="50" placeholder="Enter vender Mobile Number" class="form-control" required="" value="<?php if(isset($vender_mno)) { echo $vender_mno; } ?>"></div>
									<div class="form-group"><label>Vender Address</label> 
									<input  type="text" name="address" placeholder="Enter vender Address" class="form-control" required="" value="<?php if(isset($vender_add)) { echo $vender_add; } ?>"></div>
									<?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Vender Pic</label>
									<input type="file" name="file" size="50" placeholder="Select Image"  onchange="readURL(this);" ></div>
									
										<?php if(isset($vender_img)) { ?>
										<div id="realimg">
										<img src="<?php echo base_url(); ?>img/vender_services/<?php if(isset($vender_img)) { echo $vender_img; } ?>" height="100px" width="100px" class="img-responsive">
										</div>
										<?php } ?>
									<input type="text" name="updatepic" value="<?php if(isset($vender_img)) { echo $vender_img; } ?>" hidden >
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="adminimg">
									</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Edit</strong></button>
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