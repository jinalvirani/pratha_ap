<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Reset Password | PRATHA</title>
     <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
<?php if($invalid = $this->session->flashdata('resetpass')){  ?>
    <script>
        $(document).ready(function () {
    swal({
        title: "Reset Password",
        text:"reset Password successfully..",
        type: "success",
        closeOnConfirm: false,
        closeOnCancel: false
        });

});
    </script>
<?php } ?>

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

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Reset password</h2>

                    <p>
                        
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="<?php echo base_url(); ?>owner_controller/reset_password_cont" method="post"><?php if($invalid = $this->session->flashdata('repassword_error')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-danger">
                                                <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                          
                                <?php if($invalid = $this->session->flashdata('resetpass_error')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-danger">
                                                <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Enter Username" required="">
                                </div>
								<div class="form-group">
                                    <input type="password" class="form-control password" name="password" placeholder="Enter your new password" required="" minlength="6">
                                </div>
								
								<div class="form-group">
                                    <input type="password" class="form-control password" name="repassword" placeholder="Re-Enter your new password" required="" minlength="6">
                                </div>
								<input type="checkbox" id="showHide" />
								<label for="showHide" id="showHideLabel">Show Password</label>

                                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Send</button>
								
								<div class="pull-right">
								<a href="<?php echo base_url(); ?>owner_controller/index"><small>go to login page</small></a>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                by Techbit infotech
            </div>
            <div class="col-md-6 text-right">
               <small><div class="pull-right">&#169; Copyright <?php date_default_timezone_set("Indian/Antananarivo"); echo date("Y"); ?> <br> All Rights Reserved.<small>
            </div>
        </div>
    </div>

</body>

</html>
