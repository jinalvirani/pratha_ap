<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $utid=$ut->user_id;
        $utnm=$ut->username;
        $uttype=$ut->user_type;
        $utimg=$ut->pic;
        $is_resident=$ut->is_resident;

    }
   
}

if(isset($member))
{
    foreach($member as $row)
    {
    
     $mobile_no=$row->mobile_no;
   $username = "viranimiral13@gmail.com";
    $hash = "a318977596944c08238d80c44621b68d0edcc5da45b1827801ba47db7823783b";

    // Config variables. Consult http://api.textlocal.in/docs for more info.
    $test = "0";

    // Data for text message. This is the text message data.
    $sender = "TXTLCL"; // This is who the message appears to be from.
    $numbers = "$mobile_no"; // A single number or a comma-seperated list of numbers
    $message = "Emergency..... please help me";
    // 612 chars or less
    // A single number or a comma-seperated list of numbers
    $message = urlencode($message);
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
    $ch = curl_init('http://api.textlocal.in/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); // This is the result from the API
    curl_close($ch);

    }


    $emergency=array();
    $emergency['emergency_notification']=1;
    if($this->owner_model->emergency_notification_mdl($emergency,$utid))
    {
        $emergency_noti=$this->owner_model->emergency_notification_mdl($emergency,$utid);
        
    }

}

?>
<?php
    // Authorisation details.
    
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
	
	<title>USER | PRATHA</title>
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
        <a href="<?php echo base_url(); ?>owner_controller/showowner_cont"><img src="<?php echo base_url(); ?>img/logo2.jpeg" width="40%" style="margin-left: 10px;"></a>
        </div>
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                    
                        <div class="dropdown profile-element"> <span>
                
                        
                            <div class="circular--square circular--landscape circular--portrait">
                             <a href="<?php echo base_url(); ?>owner_controller/change_profile_cont"><img src="<?php echo base_url(); ?>img/owner/<?php echo $utimg; ?>"></a>
                            
                            </div>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><font size="4"><?php echo $utnm; ?></font></strong>
                            
                             </span> <span class="text-muted text-xs block"><?php echo $uttype; ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo base_url(); ?>owner_controller/changepassword_cont">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            <p style="font-size:10px;"><a href="<?php echo base_url(); ?>owner_controller/change_profile_cont"><?php echo $utnm; ;?></a></p><a style="color:black;" data-toggle="dropdown" class="dropdown-toggle">
                            
                                <span class="text-muted text-xs block" style="font-size:10px;"><?php echo $uttype; ?> <b class="caret"></b>
                                </span> 
                            
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs" style="color:black">
                            <li><a href="<?php echo base_url(); ?>owner_controller/changepassword_cont" >Change Password</a></li>
                        </ul>
                        </div>
                    </li>
					<?php if($is_resident == "no")
                    {
                        ?>
					<li>
                        <a>
                        <i style="font-size:24px" class="fa fa-building-o"></i>
                        <span class="nav-label">MY APARTEMENT</span> 
                        </a>
                    </li>
               <?php  }
               else
               { ?>
            
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/my_apartment_list_cont">
                        <i style="font-size:24px" class="fa fa-building-o"></i>
                        <span class="nav-label">MY APARTEMENT</span> 
                        </a>
                    </li>

               <?php }
                ?>
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont">
                        <i style="font-size:24px" class="fa fa-th-large"></i> 
                        <span class="nav-label">MY UNIT</span>
                        </a>
                    </li>
                    <?php if($is_resident == "no")
                    {
                        ?>
                    <li>
                        <a>
                        <i style="font-size:24px" class="fa fa-pencil"></i>
                        <span class="nav-label">BOOK FACILITIES</span>
                        </a>
                    </li>
                     <?php  }
               else
               { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/bookfacility_list_cont">
                        <i style="font-size:24px" class="fa fa-pencil"></i>
                        <span class="nav-label">BOOK FACILITIES</span>
                        </a>
                    </li>
               <?php } ?>  
                <?php if($is_resident == "no")
                    {
                        ?>   
                    <li>
                        <a>
                        <i style="font-size:24px" class="fa fa-users"></i>
                        <span class="nav-label">VENDER SERVICIES</span>
                        </a>
                    </li>
                     <?php  }
               else
               { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/venderlist_cont">
                        <i style="font-size:24px" class="fa fa-users"></i>
                        <span class="nav-label">VENDOR SERVICIES</span>
                        </a>
                    </li>
                <?php } ?>     

                     <?php if($is_resident == "no")
                    {
                        ?>
                     <li>
                        <a>
                        <i style="font-size:24px" class="fa">&#xf02d;</i>
                        <span class="nav-label">DIRECTORY</span>
                        </a>
                    </li>
                     <?php  }
               else
               { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/directorylist_cont">
                        <i style="font-size:24px" class="fa">&#xf02d;</i>
                        <span class="nav-label">DIRECTORY</span>
                        </a>
                    </li>
                     <?php  }  ?>
                     <?php if($is_resident == "no")
                    {
                        ?>
                     <li>
                        <a>
                        <i style="font-size:24px" class="fa fa-file"></i>
                        <span class="nav-label">DOCUMENTS</span>
                        </a>
                    </li>
                     <?php  }
               else
               { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/document_cont">
                        <i style="font-size:24px" class="fa fa-file"></i>
                        <span class="nav-label">DOCUMENTS</span>
                        </a>
                    </li>
                     <?php  } ?>


                     <?php if($is_resident == "no")
                    {
                        ?>
                     <li>
                        <a>
                        <i style="font-size:24px; color:red;" class="fa fa-exclamation-triangle fa-5x"></i>
                        <span class="nav-label">PANIC ALERT</span>
                        </a>
                    </li>

                    <?php }

                    else
                    {
                        ?>
                    
                    <li>
                        <a href="<?php echo base_url(); ?>owner_controller/panicalert_cont">
                        <i style="font-size:24px; color:red;" class="fa fa-exclamation-triangle fa-5x"></i>
                        <span class="nav-label">PANIC ALERT</span>
                        </a>
                    </li>
                    <?php } ?>
					
                </ul>
            </div>
        </nav>
	</div>
    <div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="row border-bottom">
			<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					 <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
				</div>
				<ul class="nav navbar-top-links navbar-right">
					<li>
						<span class="m-r-sm text-muted welcome-message">Welcome to <b><?php echo $utnm; ?></b>
						</span>
					</li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span>Notification</a>
                        <ul class="dropdown-menu scrollable-menu" role="menu" id="jinal"></ul>
                    </li>
					<li>
						<a href="<?php echo base_url(); ?>owner_controller/logout_cont">
							<i class="fa fa-sign-out"></i> Log out
						</a>
					</li>
				</ul>
			</nav>
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
                url:"<?php echo base_url(); ?>/owner_controller/fetch_notification",
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

		<div class="text-center loginscreen   animated fadeInDown">
			<h1 class="logo-name"><font color="gray"><img src="<?php echo base_url(); ?>img/logo.jpeg" width="45%"></div></font></h1>
		</div>
</div>
</body>
</html>

