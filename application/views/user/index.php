<!DOCTYPE html>
<html>
<head>
<title> USER LOGIN | PRATHA </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
.img-logo{
    
    background-color:rgb(243,243,243);
    //opacity:0.8;
    padding-top:20%;
}
.logo{
    opacity:0.3;
}
</style>
</head>

<div class=" text-center loginscreen   animated fadeInDown">
<div class="logo">
    <h1 style="font-size: 70px;font-weight:800"><font color="gray">PRATHA</font></h1>
    <h1 style="font-size: 30px;font-weight:500">APARTMENT</h1>
</div>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown" style="padding-top: 10px;">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">USER LOGIN</h2>
                <hr>
                <div class="img-logo">
                
                <img src="<?php echo base_url();?>img/logo.jpeg" height="160px" width="350px" class="img-responsive"></div>
            
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="<?php echo  base_url(); ?>owner_controller/ownerlogin_cont" method="post">
                        <?php if($invalid = $this->session->flashdata('loginfailed')) { ?>

                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="password form-control" placeholder="Password" name="password" required="">    
                        </div>
                        <input type="checkbox" id="showHide" />
                        <label for="showHide" id="showHideLabel">Show Password</label>
                        <br>
                        <br>
                        <br>
                          <button type="submit" name="login" class="btn btn-primary block full-width m-b">Login</button>
                        <small>Forgot password?
                            <a href="<?php echo base_url(); ?>owner_controller/forgotpassword_index_cont">
                            Click Hear!
                        </a></small>
                        <br><br>
                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url(); ?>owner_controller/registration_view">Create an account</a>
                    </form>
                    <p class="m-t">
                       
                    </p>
                    <p class="m-t">
                       
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6 text-right">
               <small><div class="pull-right">&#169; Copyright <?php date_default_timezone_set("Indian/Antananarivo"); echo date("Y"); ?>   Pratha Apartment.All Rights Reserved.<small>
               <br>Design by Techbit Infotech
            </div>
        </div>
        
    </div>
</div>
</body>

</html>
