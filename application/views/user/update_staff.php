 
<?php
		foreach($staff as $row)
		{
			$sid=$row->staff_id;
			$firstname=$row->firstname;
			$lastname=$row->lastname;
			$gender=$row->gender;
			$address=$row->address;
			$mobile_no=$row->mobile_no;
			$vehicle_no=$row->vehicle_no;
			$category=$row->category;
			$pic=$row->pic;
		}
?>
<!DOCTYPE html>
<html>
<head>
<title> STAFF | PRATHA </title>
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
    
        $.validator.addMethod("mobile_number", function(value, element) {
        
            return this.optional(element) || /^[789]\d{9}$/.test(value);
        }, "Enter only digit");
          $.validator.addMethod("vehicle_no", function(value, element) {
     
         return this.optional(element) || /^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$/.test(value);
     }, "Enter valid vehicle no");
         $.validator.addMethod("address1", function(value, element) {
        
            return this.optional(element) || /^[1-9a-zA-Z ,]+$/.test(value);
        }, "Enter valid address");
        
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
            
           
           mobile_no:{
                required:true,
                mobile_number:true
            },
           
           vehicle_no:
           {
           		required:true,
           		vehicle_number:true
           },
            address:{
                required:true,
                address1:true
            },
            categorytype:
            {
            	required:true,
            },
           
           
           
        },
        messages:{
            firstname:{
                required:"Please enter Firstname",
                n:"Enter valid staff firstname"
            },
            lastname:{
                required:"Please enter Lastname",
                n:"Enter valid staff lastname"
            },
            
            mobile_no:{
                required:"Please mobile number",
                mobile_number:"enter valid mobile_number"
            },
            vehicle_no:{
                required:"Please enter vehicle number",
                vehicle_number:"enter valid vehicle_number"
            },
            address:{
                required:"Please enter address",
                address1:"enter valid address"
            },
            categorytype:
            {
            	required:"please select staff category type",
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
                    $('#memberimg').attr('src', e.target.result);
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
                        <h3>Edit Staff Members</h3>
                    </div>
			<div class="ibox-content">
				
                                <form action="<?php echo base_url(); ?>owner_controller/updatestaff_cont" method="post" enctype="multipart/form-data" id="f1">
                                	<input type="text" name="sid" value="<?php if($sid) { echo $sid; }?>" hidden>

                                    <div class="form-group"><label>First Name</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Staff First Name" class="form-control" required="" value="<?php if($firstname) { echo $firstname; }?>"></div>
									<div class="form-group"><label>Last Name</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Staff Last Name" class="form-control" required="" value="<?php if($lastname) { echo $lastname; }?>"></div>
									<div class="form-group"><label>Gender</label> <br>
									<label class="radio-inline">
									      <input type="radio" name="gender" value="male"<?php echo ($gender =='male')?'checked':'' ?>>Male
									    </label>
									    <label class="radio-inline">
									      <input type="radio" name="gender" value="female"<?php echo ($gender =='female')?'checked':'' ?>>Female
									    </label>
									</div>
									<div class="form-group"><label>Staff Address</label> 
									<input  type="text" name="address" size="50" placeholder="Enter Staff Address" class="form-control" required="" value="<?php if($address) { echo $address; } ?>">
									</div>
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="text" name="mobile_no" size="50" placeholder="Enter Staff Mobile Number" class="form-control" value="<?php if($mobile_no) { echo $mobile_no; } ?>"></div>
									<div class="form-group"><label>Vehicle Number</label> 
									<input  type="text" name="vehicle_no" size="50" placeholder="Enter Staff vehicle Number" class="form-control" required="" value="<?php if($vehicle_no) { echo $vehicle_no; } ?>"></div>
									
									<div class="form-group"><label>Staff  Category</label> <br>
									<select name="categorytype" style="background-color: #FFFFFF;
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
										<option <?php if ($category == 'Dance Teacher' ) echo 'selected' ; ?> value="Dance Teacher">Dance Teacher</option>
										<option <?php if ($category == 'Tutor' ) echo 'selected' ; ?> value="Tutor">Tutor </option>
										<option <?php if ($category == 'Karate Master' ) echo 'selected' ; ?> value="Karate Master">Karate Master </option>
										<option <?php if ($category == 'Drwaing Teacher' ) echo 'selected' ; ?> value="Drawing Teacher">Drwaing Teacher </option>
										<option <?php if ($category == 'Psychologist' ) echo 'selected' ; ?> value="Psychologist">Psychologist </option>
									</select>
								</div>

								<div class="form-group"><label>Staff Pic</label>
									<input type="file" name="file" size="50" placeholder="Select Image"  onchange="readURL(this)";></div>
                    <?php if($invalid = $this->session->flashdata('image_error')) { ?>
									<div>
										<!--updateimage-->
									                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>

										<?php if(isset($row->pic)) { ?>
										<div id="realimg">
										<img src="<?php echo base_url(); ?>img/owner/staff/<?php echo $pic; ?>" height="100px" width="100px" class="img-responsive">
										</div>
										<?php } ?>
									<input type="text" name="updatepic" value="<?php echo $pic; ?>" hidden>
									<div id="imgdiv">
										<img src="" height="100px" width="100px" class="img-responsive" id="memberimg">
									</div>
                               		
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Edit</strong></button>
									</div><br><br><br>
									</form>
					<center><p> <a href="<?php echo base_url(); ?>owner_controller/staff_list_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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