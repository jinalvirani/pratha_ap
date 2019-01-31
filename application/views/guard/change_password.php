<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> CHANGE PASSWORD | PRATHA </title>

    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	

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
</head>

<?php include('changepassword_index.php'); ?>
<body class="gray-bg">
<div id="wrapper">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">Change Password</h2>
                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="<?php echo base_url();?>guard_controller/guardprofile_cont" method="post">
                                <?php if($invalid = $this->session->flashdata('repassword_error')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-danger">
                                                <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($invalid = $this->session->flashdata('changepass')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-success">
                                                <strong>Done ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($invalid = $this->session->flashdata('changepass_error')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-danger">
                                                <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input type="password" class="form-control password" name="curr_password" placeholder="Enter Your Current Password" required="" minlength="6">
                                </div>
								<div class="form-group">
                                    <input type="password" class="form-control password" name="password" placeholder="Enter your new password" required="" minlength="6">
                                </div>
								<div class="form-group">
                                    <input type="password" class="form-control password" name="repassword" placeholder="Re-Enter your new password" required="" minlength="6">
                                </div>
								<input type="checkbox" id="showHide"/>
								<label for="showHide" id="showHideLabel">Show Password</label>
								<br><br><br>
                                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Change</button>
								<div class="pull-right">
								
								</div>
								<a href="<?php echo base_url(); ?>guard_controller/forgotpassword_cont"><small>Forgot Password?</small></a>
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
