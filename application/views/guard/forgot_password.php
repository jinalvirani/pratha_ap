<!DOCTYPE html>
<html>
<head>
<style>
.myform,body,html{
	height:100%;
	width:100%;
	background-color:rgb(243,243,244);
}
</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Forgot password | PRATHA </title>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>

    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <?php if($invalid = $this->session->flashdata('resetmsg')){  ?>
    <script>
        $(document).ready(function () {
    swal({
        title: "Reset Password",
        text:"reset link sent successfully..",
        type: "success",
        closeOnConfirm: false,
        closeOnCancel: false
        }
        );

});
    </script>
<?php } ?>
</head>
<body>
<div class="myform">
    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">
					<h2 class="font-bold">Forgot password</h2>
                    <p>
                        Enter your email address and you get reset password link on your email.
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="<?php echo base_url(); ?>guard_controller/reset_pass_link_contt" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email address" required="">
                                </div>
                                <button type="submit" name="submit" id="send" class="btn btn-primary block full-width m-b">Send</button>	
                                <div class="pull-right">
								<a href="<?php echo base_url(); ?>guard_controller/index"><small>go to login page</small></a>
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
                Design by techbit infotech
            </div>
            <div class="col-md-6 text-right">
               <small><div class="pull-right">&#169; Copyright <?php date_default_timezone_set("Indian/Antananarivo"); echo date("Y"); ?><br>Pratha Apartment<br> All Rights Reserved.<small>
            </div>
        </div>
    </div>
</div>
</body>

</html>
