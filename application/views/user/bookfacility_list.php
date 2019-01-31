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
    //$this->session->set_userdata('getloginid',$utid);
}


?>

<!DOCTYPE html>
<html>
<head>
<title>FACILITY | PRATHA</title>
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

<title>BOOK FACILITY | PRATHA </title>
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
	<?php include('bookfacility_index.php'); ?>	
		<!-- =======================================table================================= -->
			
			
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Facilities</h5>
                    </div>
                    <div class="ibox-title">
                       <a href="<?php echo base_url(); ?>owner_controller/bookinghistory_page_cont" class="btn btn-primary"> <h5>view Booked Facilities</h5></a>
                    </div>

	
					<div class="ibox-content">
						<div class="row">

							
							<?php 

							if(isset($facility))
							{
								foreach($facility as $row)
								{
									?>
							    <div class="col-sm-3">
								<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding:20px; margin-left:10px; margin-right:10px; height:auto; max-height: 330px;" >
								<center>
								<img src="<?php echo base_url(); ?>img/facility/<?php echo $row->pic; ?>" style="max-height: 100px;" class="img-rounded img-responsive"><br>
								<h3><?php echo $row->facility_name;?></h3>

								<a href="<?php echo base_url(); ?>owner_controller/bookfacility_page_cont?id=<?php echo $row->facility_id?>"><h3 class="btn btn-info">Book</h3></center></a>
								</div>
							</div>
									
							<?php	}
							}

							?>


						</div>
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