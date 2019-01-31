<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $utid=$ut->user_id;
        $utnm=$ut->username;
        $uttype=$ut->user_type;
        $utimg=$ut->pic;
    }
    $this->session->set_userdata('getloginid',$utid);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/presentational.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/circular-images.css">
    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

    <title>ADMIN | PRATHA </title>
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
.quick-actions_homepage {
    width:100%;
    text-align:center; position:relative;
    float:left;
    margin-top:10px;
}
.stat-boxes, .quick-actions, .quick-actions-horizontal, .stats-plain {
    display: block;
    list-style: none outside none;
    margin: 15px 0;
    text-align: center;
}
.stat-boxes2 {
    display: inline-block;
    list-style: none outside none;
    margin:0px; 
    text-align: center;
}
.stat-boxes2 li {
    display: inline-block;
    line-height: 18px;
    margin: 0 10px 10px;
    padding: 0 10px; background:#fff; border: 1px solid #DCDCDC
}
.stat-boxes2 li:hover{ background: #f6f6f6; }
.stat-boxes2 .left, .stat-boxes .right {
    text-shadow: 0 1px 0 #fff;
    float: left;
}
.stat-boxes2 .left {
    border-right: 1px solid #DCDCDC;
    box-shadow: 1px 0 0 0 #FFFFFF;
    font-size: 10px;
    font-weight: bold;
    margin-right: 10px;
    padding: 10px 14px 6px 4px;
}
.stat-boxes2 .right {
    color: #666666;
    font-size: 12px;
    padding: 9px 10px 7px 0;
    text-align: center;
    min-width: 70px; float:left
}
.stat-boxes2 .left span, .stat-boxes2 .right strong {
    display: block;
}
.stat-boxes2 .right strong {
    font-size: 26px;
    margin-bottom: 3px;
    margin-top: 6px;
}
.quick-actions_homepage .quick-actions li{ position:relative;}
.quick-actions_homepage .quick-actions li .label{ position:absolute; padding:5px; top:-10px; right:-5px;}
.stats-plain {
    width: 100%;
}
.stat-boxes li, .quick-actions li, .quick-actions-horizontal li {
    float: left;
    line-height: 18px;
    margin: 0 10px 10px 0px;
    padding: 0 10px;
}
.stat-boxes li a:hover, .quick-actions li a:hover, .quick-actions-horizontal li a:hover, .stat-boxes li:hover, .quick-actions li:hover, .quick-actions-horizontal li:hover {
    background: #293846;
}
.quick-actions li {
    min-width:20%;
    min-height:120px;
}
.quick-actions_homepage .quick-actions .span3{ width:30%;}
.quick-actions li, .quick-actions-horizontal li {
    padding: 0;
}
.bg_lb{ background:#27a9e3;}
.bg_db{ background:#2295c9;}
.bg_lg{ background:#28b779;}
.bg_dg{ background:#28b779;}
.bg_ly{ background:#b9b624;}
.bg_dy{ background:#da9628;}
.bg_ls{ background:#2255a4;}
.bg_lo{ background:#da542e;}
.bg_lr{ background:#f74d4d;}
.bg_lv{ background:#603bbc;}
.bg_lh{ background:#b6b3b3;}
.scrollable-menu {
    height: auto;
    max-height: 360px;
    overflow-x: hidden;
}

</style>

</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="img">
           <a href="<?php echo base_url(); ?>admin_controller/showadmin"><img src="<?php echo base_url(); ?>img/logo2.jpeg" width="40%" style="margin-left:10px;" width="90%"></a>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                        <span>
                            
                            <div class="circular--square circular--landscape circular--portrait">
                                <a href="<?php echo base_url(); ?>admin_controller/admineditfill_cont"><img src="<?php echo base_url(); ?>img/admin/<?php echo $utimg ?>"></a>
                            </div>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> 
                                <span class="block m-t-xs"> 
                                    <strong class="font-bold">
                                        <font size="4"><?php echo $utnm; ?></font>
                                    </strong>
                                </span> 
                                <span class="text-muted text-xs block"><?php echo $uttype; ?> <b class="caret"></b>
                                </span> 
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo base_url(); ?>admin_controller/changepassword_cont" >Change Password</a></li>
                        </ul>
                    </div>
                    <!--chng-->
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
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary">
                        <i class="fa fa-bars"></i> 
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to <b><?php echo $utnm;?></b>
                        </span>
                    </li>
                    <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" ><span class="label label-pill label-danger count"></span>Notification</a>
                <ul class="dropdown-menu scrollable-menu" role="menu" id="jinal"></ul>

        </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin_controller/logout_cont">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
         <div class="row wrapper border-bottom white-bg page-heading">   
                <div class="col-lg-10">
                    <h2><center>PRATHA APARTEMENT</center></h2>
                </div>
         </div>
 <div id="wrapper">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class=""> 
                        </div>
                        <div class="row">
                            <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <?php
        if(isset($wings))
        {
            $wings = count($wings);
        }
        if(isset($homes))
        {
            $homes = count($homes);
        }
        if(isset($owners))
        {
            $owner = count($owners);
        }
    
        if(isset($tenants))
        {
            $tenant = count($tenants);
        }
        if(isset($bookings))
        {
            $bookings = count($bookings);
        }
        if(isset($directorys))
        {
            $directorys = count($directorys);
        }
        if(isset($maintanances))
        {
            $maintanances = count($maintanances);
        }

         if(isset($tolexpense))
        {
           
            foreach($tolexpense as $tol)
            {
                $amount = $tol->amount;
                @$tolexp = $tolexp+ $amount; 
            }
        }
         if(isset($tolrevenue))
        {
           
            foreach($tolrevenue as $tol)
            {
                $amount = $tol->amount;
                $penalty = $tol->penalty;

                @$tols = $tols + $amount + $penalty; 
            }
        }
         if(isset($tolrevenuetbl))
        {
           
            foreach($tolrevenuetbl as $tol)
            {
                $amount = $tol->amt;
                @$tols = $tols + $amount; 
            }
        }
       
         if(isset($bookingrevenue))
        {
           
            foreach($bookingrevenue as $tol)
            {
                $amount = $tol->total_charge;
               
                @$tols = $tols + $amount; 
            }
        }
         if(isset($bookingrevenue_penalty))
        {
           
            foreach($bookingrevenue_penalty as $tol)
            {
               
                 $penalty = $tol->penalty;

                @$tols = $tols + $penalty; 
            }
        }
       // $tol_booking_revenue = $tols + $tols;
         if(isset($issues))
        {
            $issue = count($issues);
        }
         if(isset($requests))
        {
            $request = count($requests);
        }



        ?>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_new_request_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-bell"></i><span class="label label-danger"><?php if(isset($request)) { echo $request; } else { echo "0"; }  ?></span><br><h5>NEW_REQUESTS&nbsp;</h5></li></a>


        <a href="<?php echo base_url(); ?>admin_controller/dashboard_wing_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px;margin-bottom: 20px;"> <i style="font-size:30px" class="fa fa-building-o"></i><span class="label label-danger"><?php if(isset($wings)) { echo $wings; } else { echo "0"; } ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WINGS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

         <a href="<?php echo base_url(); ?>admin_controller/dashboard_home_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px;margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-home"></i><span class="label label-danger"><?php if(isset($homes)) { echo $homes; } else { echo "0"; } ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOMES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_owner_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px;margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-user"></i><span class="label label-danger"><?php if(isset($owner)) { echo $owner; } else { echo "0"; } ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OWNERS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_tenant_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-user"></i><span class="label label-danger"><?php if(isset($tenant)) { echo $tenant; } else { echo "0"; }  ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;TENANTS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_booking_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-edit"></i><span class="label label-danger"><?php if(isset($bookings)) { echo $bookings; } else { echo "0"; }  ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;BOOKING&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>


        <a href="<?php echo base_url(); ?>admin_controller/dashboard_maintanance_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-rupee"></i><span class="label label-danger"><?php if(isset($maintanances)) { echo $maintanances; } else { echo "0"; }  ?></span><br><h5>MAINTENANCE&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_expense_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class=" fa fa-arrow-circle-o-up"></i><span class="label label-danger"><?php if(isset($tolexp)) { echo $tolexp; } else { echo "0"; }  ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;EXPENSES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_revenue_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class=" fa fa-arrow-circle-o-down"></i><span class="label label-danger"><?php if(isset($tols)) { echo $tols; } else { echo "0"; }  ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;REVENUES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_directory_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa">&#xf02d;</i><span class="label label-danger"><?php if(isset($directorys)) { echo $directorys; } else { echo "0"; }  ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIRECOTORY</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_issue_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-exclamation-circle"></i><span class="label label-danger"><?php if(isset($issue)) { echo $issue; } else { echo "0"; }  ?></span><br><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISSUES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5></li></a>

        <a href="<?php echo base_url(); ?>admin_controller/dashboard_document_cont" style="color: white"><li class="bg_ly" style="padding: 30px;margin-left: 30px; margin-bottom: 20px;"><i style="font-size:30px" class="fa fa-file"></i><span class="label label-danger"></span><br><h5>&nbsp;&nbsp;&nbsp;DOCUMENTS&nbsp;</h5></li></a>
       
      </ul>
    </div>
                        </div>
                   
                    
                  
                </div>
            </div>
        </div>
     </div>
 </div>
        <?php include('footer.php');?>
        <script src="<?php echo base_url(); ?>js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.spline.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/peity/jquery.peity.min.js"></script>
        <script src="<?php echo base_url(); ?>js/demo/peity-demo.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/gritter/jquery.gritter.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>js/demo/sparkline-demo.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/chartJs/Chart.min.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>
        <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Pratha Apartment', 'Welcome to <?php echo $utnm; ?>');
            }, 1300);
            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#b9b624", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );
            var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#b9b624",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#b9b624",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#A4CEE8",
                    highlight: "#b9b624",
                    label: "Laptop"
                }
            ]
            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#b9b624",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#b9b624",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#A4CEE8",
                    highlight: "#b9b624",
                    label: "Laptop"
                }
            ];
            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);
        });
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
</div>
</body>
</html>

