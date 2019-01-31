<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $fname=$ut->firstname;
        $lname=$ut->lastname;
        $uname=$ut->username;
        $email=$ut->email;
        $pic=$ut->pic;
        $mobile=$ut->mobile_no;

    }
   
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CHANGE PROFILE | PRATHA</title>

    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>

<style>
#showHide {
  width: 15px;
  height: 15px;
  float: left;
}
#showHideLabel {
  float: left;
  padding-left: 5px;
}
</style>
<script>


$(document).ready(function(){
    
    $.validator.addMethod("n", function(value, element) {
        
            return this.optional(element) || /^[a-zA-Z]+$/.test(value);
        }, "Enter only character");
    $.validator.addMethod("usernm", function(value, element) {
        
            return this.optional(element) || /^[a-zA-Z0-9._]+$/.test(value);
        }, "enter valid username");
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
            mobile_no:{
                required:true,
                mobile_number:true
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
            
            mobile_no:{
                required:"Please enter mobile number",
                mobile_number:"enter valid mobile_number"
            },
            
             email:{
                required:"please enter email",
                email_add:"enter valid email address"
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
                    $('#user_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>
</head>

<?php include('changepassword_index.php'); ?>

<body class="gray-bg">
<div id="wrapper">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Change Profile</h2>
                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="<?php echo base_url(); ?>guard_controller/guardedit_cont" method="post" enctype="multipart/form-data" id="form1">
                                <?php if($invalid = $this->session->flashdata('editguard')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-success">
                                                <strong>Done ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                 <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" required="" value="<?php if($fname) { echo $fname; }?>">
                </div>
                 <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php if($lname) { echo $lname; }?>" >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if($uname) { echo $uname; }?>">
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
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if($email) { echo $email; }?>">
                </div>
                
                
                 <div class="form-group">
                     <input type="number" class="form-control" placeholder="Mobile_No" name="mobile_no" value="<?php if($mobile) { echo $mobile; }?>">   
                </div>
                
                <div class="form-group"><label>Guard Pic</label>
                                    <input type="file" name="file" size="50" placeholder="Select Image"  onchange="readURL(this)";></div>
                                    <div>
                                        <!--updateimage-->
                                        <?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-danger">
                                                <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                        <?php if(isset($ut->pic)) { ?>
                                        <div id="realimg">
                                        <img src="<?php echo base_url(); ?>img/guard/<?php echo $pic; ?>" height="100px" width="100px" class="img-responsive">
                                        </div>
                                        <?php } ?>
                                    <input type="text" name="updatepic" value="<?php echo $pic; ?>" hidden>
                                    <div id="imgdiv">
                                        <img src="" height="100px" width="100px" class="img-responsive" id="user_image">
                                    </div>
                        <br>
                        <br>
                        <br>
                
        
                <button type="submit"  name="cange" class="btn btn-primary block full-width m-b">Change</button>
                <br>
                <br>

            </form>

            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
    </div>

<script>
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
 <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>	
</body>

</html>
