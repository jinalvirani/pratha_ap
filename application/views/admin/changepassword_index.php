<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $utnm=$ut->username;
        $uttype=$ut->user_type;
        $utimg=$ut->pic;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title> CHANGE PASSWORD | PRATHA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url(); ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url(); ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    
    <!--round image-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/presentational.css">
    <!--<link rel="shortcut icon" href="css/favicon.ico">-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/circular-images.css">
    
   <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
  <link href='<?php echo base_url(); ?>css/style.css' type='text/css' rel='stylesheet'/>
<style>

.img img{
    margin-left:-10%;
}
.logo-element
{
    word-wrap:break-word;
}
.clear
{
    word-wrap:break-word;
}
.scrollable-menu {
    height: auto;
    max-height: 360px;
    overflow-x: hidden;
}
</style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation" >
        
        <div class="img">
           <a href="<?php echo base_url(); ?>admin_controller/showadmin"><img src="<?php echo base_url(); ?>img/logo2.jpeg" width="40%" style="margin-left:10px;" width="90%"></a>
        </div>
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                    
                        <div class="dropdown profile-element"> <span>
                            <div class="circular--square circular--landscape circular--portrait">
                          <a href="<?php echo base_url(); ?>admin_controller/admineditfill_cont"><img src="<?php echo base_url(); ?>img/admin/<?php echo $utimg ?>"></a>
                            </div>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                             <span class="block m-t-xs"> 
                                <strong class="font-bold">
                                    <font size="4"><?php echo $utnm; ?>
                                        
                                    </font>
                                </strong>
                             </span> <span class="text-muted text-xs block"><?php echo $uttype; ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo base_url(); ?>admin_controller/changepassword_cont">Change Password</a></li>
                            </ul>
                        </div>
                          <div class="logo-element">
                            <p style="font-size:10px;"><a href="<?php echo base_url(); ?>admin_controller/admineditfill_cont"><?php echo $utnm; ;?></a></p><a style="color:black;" data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                                <span class="text-muted text-xs block" style="font-size:10px;"><?php echo $uttype; ?> <b class="caret"></b>
                                </span> 
                            
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs" style="color:black">
                            <li><a href="<?php echo base_url(); ?>admin_controller/changepassword_cont" >Change Password</a></li>
                        </ul>
                        </div>
                    </li>
                    
                   <li>
                        <a href="<?php echo base_url(); ?>admin_controller/newadmin_cont">
                        <i style="font-size:24px" class="fa">&#xf234;</i> 
                        <span class="nav-label">NEW ADMIN</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin_controller/associative_cont">
                        <i style="font-size:24px" class="fa">&#xf234;</i> 
                        <span class="nav-label">ASSOCIATIVE MEMBER</span>
                        </a>
                    </li>
                    <li>
                       <a href="<?php echo base_url(); ?>admin_controller/guard_cont">
                        <i style="font-size:22px" class="fa">&#xf234;</i> 
                        <span class="nav-label">SECURITY GUARD</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin_controller/vender_cont">
                        <i style="font-size:24px" class="fa fa-users"></i>
                        <span class="nav-label">VENDOR SERVICES</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin_controller/facility_cont">
                        <i style="font-size:24px" class="fa fa-edit"></i> 
                        <span class="nav-label">FACILITIES</span>
                        </a>
                    </li>
                    <li>
                         <a href="<?php echo base_url(); ?>admin_controller/notice_cont">
                        <i style="font-size:24px" class="fa fa-pencil"></i>
                        <span class="nav-label">NOTICES</span>
                        </a>
                    </li>
                    <li >
                        <a href="<?php echo base_url();?>admin_controller/poll_cont">
                        <i style="font-size:24px" class="fa fa-thumbs-up"></i>
                        <span class="nav-label">POLLS</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
</div>

    <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn  btn-primary "><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span>Notification</a>
                    <ul class="dropdown-menu scrollable-menu" role="menu" id="jinal"></ul>
                </li>
                   
                    <li>
                        <a href="<?php echo base_url(); ?>admin_controller/logout_cont">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                    </ul>
            </div>
    
  
  
    
    <!-- Mainly scripts -->
   

    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo base_url(); ?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url(); ?>js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo base_url(); ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="<?php echo base_url(); ?>js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo base_url(); ?>js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo base_url(); ?>js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>js/plugins/toastr/toastr.min.js"></script>


    <script>
    </script>
    <script>
        function load_unseen_notification(view = '')
        {
            // alert("unseen");
            $.ajax({
                url:"<?php echo base_url(); ?>/admin_controller/fetch_notification",
                type:"POST",
                data:{view:view},
                dataType:"json",
                success:function(data)
                {

                    $('#jinal').html(data.notification);
                     if(data.unseen_notification > 0)
                    {
                        $('.count').html(data.unseen_notification);
                    }
                    
                }
            });
        }
        
        load_unseen_notification();

        $(document).on('click', '#jinal',function(){
            $('.count').html('');
            load_unseen_notification('yes');

        })
        setInterval(function(){
            load_unseen_notification();
        },5000);
</script>
</body>
</html>
