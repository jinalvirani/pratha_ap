
<?php

	if(isset($associative_info))
	{
		foreach($associative_info as $asso)
		{
			$asso_id = $asso->user_id;
			$asso_fnm = $asso->firstname;
			$asso_lnm = $asso->lastname;
			$asso_mno = $asso->mobile_no;
			$asso_img = $asso->pic;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title> ASSOCIATIVE |  PRATHA </title>
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
			homeno:{
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
			},
			homeno:{
				required:"Please select homeno",
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
            	$('#realimg').hide();
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
   <?php include('associative_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Edit Associative Member Information</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/editassociative_cont" method="post" enctype="multipart/form-data" id="f1">
                               	<input type="text" value="<?php if(isset($asso_id)) { echo $asso_id; } ?>" name="updateid" hidden>
                                    <div class="form-group"><label>Associative Firstname</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Associative Firstame" class="form-control" required="" value="<?php if(isset($asso_fnm)) { echo $asso_fnm; } ?>"></div>
									<div class="form-group"><label>Associative Lastname</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Associative Lastname" class="form-control" required="" value="<?php if(isset($asso_lnm)) { echo $asso_lnm; } ?>" ></div>

									<?php if($invalid = $this->session->flashdata('wing_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>

									<!--<div class="form-group"><label>Wing Number</label> <br>
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
										<option value="" hidden>--select wing_No--</option>
                       					  <?php 
								           /* foreach($wing  as $row)
								            { 
								              echo '<option value="'.$row->wing_id.'">'.$row->wing_name.'</option>';
								                
								            }*/
								          ?>
									</select>
								</div>
								<div class="form-group"><label>Home No</label> <br>
									<select name="homeno" id="homeno" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										
									</select>
								</div>-->
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobileno" size="50" placeholder="Enter Associative Mobile Number" class="form-control" required="" value="<?php if(isset($asso_mno)) { echo $asso_mno; } ?>" ></div>
									
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
									<input type="file" name="file" size="50" placeholder="Select Image"  onchange="readURL(this);" ></div>
									
										<?php if(isset($asso_img)) { ?>
										<div id="realimg">
										<img src="<?php echo base_url(); ?>img/admin/<?php echo $asso_img; ?>" height="100px" width="100px" class="img-responsive">
										</div>
										<?php } ?>
									<input type="text" name="updatepic" value="<?php echo $asso_img; ?>" hidden>
									<div id="imgdiv">
										<img src="#" height="100px" width="100px" class="img-responsive" id="adminimg">
									</div>

									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Edit</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo  base_url(); ?>admin_controller/associative_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                    </div>
                    </div>
                
            </div>
            </div>
			</div>
			<script type="text/javascript">


   $(document).ready(function(){
    $('#wingno').on('change',function(){
        var wing_id=$(this).val(); 
        if(wing_id == '')
        {
            $('#homeno').prop('disabled',true);
        }
        else
        {
             $('#homeno').prop('disabled',false);
             $.ajax({

                url:"<?php echo base_url() ?>admin_controller/fillhome_cont",
                type:"POST",
               
                data:{
                    'wing_id' : wing_id, 
                },
                 dataType:'json',
                success:function(data)
                {
                   $('#homeno').html(data);

                },
                error:function()
                {
                    alert("error");
                }

             });
        }
       
    });

   });
</script>
			 <!-- Custom and plugin javascript -->
      <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>
  
  
<?php include("footer.php");?>
</body>
</html>