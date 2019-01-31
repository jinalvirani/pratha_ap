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
   
}


?>

<!DOCTYPE html>
<html>
<head>
<title>BOOKING HISTORY | PRATHA</title>
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
	 return confirm("Are you sure to cancel this facility...? if you cancle booking, penalty will be 100rs");
 }
</script>

</head>
<body>
<div id="wrapper">
	<?php include('bookinghistory_index.php'); ?>	
		<!-- =======================================table================================= -->
			<?php if($invalid = $this->session->flashdata('book_facility')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
			
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Facilities</h5>
                    </div>
	
					<div class="ibox-content">
						<div class="row">

							
							<?php 

							if(isset($book_history))
							{
								foreach($book_history as $row)
								{
									?>
							    <div class="col-sm-3">
								<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding:20px; margin-left:10px; margin-right:10px; height:auto; max-height: 330px;" >
								 
                                <h5><?php echo $row->book_date; ?></h5>
                                <h5><?php echo $row->time_slot;?></h5>
                                <h3><?php echo $row->facility_name;?></h3>
                                <h3>Total_charge:<?php echo $row->total_charge;?></h3>
								<a href="<?php echo base_url(); ?>owner_controller/payindex_cont?id=<?php echo $row->book_id; ?>"><h3 class="btn btn-info">Pay</h3></a>
                                <a href="<?php echo base_url(); ?>owner_controller/bookinghistory_page_cont?id=<?php echo $row->book_id; ?>" onclick="return del()"><h3 class="btn btn-info">cancel</h3></a>
								</div>
							</div>
                        <?php	}
							}
                           else
    {
        ?>
            <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8"><h3><center>No Booking History Found</center></h3></div>
                            <div class="col-sm-2"></div>
            </div>
                        
        <?php
    }
							?>


						</div>
               		 </div>
            </div>
        </div>
    </div>
</div>

  <center><p> <a href="<?php echo base_url(); ?>owner_controller/bookfacility_list_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

<?php include('footer.php'); ?>  
</body>
</html>