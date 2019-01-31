<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
       
        $wingid=$ut->wing_id;
        $wing_name=$ut->wing_name;
        $homeid=$ut->home_id;
        $land_line_no=$ut->land_line_no;
        $address=$ut->address;
        //$homeno=$ut->home_no;
    }
    
}
if(isset($home_no))
{
    foreach($home_no as $row)
    {
       
      
        $homeno=$row->home_no;
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
<title>TENANT | PRATHA</title>
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
        }, "at least 6 character length");
        $.validator.addMethod("age_number", function(value, element) {
        
            return this.optional(element) || /^[0-9]{2}$/.test(value);
        }, "Enter only digit");

       
        $.validator.addMethod("mobile_number", function(value, element) {
        
            return this.optional(element) || /^[789]\d{9}$/.test(value);
        }, "Enter only digit");
         
         $.validator.addMethod("email_add", function(value, element) {
        
            return this.optional(element) || /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(value);
        }, "Enter valid email");
    $("#form1").validate({
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
            wing_no:{
                required:true,
            },
            home_no:{
                required:true,
            },
            city:{
                required:true,
            },
            age:{
                required:true,
                age_number:true
            },
            mobile_no:{
                required:true,
                mobile_number:true
            },
            
            
            file:{
                required:true,
                
            },
            email:{
                required:true,
                email_add:true
            },
           
           
           


            
        },
        messages:{
            firstname:{
                required:"Please enter Firstname",
                n:"Enter valid  owner firstname"
            },
            lastname:{
                required:"Please enter Lastname",
                n:"Enter valid owner lastname"
            },
            username:{
                required:"Please enter username",
                usernm:"Enter valid username"
            },
            password:{
                required:"please enter Password",
                pass:"at least 6 character"
            },
            wing_no:{
                required:"Please select wingno",
            },
            home_no:{
                required:"Please select homeno",
            },
            city:{
                required:"Please select city",
            },
            age:{
                required:"Please enter Age",
                age_number:"enter valid age"
            },
            mobile_no:{
                required:"Please enter mobile number",
                mobile_number:"enter valid mobile_number"
            },
            
            file:{
                required:"Please select profile_pic",
            },
              email:{
                required:"please enter email",
                email_add:"enter valid email address"
            },
           
            
            
            
            
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


        $(document).ready(function() {
          $("#showHide").click(function() {
            if ($(".password").attr("type") == "password") {
              $(".password").attr("type", "text");

            } else {
              $(".password").attr("type", "password");
            }
          });
        });
</script>


</head>

<body>
   <div id="wrapper">
   <?php include('myunit_index.php'); ?> 

   
		<!-- =======================================table================================= -->
		  <?php if($invalid1 = $this->session->flashdata('already_tenant')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid1; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Tenant</h3>
                    </div>
			<div class="ibox-content">
				
				<form class="m-t" role="form" action="<?php echo base_url(); ?>owner_controller/register_tenat_cont" method="post" enctype="multipart/form-data" id="form1">
        
                     	 <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" required="">
                </div>
                 <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" >
                </div>
                <?php if($invalid1 = $this->session->flashdata('username')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid1; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                <div class="form-group">
                    <input type="password" class="password form-control" name="password" placeholder="password" minlength="6" >
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" >
                </div>
                <div class="form-group">
       				<label class="radio-inline">
     			 		<input type="radio" name="gender" value="female">female
   					 </label>
   					 <label class="radio-inline">
      					<input type="radio" name="gender" checked value="male">male
   					 </label>
				</div>
				<div class="form-group">
                     <input type="number" class="form-control" placeholder="Age" name="age">	
				</div>
               
				
				 <div class="form-group">
                     <input type="number" class="form-control" placeholder="Mobile_No" name="mobile_no" >	
				</div>
				<div class="form-group">
                     <input type="number" class="form-control" placeholder="Land_Line_No" name="land_line_no" value="<?php if($land_line_no) { echo $land_line_no; }?>" readonly>

				</div>				
					
			
				 <div class="form-group">
                     <select name="wing_no" class="form-control" id="wing_no">
                     	<option value="<?php if($wingid) { echo $wingid; } ?>"><?php echo $wing_name;?></option>           
                     </select>
				</div>
				<div class="form-group">
                     <select name="home_no" class="form-control" id="home_no">
                     <option hidden value="<?php if($homeid) { echo $homeid; }?>"><?php echo $homeno; ?></option>
                     	
                     </select>
				</div>
                
                 <div class="form-group">
                     <select name="city" class="form-control">
                        <option hidden value="">--select city--</option>
                        <?php 
            foreach($city  as $row1)
            { 
              echo '<option value="'.$row1->city_id.'">'.$row1->city_name.'</option>';
                
            }
            ?>
                     </select>
                </div>
                <div class="form-group">
                     <textarea class="form-control"  name="address" readonly><?php if($address) { echo $address; } ?></textarea>    
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
				<div class="form-group">
                     <input type="file" name="file" onchange="readURL(this);">	
                     
				</div>
				<div id="imgdiv">
				<img src="" name="display_pic" class="img-responsive" height="100" width="100" id="user_image">

				</div>



						<input type="checkbox" id="showHide"/>
						<label for="showHide" id="showHideLabel">Show Password</label>
						<br>
						<br>
						<br>
                
          <div>
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Add Tenant</strong></button>
                  </div><br><br><br>

               
            </form>


				

					<center><p> <a href="<?php echo base_url(); ?>owner_controller/display_memberlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                    </div>
                    </div>
                
            </div>
            </div>
			</div>

			  
			  
            
        
    
    <!-- Mainly scripts -->
 <!--   <script src="<?php echo base_url(); ?>js/jquery-2.1.1.js"></script>-->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<script src="<?php echo  base_url(); ?>js/plugins/pace/pace.js"></script>
    <!-- iCheck -->
    <script src="http://localhost/pratha/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <script type="text/javascript">


   $(document).ready(function(){
    $('#wing_no').on('change',function(){
        var wing_id=$(this).val();
        
        if(wing_id == '')
        {
            $('#home_no').prop('disabled',true);
        }
        else
        {
             $('#home_no').prop('disabled',false);
             $.ajax({

                url:"<?php echo base_url() ?>owner_controller/fillhome_cont",
                type:"POST",
               
                data:{
                    'wing_id' : wing_id, 
                },
                 dataType:'json',
                success:function(data)
                {
                   $('#home_no').html(data);

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