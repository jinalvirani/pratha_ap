<?php

	if(isset($facility_info))
	{
		foreach($facility_info as $facility)
		{
			$facility_id = $facility->facility_id;
			$facility_nm = $facility->facility_name;
			$facility_charge = $facility->charge_per_hour;
			$facility_img = $facility->pic;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title> FACILITY |  PRATHA </title>
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
		$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^[0-9]+$/.test(value);
    	}, "Enter only digit");
	$("#f1").validate({
		rules:{
			facilityname:{
				required:true,
				n:true
			},
			charge:{
				required:true,
				number:true
			},
		},
		messages:{
			facilityname:{
				required:"Please enter Facilityname",
				n:"Enter valid Facilityname"
			},
			charge:{
				required:"Please enter Charge",
				number:"Enter Valid Charge"
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
   <?php include('facility_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Edit Facilities</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/facilityedit_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Facility Name</label> 
                                    <input type="text" value="<?php if(isset($facility_id)) { echo $facility_id; } ?>" name="updateid" hidden>
									<input  type="text" name="facilityname" size="50" placeholder="Enter Facility Name" class="form-control" required="" value="<?php if(isset($facility_nm)) { echo $facility_nm; } ?>"></div>
									<div class="form-group"><label>Charge Per Hour</label> 
									<input  type="number" name="charge" placeholder="Enter Charge Per Hour" class="form-control" required="" value="<?php if(isset($facility_charge)) { echo $facility_charge; } ?>"></div>
									<?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Facility Pic</label>
									<input type="file" name="file" size="50" placeholder="Select Image"  onchange="readURL(this);" ></div>
									
										<?php if(isset($facility_img)) { ?>
										<div id="realimg">
										<img src="<?php echo base_url(); ?>img/facility/<?php if(isset($facility_img)) { echo $facility_img; } ?>" height="100px" width="100px" class="img-responsive">
										</div>
										<?php } ?>
									<input type="text" name="updatepic" value="<?php if(isset($facility_img)) { echo $facility_img; } ?>" hidden >
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="adminimg">
									</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Edit</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo base_url(); ?>admin_controller/facility_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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
</html>?>