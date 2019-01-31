<!DOCTYPE html>
<html>
<head>
<title> DIRECTORY |  PRATHA </title>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#abc').delay(8000).fadeOut();
      });
    </script>
<style>
/*
 * Table wrapper
 */
.dataTables_wrapper 
{
	position: relative;
	clear: both;
	*zoom: 1;
}
/*
 * Filter
 */
.dataTables_filter 
{
	float: right;
	text-align: right;
}
</style>

<title>ADMIN | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are you sure to delete  this data...?");
 }
</script>
</head>
<body>
<div id="wrapper">
	<?php include('dashboard_index.php'); ?>	
		<!-- =======================================table================================= -->
		
			
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Contact Numbers</h5>
                    </div>
	
	<div class="ibox-content">
		 <div class="row">
       <div class="col-sm-1"></div>
       <div class="col-sm-2" style="margin-top: 10px;"><h3>Pic</h3>
       </div>
       <div class="col-sm-2" style="margin-top: 10px;"><h3>Firstname</h3></div>
       <div class="col-sm-1" style="margin-top: 10px;"><h3>Flatno</h3></div>
       <div class="col-sm-2" style="margin-top: 10px;"><h3>Type</h3></div>
       <div class="col-sm-4" style="margin-top: 10px;"><h3>Mobile_no</h3></div>
       
      </div>
      <div class="row">
       <div class="col-sm-1"></div>
       <div class="col-sm-10"><hr><hr></div>
       <div class="col-sm-1"></div>
      </div>
	<?php  if(isset($directorys))
	{
		foreach($directorys as $row)
		{   ?>

					
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-2">
								<div class="circular--square circular--landscape circular--portrait">
									<img src="<?php echo base_url(); ?>img/owner/<?php echo $row->pic; ?>">
								</div>
							</div>
							<div class="col-sm-2" style="margin-top: 10px;"><h3><?php echo $row->firstname; ?></h3></div>
							<div class="col-sm-1" style="margin-top: 10px;"><h3><?php echo $row->wing_name."-".$row->home_no;?></h3></div>
							<div class="col-sm-2" style="margin-top: 10px;"><h3><?php echo $row->user_type; ?></h3></div>
							<div class="col-sm-4"><i style="font-size:30px;margin-top: 12px;" class="fa fa-phone"></i>&nbsp;<span style="font-size:20px;">   <?php echo $row->mobile_no;?></span></div>
							
						</div>
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-10"><hr></div>
							<div class="col-sm-1"></div>
						</div>
						
						
<?php }
	
	}
	else
	{ ?>
		<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6"><h3><center>No Contact Found</center></h3></div>
		<div class="col-sm-3"></div>
		</div>
<?php	}
	?>

 <center><p> <a href="<?php echo base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>


               		 </div>
            </div>
        </div>
    </div>
</div>
  

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

<?php include('footer.php'); ?>  
</body>
</html>