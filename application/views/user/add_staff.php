

<!DOCTYPE html>
<html>
<head>
    <title>STAFF | PRATHA</title>

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
        
            return this.optional(element) || /^[1-9a-zA-Z ,.-_]+$/.test(value);
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
           
         vehicle_no:{
                required:true,
                vehicle_no:true 
           },
            address:{
                required:true,
                address1:true
            },
            categorytype:
            {
            	required:true,
            },
           
            file:{
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
                required:"please vehicle no",
                vehicle_no:"Eneter valid vehicle number "
           },
            address:{
                required:"Please enter address",
                address1:"enter valid address"
            },
            categorytype:
            {
            	required:"please select staff category type",
            },
			

            file:{
                required:"Please select profile_pic",
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
                        <h3>Add Staff Members</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>owner_controller/addstaff_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>First Name</label> 
                                    <input  type="text" name="firstname" size="50" placeholder="Enter Member First Name" class="form-control"></div>
                                     <div class="form-group"><label>Last Name</label> 
                                    <input  type="text" name="lastname" size="50" placeholder="Enter Member Last Name" class="form-control"></div>
                                    <div class="form-group"><label>Gender</label> <br>
                                    <label class="radio-inline">
                                          <input type="radio" name="gender" value="male" checked>Male
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="gender" value="female">Female
                                        </label>
                                    </div>
                                    <div class="form-group"><label>Staff Address</label> 
                                    <input  type="text" name="address" size="50" placeholder="Enter Staff Address" class="form-control">
                                    </div>
                                    <div class="form-group"><label>Mobile Number</label> 
                                    <input  type="number" name="mobile_no" size="50" placeholder="Enter Staff Mobile Number" class="form-control"></div>
                                    <div class="form-group"><label>Vehicle Number</label> 
                                    <input  type="text" name="vehicle_no" size="50" placeholder="Enter Staff Vehicle Number" class="form-control"></div>   
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
  font-size: 14px;" value="">
                                        <option value="" hidden>--Select--</option>
                                        <option>Tutor</option>
                                        <option>Dance Teacher </option>
                                        <option>Karate Master </option>
                                        <option>Drwaing Teacher </option>
                                        <option>Psychologist </option>
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
                                  <div class="form-group"><label>Staff Pic</label>
                                     <input type="file" name="file" onchange="readURL(this);">    
                                    </div>
                                    <div id="imgdiv">
                                    <img src="" name="display_pic" class="img-responsive" height="100" width="100" id="user_image">

                                    </div>

                                        <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
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